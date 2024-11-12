<?php
namespace App\Service\User;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class CrudUserService{
    public function createUser($data){
        try{
            $User = User::create($data);
            return $User ;
        }catch(Exception $e){
            Log::error('Error When Create a User '.$e->getMessage());
            throw new Exception('There is an error in server. ',400);
        }
    }
    public function showUser($User_id){
        try{
            $User = User::select('id','name','email')->with('roles')->findOrFail($User_id);
            return $User;
        }catch(ModelNotFoundException $e){
            Log::error('Error Model not found '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }catch(Exception $e){
            Log::error('Error When show the User '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
    public function updateUser(array $data , $User_id){
        try{
            $User = User::findOrFail($User_id);
            $User->update($data);
        }catch(ModelNotFoundException $e){
            Log::error('Error Model not found '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }catch(Exception $e){
            Log::error('Error When update the User '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function deleteUser($User_id){
        try{
            $User = User::findOrFail($User_id);
            $User->delete();
        }catch(ModelNotFoundException $e){
            Log::error('Error Model not found '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }catch(Exception $e){
            Log::error('Error When delete the User '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
}
