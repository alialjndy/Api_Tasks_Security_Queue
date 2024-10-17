<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Response\ApiResponse;
use App\Service\Auth\AuthService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    protected $authService ;
    public static function middleware()
    {
        return [
            new Middleware(middleware:'auth:api',except:['login']),
        ];
    }
    public function __construct(AuthService $authService){
        $this->authService = $authService ;
    }
    /**
     * Summary of login
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){
        $data = $request->validated();
        $token = $this->authService->login($data);
        return ApiResponse::success('User Loged In successfully',200,$token);
    }
    /**
     * Summary of me
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function me(){
        $info = $this->authService->me();
        return ApiResponse::success('User Info',200,$info);
    }
    /**
     * Summary of logout
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout(){
        $this->authService->logout();
        return ApiResponse::success('User logged out successfully',200,null);
    }
}
