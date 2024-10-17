<?php

namespace App\Http\Controllers;

use App\Response\ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function getTaskAssignedToMe(){
        $user = JWTAuth::parseToken()->authenticate();
        $data = $user->tasks()->get();

        return ApiResponse::success('Tasks Assigned To me',200 ,$data);
    }
}
