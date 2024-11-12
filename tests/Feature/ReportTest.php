<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_generate_report(){
        $user = User::find(3);
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->getJson('/api/reports/daily-tasks');
        $response->assertStatus(200);
    }
    public function test_filter_generate_report(){
        $user = User::find(3);
        $token = JWTAuth::fromUser($user);

        $type = [
            'report_type'=>'completed_tasks'
        ];
        $response = $this->withHeaders(['Authorization'=>"Bearer $token"])->postJson('/api/filter_Generate_Report',$type);
        $response->assertStatus(200);
    }
}
