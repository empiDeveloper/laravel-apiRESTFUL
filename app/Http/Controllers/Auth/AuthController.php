<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\Auth\AuthService;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username' => 'required|exists:users,username',
                'password' => 'required'
            ]);
            if ($validate->fails()) return response($validate->errors(), 400);

            $response = AuthService::login($request->only(['username', 'password']));

            return $response;
        } catch(\Exception $e) {
            return response($e);
        }
    }
}
