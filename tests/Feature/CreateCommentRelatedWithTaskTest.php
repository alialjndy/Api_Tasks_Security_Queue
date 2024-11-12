<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateCommentRelatedWithTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // public function test_create_comment_related_with_task(){
    //     $user = User::find(1);
    //     $token = JWTAuth::fromUser($user);

    //     $data = [
    //         'content'=>'I\'am admin and this is my comment on this taks with id'
    //     ];
    //     $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Task/4/Comments',$data);
    //     $response->assertStatus(201);
    // }

    //.........................................................................................................
    public function test_create_comment_related_with_not_found_task(){
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);

        $data = [
            'content'=>'I\'am admin and this is my comment on this taks with id'
        ];
        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Task/44/Comments',$data);
        $response->assertStatus(404);
    }

    //........................................................................................
    public function test_UnAuthorized_create_comment_related_with_not_found_task(){
        $user = User::find(3);
        $token = JWTAuth::fromUser($user);

        $data = [
            'content'=>'I\'am admin and this is my comment on this taks with id'
        ];
        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/Task/4/Comments',$data);
        $response->assertStatus(403);
    }
}
