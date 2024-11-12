<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CrudTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // public function test_create_Task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'type'=>'Bug',
    //         'status'=>'Open',
    //         'title'=>'title Task In Test Class',
    //         'priority'=>'Low',
    //         'due_date'=>'2024-12-10',
    //     ];
    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/CrudTask',$data);
    //     $response->assertStatus(201);
    // }
    //.............................................
    // public function test_update_Task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'priority'=>'High',
    //     ];
    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->putJson('/api/CrudTask/7',$data);
    //     $response->assertStatus(200);
    // }

    //...........................................................................

    // public function test_show_All_Task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/CrudTask');
    //     $response->assertStatus(200);
    // }

    //.............................................................................

    // public function test_Delete_Task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->deleteJson('/api/CrudTask/3');
    //     $response->assertStatus(200);
    // }

    //.................................................................................

    // public function test_UnAuthorized_CrudTask(){
    //     $user = User::find(12);
    //     $token = JWTAuth::fromUser($user);
    //     $data = [
    //         'type'=>'Bug',
    //         'status'=>'Open',
    //         'title'=>'Title UnAuthorized',
    //         'priority'=>'Low',
    //         'due_date'=>'2024-12-10',
    //     ];

    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/CrudTask',$data);
    //     $response->assertStatus(403);
    // }

    //.......................................................................................
    public function test_show_one_task(){
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);

        $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/CrudTask/1');
        $response->assertStatus(200);
    }

    //........................................................................................

    // public function test_restore_soft_deleted_task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Task/3/Restore');
    //     $response->assertStatus(200);
    // }

    //................................................................................................

    // public function test_show_all_soft_deleted_task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/Task/All_Soft_deleted_Tasks');
    //     $response->assertStatus(200);
    // }

    //................................................................................................

    // public function test_dependency_task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);
    //     $data = [
    //         'sub_task_id'=>['2','3']
    //     ];
    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Task/AddDependency/1', $data);
    //     $response->assertStatus(200);
    // }

    //................................................................................................

    // public function test_assign_task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);
    //     $data = [
    //         'Assigned_to'=>3
    //     ];
    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Task/4/assign', $data);
    //     $response->assertStatus(200);
    // }

    //................................................................................................

    // public function test_reAssign_task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);
    //     $data = [
    //         'Assigned_to'=>2
    //     ];
    //     $response = $this->actingAs($user)->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Task/7/assign', $data);
    //     $response->assertStatus(200);
    // }

    //................................................................................................




}
