<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PHPUnit\Util\Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class JWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
//            if (is_null($request->bearerToken())) {
//                return response()->json(['error'=>true, 'message' => 'Token required.'], 401);
//            }
//            if (!empty($request->expiresIn)) {
//                $user = Socialite::driver('google')->userFromToken($request->bearerToken());
//
//
////                $expiresIn = $request->expiresIn;
////                $time = strtotime("+$expiresIn seconds", $request->login_time);
////                $isExpired = (time() - $time > 0) ? true : false;
////
////                if ($isExpired) {
////                    return response()->json(['error' => true, 'message' => __('token_is_expired'), 'status' => 401], 401);
////                }
//                return $next($request);
//            }

            $token = Auth::guard('api')->getToken();
            $apy = Auth::guard('api')->getPayload($token)->toArray();
            return $next($request);
        } catch (TokenExpiredException $e) {
            return response()->json(['success' => false, 'message' => __('token_is_expired'), 'status' => 401], 401);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => __('token_is_invalid'), 'status' => 401], 401);
        }

    }
}
