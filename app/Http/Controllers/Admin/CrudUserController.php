<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Response\ApiResponse;
use App\Service\User\CrudUserService;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;

class CrudUserController extends Controller
{
    protected $crudUserService ;
    public function __construct(CrudUserService $crudUserService){
        $this->crudUserService = $crudUserService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $allRoles = Role::select('id','name')->makeHidden('pivot')->get();
        $allUsers = User::with('roles')->select('id','name','email')->get();
        return ApiResponse::successIndex($allUsers, 'users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->crudUserService->createUser($data);
        return ApiResponse::successStore($user,'user');
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $user = $this->crudUserService->showUser($user_id);
        return ApiResponse::successShow($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $this->crudUserService->updateUser($data,$id);
        return ApiResponse::successUpdate('user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->crudUserService->deleteUser($id);
        return ApiResponse::successDelete('user');
    }
}
