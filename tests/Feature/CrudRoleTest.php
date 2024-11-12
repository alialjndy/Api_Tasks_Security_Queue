<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CrudRoleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // public function test_create_role(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'name'=>'role for test only'
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Role',$data);
    //     $response->assertStatus(201);
    // }

    //.......................................................................................

    // public function test_update_role(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'name'=>'name after update'
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->putJson('/api/Role/3',$data);
    //     $response->assertStatus(200);
    // }

    //.......................................................................................

    // public function test_show_role(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/Role/3');
    //     $response->assertStatus(200);
    // }

    //.......................................................................................

    // public function test_delete_role(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->deleteJson('/api/Role/4');
    //     $response->assertStatus(200);
    // }

    //.......................................................................................


    // public function test_Assing_role_to_user(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'role_id'=>'2'
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/AssignRoleToUser/2',$data);
    //     $response->assertStatus(200);
    // }

    //.......................................................................................

    // public function test_delete_role_form_user(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'role_id'=>'2'
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/DeleteRoleFromUser/2',$data);
    //     $response->assertStatus(200);
    // }

    //.......................................................................................

    public function test_UnAuthorized_create_role(){
        $user = User::find(2);
        $token = JWTAuth::fromUser($user);

        $data = [
            'role_id'=>'2'
        ];
        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Role',$data);
        $response->assertStatus(403);
    }

    //.......................................................................................


    public function test_UnAuthorized_update_role(){
        $user = User::find(2);
        $token = JWTAuth::fromUser($user);

        $data = [
            'name'=>'after update name'
        ];
        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->putJson('/api/Role/2',$data);
        $response->assertStatus(403);
    }

    //.......................................................................................


    public function test_UnAuthorized_delete_role(){
        $user = User::find(2);
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->deleteJson('/api/Role/2');
        $response->assertStatus(403);
    }

    //.......................................................................................


    public function test_UnAuthorized_show_role(){
        $user = User::find(2);
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/Role/2');
        $response->assertStatus(403);
    }

    //.......................................................................................


    public function test_UnAuthorized_show_all_roles(){
        $user = User::find(2);
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/Role');
        $response->assertStatus(403);
    }

    //.......................................................................................

    public function test_Assing_role_to_user(){
        $user = User::find(2);
        $token = JWTAuth::fromUser($user);

        $data = [
            'role_id'=>'2'
        ];
        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/AssignRoleToUser/2',$data);
        $response->assertStatus(403);
    }

    //.......................................................................................


}
