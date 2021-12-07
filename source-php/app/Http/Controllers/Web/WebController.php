<?php

namespace App\Http\Controllers\Web;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\RestaurantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\Psr7\str;

class WebController extends Controller
{
    public function changeLanguage($lang){
        Session::put('website_language', $lang);

        return redirect()->back();
    }

    public function profile(){
        return view('Web.Pages.profile');
    }
    public function moreRes(){
        return view('Web.Pages.more-res');
    }

    public function search(){
        $search_val = \request()->value;
        $res = Restaurant::where('name','like', '%'.$search_val.'%')->with(['restaurant_detail'])->take(40)->paginate(20);
        return view('Web.Pages.search-res',['res_list'=>$res]);
    }

    public function newRes(){
        $args = [
            'categories' => Category::where('status',1)->get(),
            'districts' => config('address.district')
        ];
        return view('Web.Pages.new-res',$args);
    }
    public function index(Request $request){
        $new_res = Restaurant::with(['restaurant_detail'])->take(10)->get();
        $args = [
            'new_res' => $new_res
        ];
        return view('Web.index',$args);
    }
    public function getDetail(Request $request){
        $res = Restaurant::where('Id',$request->id)->with(['restaurant_detail'=>function($q){
            $q->with(['category']);
        }])->first();
        if(!$res){
            abort(404);
        }

        $comments = Comment::where('ResId',$res['Id'])->with(['comment_pictures:CommentId,Url,IsFoody','customer:Id,DisplayName,Avatar,IsFoody'])->paginate(10);
        $args = [
            'res' => $res,
            'comments' => $comments,
        ];
        return view('Web.Pages.res-detail',$args);
    }
    public function getNearest($long='',$lat='',$limit=20){
        try {
           $user_location = [
               'Latitude' => (float)$lat,
               'Longitude' => (float)$long,
           ];

            $page = \request()->page ?? 1;

            $rs = [];
            $res = Restaurant::with('restaurant_detail')->get()->toArray();
            if(!empty($res)){
                foreach ($res as $key => $value) {
                    $res[$key]['distance'] = haversine($user_location, $value);
                }
                usort($res, function ($a, $b) {
                    if ($a['distance'] == $b['distance']) {
                        return 0;
                    }
                    return ($a['distance'] < $b['distance']) ? -1 : 1;
                });
                $rs = array_slice($res, ($page * $limit - $limit), $limit);
                $origin = ($user_location['Latitude'] . ',' . $user_location['Longitude']);
                $destination = '';
                foreach ($rs as $value) {
                    $destination .= $value['Latitude'] . ',' . $value['Longitude'] . '|';
                }
                $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $origin . '&destinations=' . $destination . '&key=AIzaSyCzlVX517mZWArHv4Dt3_JVG0aPmbSE5mE';
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($response);
                if (!empty($response)) {
                    $response = (array)$response;
                }
                if (!empty($response['rows'][0])) {
                    $elm = $response['rows'][0]->elements;
                    foreach ($rs as $key => $value) {
                        $rs[$key]['distance_gg'] = $elm[$key]->distance->value;
                    }
                }
                usort($rs, function ($a, $b) {
                    if ($a['distance_gg'] == $b['distance_gg']) {
                        return 0;
                    }
                    return ($a['distance_gg'] < $b['distance_gg']) ? -1 : 1;
                });
            }

            return [
                'success' => true,
                'message' => __('success'),
                'data' => $rs
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
