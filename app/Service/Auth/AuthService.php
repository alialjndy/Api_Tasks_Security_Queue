<?php
namespace App\Service\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService{
    /**
     * Logic Login Method
     * @param array $data
     * @throws \Exception
     * @return mixed
     */
    public function login(array $data){
        try{
            $credentials = [
                'email'=>$data['email'],
                'password'=>$data['password']
            ];
            if(!$token = JWTAuth::attempt($credentials)){
                throw new Exception('Invalid Credentials',401);
            }
            return $token ;
        }catch(Exception $e){
            Log::error('Error When Login User '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    /**
     * Logic me method
     * @throws \Exception
     * @return array
     */
    public function me(){
        try{
            $user = JWTAuth::parseToken()->authenticate();
            $info = [
                'name'=>$user->name ,
                'email'=>$user->email,
                'roles'=>$user->roles()->get()->makeHidden('pivot')
            ];
            return $info ;
        }catch(Exception $e){
            Log::error('Error When show User info '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    /**
     * logic logout method
     * @throws \Exception
     * @return void
     */
    public function logout(){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
        }catch(Exception $e){
            Log::error('Error When logout User '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
}
