<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Customer;
use App\Restaurant;
use App\RestaurantDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class RestaurantController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function add_location()
    {
        return view('admin.location');
    }

    public function add_location_post()
    {
        $data = request()->all();
        $Address = $data['Address'] . ', ' . $data['District'] . ', ' . $data['City'];
        $open = $data['OpenHour'] . ':' . $data['OpenMinute'].' - '.$data['CloseHour'] . ':' . $data['CloseMinute'];
        $open_time = $data['OpenHour'] . ':' . $data['OpenMinute'];
        $close_time = $data['CloseHour'] . ':' . $data['CloseMinute'];
        $price = ($data['MinPrice']/1000).'.000' . 'đ - ' . ($data['MaxPrice']/1000) . '.000đ';
        $item = Restaurant::create(['Name' => $data['Name'], 'Address' => $Address, 'PhotoUrl' => $data['PhotoUrl'],
            'Latitude' => $data['Latitude'], 'Longitude' => $data['Longitude'], 'PriceMax' => $data['MaxPrice'],
            'PriceMin' => $data['MinPrice'], 'Status' => 1, 'CreateDate' => date("Y-m-d")]);

        $id = $item['Id'];
        $item1 = RestaurantDetail::create(['res_id' => $id, 'street_address' => $data['Address'], 'district' => $data['District']
            , 'city' => $data['City'], 'category_id' => $data['Categories'], 'open_time' => $open, 'min_price' => $data['MinPrice'], 'max_price' => $data['MaxPrice'], 'price' => $price]);
        echo '<script>alert("Thêm thành công!")</script>';
        return view('admin.location');
    }

    public function list_location()
    {
        $res = Restaurant::paginate(20);

        return view('admin.list_location', ['res_list' => $res]);
    }

    public function list_location_get()
    {
        $var = $_GET['district'];
        $res = Restaurant::where('Status',1)->whereHas('restaurant_detail', function ($q) use ($var) {
            $q->where('district', $var);
        })->get();
        return ['res_list' => $res];
    }

    public function detail_location_get($id)
    {
        $location = Restaurant::where('id', $id)->with(['restaurant_detail'])->first();
        $categories = Category::all();
        $address = config('address');
        $districts = [
            "Quận 1", "Quận 2", "Quận 3", 'Quận 4', "Quận 5", 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 9', 'Quận 10', 'Quận 11',
            'Quận 12', 'Quận Thủ Đức', 'Quận Gò Vấp', 'Quận Bình Thạnh', 'Quận Tân Phú', 'Quận Bình Tân', 'Huyện Củ Chi', 'Huyện Hóc Môn', 'Huyện Bình Chánh',
            'Huyện Nhà Bè', 'Huyện Cần Giờ',
        ];
        $cities = $address['city'];
        $hours = $address['hour'];
        $minutes = $address['minute'];
        $args = [
            'location' => $location,
            'categories' => $categories,
            'districts' => $districts,
            'cities' => $cities,
            'hours' => $hours,
            'minutes' => $minutes
        ];
        return view('admin.detail_location', $args);
    }

    public function update_location_post($id)
    {
        $data = request()->all();
        $Address = $data['Address'] . ', ' . $data['District'] . ', ' . $data['City'];
        $open = $data['OpenHour'] . ':' . $data['OpenMinute'].' - '.$data['CloseHour'] . ':' . $data['CloseMinute'];
        $open_time = $data['OpenHour'] . ':' . $data['OpenMinute'];
        $close_time = $data['CloseHour'] . ':' . $data['CloseMinute'];
        $price = ($data['MinPrice']/1000).'.000' . 'đ - ' . ($data['MaxPrice']/1000) . '.000đ';

        $res = Restaurant::find($id);
        $res->Name = $data['Name'];
        $res->Address = $Address;
        $res->PhotoUrl = $data['PhotoUrl'];
        $res->Latitude = $data['Latitude'];
        $res->Longitude = $data['Longitude'];
        $res->PriceMax = $data['MaxPrice'];
        $res->PriceMin = $data['MinPrice'];
        $res->save();

        $res_detail = RestaurantDetail::where('res_id',$id)->first();
        $res_detail->street_address = $data['Address'];
        $res_detail->district = $data['District'];
        $res_detail->city = $data['City'];
        $res_detail->category_id = $data['Categories'];
        $res_detail->open_time = $open;
        $res_detail->min_price = $data['MinPrice'];
        $res_detail->max_price = $data['MaxPrice'];
        $res_detail->price = $price;
        $res_detail->save();
        echo '<script>alert("Sửa thành công!")</script>';
        return view('admin.list_location');
    }

    public function delete_location_get($id)
    {
        Restaurant::find($id)->delete();
        RestaurantDetail::where('res_id',$id)->delete();
        Comment::where('ResId',$id)->delete();
        echo '<script>alert("Xóa thành công!")</script>';
        return view('admin.list_location');
    }

    public function list_user_get()
    {
        $cus = Customer::where('Role',0)->paginate(20);

        return view('admin.list_user', ['cus_list' => $cus]);
    }

    public function delete_user_get($id)
    {
        Customer::find($id)->delete();
        Comment::where('Owner_id',$id)->delete();
        echo '<script>alert("Xóa thành công!")</script>';

        return redirect()->route('admin.list_user_get');
    }

    public function detail_user_get($id)
    {
        $user = Customer::find($id);
        $args = [
            'user' => $user
        ];
        return view('admin.detail_user', $args);
    }

    public function update_user_post($id)
    {
        $data = request()->all();
        $cus = Customer::find($id);
        $cus->DisplayName = $data['DisplayName'];
        $cus->email = $data['Email'];
        $cus->password = Hash::make($data['Password']);
        $cus -> save();

        echo '<script>alert("Sửa thành công!")</script>';

        return redirect()->route('admin.list_user_get');
    }

    public function add_user()
    {
        return view('admin.user');
    }

    public function add_user_post()
    {
        $email = $_POST['email'];
        $displayname = $_POST['displayname'];
        $password = Hash::make($_POST['password']);
        $user = Customer::where('email',$email)->first();
        if ($user) {
            return ['success'=>0];
        }
        if (!$user) {
            Customer::create(['DisplayName' => $displayname, 'email' => $email,
                'password' => $password, 'Role' => 0, 'CreateDate' => date("Y-m-d")]);
            return ['success' => 1];
        }
        return ['success' => 1];
    }

    public function list_admin_get()
    {
        $cus = Customer::where('Role',1)->paginate(20);

        return view('admin.list_admin', ['cus_list' => $cus]);
    }

    public function delete_admin_get($id)
    {
        Customer::find($id)->delete();
        Comment::where('Owner_id',$id)->delete();
        echo '<script>alert("Xóa thành công!")</script>';

        return redirect()->route('admin.list_admin_get');
    }

    public function detail_admin_get($id)
    {
        $user = Customer::find($id);
        $args = [
            'user' => $user
        ];
        return view('admin.detail_admin', $args);
    }

    public function update_admin_post($id)
    {
        $data = request()->all();
        $cus = Customer::find($id);
        $cus->DisplayName = $data['DisplayName'];
        $cus->email = $data['Email'];
        $cus->password = Hash::make($data['Password']);
        $cus -> save();

        echo '<script>alert("Sửa thành công!")</script>';

        return redirect()->route('admin.list_admin_get');
    }

    public function add_admin()
    {
        return view('admin.admin');
    }

    public function add_admin_post()
    {
        $email = $_POST['email'];
        $displayname = $_POST['displayname'];
        $password = Hash::make($_POST['password']);
        $user = Customer::where('email',$email)->first();
        if ($user) {
            return ['success'=>0];
        }
        if (!$user) {
            Customer::create(['DisplayName' => $displayname, 'email' => $email,
                'password' => $password, 'Role' => 1, 'CreateDate' => date("Y-m-d")]);
            return ['success' => 1];
        }
        return ['success' => 1];
    }

    public function list_location_approval(){
        return view('admin.list_location_approval');
    }

    public function list_location_approval_get()
    {
        $var = $_GET['district'];
        $res = Restaurant::where('Status',0)->whereHas('restaurant_detail', function ($q) use ($var) {
            $q->where('district', $var);
        })->get();
        return ['res_list' => $res];
    }

    public function detail_location_approval_get($id)
    {
        $location = Restaurant::where('id', $id)->with(['restaurant_detail'])->first();
        $categories = Category::all();
        $address = config('address');
        $districts = [
            "Quận 1", "Quận 2", "Quận 3", 'Quận 4', "Quận 5", 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 9', 'Quận 10', 'Quận 11',
            'Quận 12', 'Quận Thủ Đức', 'Quận Gò Vấp', 'Quận Bình Thạnh', 'Quận Tân Phú', 'Quận Bình Tân', 'Huyện Củ Chi', 'Huyện Hóc Môn', 'Huyện Bình Chánh',
            'Huyện Nhà Bè', 'Huyện Cần Giờ',
        ];
        $cities = $address['city'];
        $hours = $address['hour'];
        $minutes = $address['minute'];
        $args = [
            'location' => $location,
            'categories' => $categories,
            'districts' => $districts,
            'cities' => $cities,
            'hours' => $hours,
            'minutes' => $minutes
        ];
        return view('admin.detail_location_approval', $args);
    }

    public function update_location_approval_post($id)
    {
        $data = request()->all();
        $Address = $data['Address'] . ', ' . $data['District'] . ', ' . $data['City'];
        $open = $data['OpenHour'] . ':' . $data['OpenMinute'].' - '.$data['CloseHour'] . ':' . $data['CloseMinute'];
        $open_time = $data['OpenHour'] . ':' . $data['OpenMinute'];
        $close_time = $data['CloseHour'] . ':' . $data['CloseMinute'];
        $price = ($data['MinPrice']/1000).'.000' . 'đ - ' . ($data['MaxPrice']/1000) . '.000đ';

        $res = Restaurant::find($id);
        $res->Name = $data['Name'];
        $res->Address = $Address;
        $res->PhotoUrl = $data['PhotoUrl'];
        $res->Latitude = $data['Latitude'];
        $res->Longitude = $data['Longitude'];
        $res->PriceMax = $data['MaxPrice'];
        $res->PriceMin = $data['MinPrice'];
        $res->Status = 1;
        $res->save();

        $res_detail = RestaurantDetail::where('res_id',$id)->first();
        $res_detail->street_address = $data['Address'];
        $res_detail->district = $data['District'];
        $res_detail->city = $data['City'];
        $res_detail->category_id = $data['Categories'];
        $res_detail->open_time = $open;
        $res_detail->min_price = $data['MinPrice'];
        $res_detail->max_price = $data['MaxPrice'];
        $res_detail->price = $price;
        $res_detail->save();
        echo '<script>alert("Duyệt thành công!")</script>';
        return view('admin.list_location_approval');
    }

    public function delete_location_approval_get($id)
    {
        Restaurant::find($id)->delete();
        RestaurantDetail::where('res_id',$id)->delete();
        Comment::where('ResId',$id)->delete();
        echo '<script>alert("Từ chối thành công!")</script>';
        return view('admin.list_location_approval');
    }

    public function statistic()
    {
        return view('admin.statistic');
    }

    public function statistic_get(){
        $var = $_GET['year'];
        $admin = DB::table('customers')->select(
            DB::raw("month(CreateDate) as Month"),
            DB::raw("COUNT(Id) as Total")
        )->whereYear('CreateDate',$var)
            ->groupBy(DB::raw("MONTH(CreateDate)"))
            ->orderBy(DB::raw("MONTH(CreateDate)"))->get();
        $result[] = ['Tháng','số lượng'];
        foreach ($admin as $key=>$value){
            $result[++$key]=[$value->Month,(int)$value->Total];
        }

        $restaurant = DB::table('restaurants')->select(
            DB::raw("month(CreateDate) as Month"),
            DB::raw("COUNT(Id) as Total")
        )->whereYear('CreateDate',$var)
            ->groupBy(DB::raw("MONTH(CreateDate)"))
            ->orderBy(DB::raw("MONTH(CreateDate)"))->get();
        $result1[] = ['Tháng','số lượng'];
        foreach ($restaurant as $key=>$value){
            $result1[++$key]=[$value->Month,(int)$value->Total];
        }
        return ['admin'=>$result,'restaurant'=>$result1];
    }
}
