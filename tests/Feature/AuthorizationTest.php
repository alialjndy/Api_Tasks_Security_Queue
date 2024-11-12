<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthorizationTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_login(){
        $response = $this->postJson('api/login',[
            'email'=>'alialjndy2@gmail.com',
            'password'=>'password1234'
        ]);
        $response->assertStatus(200);
    }
    public function test_me(){
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders(['Authorization' => "Bearer $token"])->getJson('api/me');

        $response->assertStatus(200);
    }
    public function test_logout(){
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        $resposne = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('api/logout');

        $resposne->assertStatus(200);
    }


}
