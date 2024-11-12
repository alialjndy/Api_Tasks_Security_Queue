<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class changeStatusTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // public function test_change_status_task(){
    //     $user = User::find(2);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'status'=>'Completed'
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->putJson('/api/Task/2/status',$data);
    //     $response->assertStatus(200);
    // }

    //..........................................................................................

    // public function test_UnAuthorized_change_status_task(){
    //     $user = User::find(2);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'status'=>'Completed'
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->putJson('/api/Task/3/status',$data);
    //     $response->assertStatus(403);
    // }

    //..........................................................................................


}
