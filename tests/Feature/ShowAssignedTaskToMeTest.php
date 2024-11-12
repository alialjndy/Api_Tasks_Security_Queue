<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ShowAssignedTaskToMeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_show_assigned_task_to_me(){
        $user = User::find(4);
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/Task/getTaskAssignedToMe');
        $response->assertStatus(200);
    }
}
