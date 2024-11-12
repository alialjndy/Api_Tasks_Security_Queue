<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CrudUserTest extends TestCase
{
    /**
     * A basic feature test example.
    */
    // public function testCreate(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);
    //     $data = [
    //         'name'=>'albrens1212',
    //         'email'=>'albrens1212@gmail.com',
    //         'password'=>Hash::make('password1234')
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/CrudUser',$data);
    //     $response->assertStatus(201);
    // }
    //...............................................
    // public function testUpdate(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);
    //     $data = [
    //         'name'=>'albrens4452',
    //         'email'=>'albrens4452@gmail.com',
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->putJson('/api/CrudUser/14',$data);
    //     $response->assertStatus(200);
    // }
    //.............................................................
    // public function testShow(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/CrudUser/1');
    //     $response->assertStatus(200);
    // }
    //...................................................
    // public function testDelete(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->deleteJson('/api/CrudUser/13');
    //     $response->assertStatus(200);
    // }
    //...................................................................
    // public function test_failed_create_user(){
    //     $user = User::find(11);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'name'=>'user1',
    //         'email'=>'user1@gmail.com',
    //     ];
    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->putJson('/api/CrudUser/4',$data);
    //     $response->assertStatus(403);
    // }
    //.......................................................
    // public function test_failed_update_user(){
    //     $user = User::find(11);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'name'=>'user1',
    //         'email'=>'user1@gmail.com',
    //         'password'=>Hash::make('password1234')
    //     ];
    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/CrudUser',$data);
    //     $response->assertStatus(403);
    // }
    public function test_failed_input_data(){
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);

        $data = [
            'name'=>'user2',
            'email'=>'user2@gmail.com'
        ];
        $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/CrudUser',$data);
        $response->assertStatus(403);
    }

}
