<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\AddDependencyRequest;
use App\Http\Requests\Task\AssignTaskToUserRequest;
use App\Http\Requests\Task\ChangeAssignedUserRequest;
use App\Http\Requests\Task\ChangeStatusRequest;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Response\ApiResponse;
use App\Service\Task\CrudTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CrudTaskController extends Controller
{
    protected $crudTaskService ;
    public function __construct(CrudTaskService $crudTaskService){
        $this->crudTaskService = $crudTaskService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allTasks = Cache::remember('tasks', 3600 , function()use ($request){
            return $this->crudTaskService->filterTask($request);
        });
        return ApiResponse::successIndex($allTasks,'tasks');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        $data = $request->validated();
        $task = $this->crudTaskService->createTask($data);
        Cache::forget('users');
        return ApiResponse::successStore($task,'task');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Cache::remember('task'.$id , 60 , function ($id){
            return $this->crudTaskService->showTask($id);
        });
        return ApiResponse::successShow($task);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $data = $request->validated();
        $this->crudTaskService->updateTask($data,$id);
        Cache::forget('tasks');
        return ApiResponse::successUpdate('task');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->crudTaskService->deleteTask($id);
        Cache::forget('tasks');
        return ApiResponse::successDelete('task');
    }
    /**
     * get All Soft Delted Tasks
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getAllSoftDeleteTask(){
        $allTasks = Task::onlyTrashed()->get();
        return ApiResponse::successIndex($allTasks , 'soft deleted tasks');
    }
    /**
     * forceDelete Task
     * @param string $task_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function forceDelete(string $task_id){
        $this->crudTaskService->forceDelete($task_id);
        return ApiResponse::successDelete('task');
    }
    /**
     * restore soft deleted tasks
     * @param string $task_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function restore(string $task_id){
        $task = $this->crudTaskService->restore($task_id);
        return ApiResponse::success('Task restored successfully',200,$task);
    }
    /**
     * Add Sub Task To Parent Task
     * @param \App\Http\Requests\Task\AddDependencyRequest $request
     * @param string $task_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function addDependency(AddDependencyRequest $request , string $task_id){
        $data = $request->validated();
        $task = $this->crudTaskService->addSubTask($data,$task_id);
        return ApiResponse::success('Credits have been successfully added',200,['sub_Tasks'=>$task->subTasks()->get()]);
    }
    /**
     * change Stauts Task to new status by user only
     * @param \App\Http\Requests\Task\ChangeStatusRequest $reqeust
     * @param string $task_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function changeStautsTask(ChangeStatusRequest $reqeust , string $task_id){
        $data = $reqeust->validated();
        $this->crudTaskService->changeStatusTask($data,$task_id);
        return ApiResponse::success('task change status successsfully',200);
    }
    /**
     * reAssign Task To new User by Admin
     * @param \App\Http\Requests\Task\ChangeAssignedUserRequest $request
     * @param string $task_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function reAssignUserTask(ChangeAssignedUserRequest $request , string $task_id){
        $data = $request->validated();
        $this->crudTaskService->changeAssignedUserTask($data['Assigned_to'],$task_id);
        return ApiResponse::success('Task reAssigned successfully',200);
    }
    /**
     * Assign Task To User by Admin
     * @param \App\Http\Requests\Task\AssignTaskToUserRequest $request
     * @param mixed $task_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function assignTask(AssignTaskToUserRequest $request , $task_id){
        $data = $request->validated();
        $task = $this->crudTaskService->assignTaskToUser($data , $task_id);
        return ApiResponse::success('Task Assigned successfully',200,$task);
    }

}
