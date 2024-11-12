<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ShowCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_show_all_comments(){
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/Comments');
        $response->assertStatus(200);
    }
}
