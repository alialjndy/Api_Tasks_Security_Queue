<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AssignRoleRequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\DeleteRoleFromUserRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Response\ApiResponse;
use App\Service\Role\CrudRoleService;
use Illuminate\Http\Request;

class CrudRoleController extends Controller
{
    protected $crudRoleService ;
    public function __construct(CrudRoleService $crudRoleService){
        $this->crudRoleService = $crudRoleService ;
    }
    /**
     * select all Roles
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $allRoles = Role::select('id','name')->get();
        return ApiResponse::successIndex($allRoles,'roles');
    }

    /**
     * create new role
     */
    public function store(CreateRoleRequest $request)
    {
        $data = $request->validated();
        $role = $this->crudRoleService->createRole($data);
        return ApiResponse::successStore($data,'role');
    }

    /**
     * Display the specified Role.
     */
    public function show(string $id)
    {
        $role = $this->crudRoleService->showRole($id);
        return ApiResponse::successShow($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $data = $request->validated();
        $this->crudRoleService->updateRole($data ,$id);
        return ApiResponse::successUpdate('role');
    }

    /**
     * Delete the specified Role.
     */
    public function destroy(string $id)
    {
        $this->crudRoleService->deleteRole($id);
        return ApiResponse::successDelete('role');
    }
    /**
     * Assign Role to User
     * @param \App\Http\Requests\Role\AssignRoleRequest $request
     * @param mixed $user_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function AssignRoleToUser(AssignRoleRequest $request , $user_id){
        $data = $request->validated();
        $role_id = $data['role_id'];

        $this->crudRoleService->AssignRole($role_id , $user_id);
        return ApiResponse::success('Role Assigned successfully',200,true);
    }
    /**
     * Delete specified Role From User
     * @param \App\Http\Requests\Role\DeleteRoleFromUserRequest $request
     * @param mixed $user_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function DeleteRoleFromUser(DeleteRoleFromUserRequest $request,$user_id){
        $data = $request->validated();
        $role_id = $data['role_id'];

        $this->crudRoleService->DeleteRoleFromUser($role_id,$user_id);
        return ApiResponse::success('Role Deleted form user successfully',200,true);
    }
}
