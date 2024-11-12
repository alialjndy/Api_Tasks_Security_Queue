<?php
namespace App\Service\Role;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class CrudRoleService{
    /**
     * Creates a new role in the system.
     * @param mixed $data
     * @throws \Exception
     * @return
     */
    public function createRole($data){
        try{
            $role = Role::create($data);
            return $role ;
        }catch(Exception $e){
            Log::error('Error When Create a Role '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Retrieves a role by its ID along with the associated users.
     * @param mixed $role_id
     * @throws \Exception
     * @return mixed
     */
    public function showRole($role_id){
        try{
            $role = Role::findOrFail($role_id);
            return $role->users()->get() ;
        }catch(Exception $e){
            Log::error('Error When show the Role '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
    /**
     * Updates an existing role in the system.
     * @param array $data
     * @param mixed $role_id
     * @throws \Exception
     * @return void
     */
    public function updateRole(array $data , $role_id){
        try{
            $role = Role::findOrFail($role_id);
            $role->update($data);
        }catch(Exception $e){
            Log::error('Error When update the Role '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Deletes a role from the system by its ID.
     * @param mixed $role_id
     * @throws \Exception
     * @return void
     */
    public function deleteRole($role_id){
        try{
            $role = Role::findOrFail($role_id);
            $role->delete();
        }catch(Exception $e){
            Log::error('Error When delete the Role '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function AssignRole($role_id,$user_id){
        try{
            $role = Role::findOrFail($role_id);
            $user = User::findOrFail($user_id);

            $user->roles()->syncWithoutdetaching($role->id);
        }catch(ModelNotFoundException $e){
            Log::error('Error : Model Not found '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }catch(Exception $e){
            Log::error('Error When Assign Role to user '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function DeleteRoleFromUser($role_id,$user_id){
        try{
            $role = Role::findOrFail($role_id);
            $user = User::findOrFail($user_id);

            $user->roles()->detach($role->id);
        }catch(ModelNotFoundException $e){
            Log::error('Error : Model Not found '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }catch(Exception $e){
            Log::error('Error When Delete Role to user '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
}
