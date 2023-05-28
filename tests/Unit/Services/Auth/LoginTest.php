<?php

namespace Tests\Unit\Services\Auth;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $payload = [
            'username' => 'tester',
            'password' => 'PASSWORD',
        ];

        $token = JWTAuth::attempt($payload);
        if (!$token) {
           $response = false;
        } else {
            $update = User::where('id', 1)->update(['last_login' => Carbon::now()]);
            $response = $update ? true : false;
        }

        $this->assertTrue(true, $response);
    }
}
