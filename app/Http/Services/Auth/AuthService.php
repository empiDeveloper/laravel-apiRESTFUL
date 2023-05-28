<?php
namespace App\Http\Services\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService {

    public static function login($request)
    {
        try {
            $token = JWTAuth::attempt($request);
            if (!$token) {
                $username = $request['username'];
                return ResponseTrait::responseError("Password incorrect for: $username", 401);
            }

            User::where('id', auth()->id())->update(['last_login' => Carbon::now()]);

            $response = [
                'token' => $token,
                'minutes_to_expire' => config('jwt.ttl'),
            ];

            return ResponseTrait::responseSuccess($response, 200);
        } catch(JWTException $e) {
           return ResponseTrait::responseError($e, 500);
        }
    }
}
