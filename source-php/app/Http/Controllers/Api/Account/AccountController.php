<?php

namespace App\Http\Controllers\Api\Account;

use App\Comment;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ChangePasswordRequest;
use App\Http\Requests\Account\LoginRequest;
use App\Http\Requests\Account\RegisterRequest;
use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AccountController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['CreateAt'] = $data['UpdateAt'] = time();
        $data['Status'] = 1;
        $data['Avatar'] = 'images/menu/logo/avatar.jpg';
        $data['password'] = Hash::make($data['password']);
        $check = Customer::where('email',$data['email'])->first();
        if($check){
            return response()->json([
                'success' => false,
                'message' => __('email_is_exist'),
                'data' => []
            ], 200);
        }
        $customer = Customer::create($data);

        $args['customer'] = $customer;
        return response()->json([
            'success' => true,
            'message' => __('success'),
            'data' => $customer
        ], 200);
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
//        return $credentials;
//        $customer = Customer::where('email', $credentials['email'])->first();
//        return $customer;
        $jwt_token = auth('api')->attempt($credentials);
        if (!$jwt_token) {
            return response()->json([
                'success' => false,
                'message' => __('email_or_password_is_invalid'),
            ]);
        }
        $args['token'] = $jwt_token;
        $args['user'] = Auth::guard('api')->user();

        if ($request->remember) {
            return response()->json([
                'success' => true,
                'message' =>__('success'),
                'data' => $args
            ])->withCookie(Cookie::make('email', $request->email, 1000))->withCookie(Cookie::make('password', $request->password, 1000));
        }

        return response()->json([
            'success' => true,
            'message' =>__('success'),
            'data' => $args
        ])->withCookie(Cookie::forget('email'))->withCookie(Cookie::forget('password'));
    }
    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $data_update = [];
        $user = Auth::guard('api')->user();
        if(!empty($data['image'])){
            $user->Avatar = $data['image'];
        }
        if(!empty($data['new_password'])){
            if(empty($user->password)){
                $user->password = bcrypt($data['new_password']);
            }else{
                if(!isset($data['old_password'])){
                    return response()->json([
                        'status' => 200,
                        'message' => 'Vui lòng nhập mật khẩu cũ',
                        'data' => [],
                        'success' => false
                    ]);
                }
                if(Hash::check($data['old_password'],$user->password)){
                    $user->password = bcrypt($data['new_password']);
                }else{
                    return response()->json([
                        'status' => 200,
                        'message' => 'Mật khẩu cũ không đúng',
                        'data' => [],
                        'success' => false
                    ]);
                }
            }
        }
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => _trans('success'),
            'data' => $user,
            'success' => true
        ]);

    }

    public function getMe(Request $request)
    {
        $user = Auth::guard('api')->user();
        return response()->json([
            'status' => 200,
            'message' => _trans('Thành công'),
            'data' => $user,
            'success' => true
        ]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $user = Auth::guard('api')->user();
        $current_password = $user->password;
        if (Hash::check($data['old_password'], $current_password)) {
            $user->password = bcrypt($data['new_password']);
            $user->update_at = time();
            $user->save();

            $credentials['phone'] = $user->phone;
            $credentials['password'] = $data['new_password'];
            $jwt_token = Auth::guard('api')->attempt($credentials);
            if (!$jwt_token) {
                return response()->json([
                    'status' => 200,
                    'message' => _trans('Đăng nhập thất bại'),
                    'data' => [],
                    'success' => false
                ]);
            }
            $args['user'] = Auth::guard('api')->user();
            $args['token'] = $jwt_token;
            return response()->json([
                'status' => 200,
                'message' => _trans('Cập nhật thành công'),
                'data' => $args,
                'success' => true
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => _trans('Mật khẩu cũ không đúng'),
            'data' => [],
            'success' => false
        ]);

    }

    public function sendResetPasswordMail(Request $request)
    {
        try {
            if(!isset($request->email)){
                return [
                    'message' => __('email_is_incorrect'),
                    'success' =>false
                ];
            }

            DB::beginTransaction();
            if (!isset($request->email)) {
                return response()->json([
                    'status' => 200,
                    'message' => _trans('Vui lòng nhập Email'),
                    'data' => [],
                    'success' => false
                ]);
            }
            $customer = Customer::where('email', $request->email)->first();

            if (!$customer) {
                return response()->json([
                    'status' => 200,
                    'message' => _trans('Email không chính xác'),
                    'data' => [],
                    'success' => false
                ]);
            }
            $new_password = Str::random(6);
            $data = [];
            $data['view'] = 'Mail.resetPasswordMail';
            $data['subject'] = '2OCLOCK- RESET PASSWORD';
//            $data['from'] = $setting['setting']['mail_username'];
//            $data['to'] = $request->email;
            $data['to'] = $request->email;
//            $data['cc'] = [];
//            $data['bcc'] = [];
//            $sendMail = sendEmail('thanhdoan1411998@gmail.com', $data);
            $data['information'] = [
                'password' => $new_password,
            ];
            $sendMail = sendEmail($data);
            if($sendMail['success']){
                $customer->update([
                    'password' => Hash::make($new_password),
                    ]);
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'data' => [],
                    'message' => $sendMail['message'],
                    'success' => true
                ]);
            }
            DB::rollBack();
            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => $sendMail['message'],
                'success' => false
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => $e->getMessage(),
                'success' => false
            ]);
        }
    }
    public function enterPassword(Request $request)
    {
        return view('Web.Account.reset-password', [
            'token' => $request->token,
            'obj' => $request->obj,
        ]);
    }

    public function resetPassword(EnterPasswordRequest $request)
    {
        $customer = Customer::where('token', '<>', '')->where('token', $request->token)->first();
        if (!$customer) {
            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => __('token_is_invalid'),
                'success' => false
            ]);
        }

        if (Carbon::parse($customer->updated_at)->addMinutes(5)->isPast()) {
            $customer->update(['token' => '']);
            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => __('token_is_expired'),
                'success' => false
            ]);
        }
        $customer->update(['password' => bcrypt($request->password), 'token' => '']);

        return response()->json([
            'status' => 200,
            'data' => [],
            'message' => __('success'),
            'success' => true
        ]);
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('api')->logout();
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ]);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'ignore' => true,
                'message' => 'Session expired'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $customer = Socialite::driver('google')->user();
            if (isset($customer->email)) {
                $finduser = Customer::where('email', $customer->email)->first();
                if (!$finduser) {
                    $finduser = Customer::create([
                        'DisplayName' => $customer->name,
                        'email' => $customer->email,
                        'Google_Id' => $customer->id,
                        'Status' => 1,
                        'Avatar' => 'images/menu/logo/avatar.jpg',
                        'CreateAt' => time(),
                        'UpdateAt' => time(),
                    ]);
                }
                if ($finduser['email']) {
                    $jwt_token = Auth::guard('api')->login($finduser);
                    $data_login_google = [
                        'token' => $jwt_token,
                        'user' => $finduser,
                    ];
                    return view('Web.Account.login', ['data_login_google' => json_encode($data_login_google)]);
                }

            }
            abort(404);


        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
