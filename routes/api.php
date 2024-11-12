<?php

use App\Http\Controllers\Admin\CrudRoleController;
use App\Http\Controllers\Admin\CrudTaskController;
use App\Http\Controllers\Admin\CrudUserController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\canCommentOnTaskMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// public Route
Route::post('login',[AuthController::class,'login']);
Route::get('me',[AuthController::class,'me']);
Route::post('logout',[AuthController::class,'logout']);

// Admin Route
Route::middleware([AdminMiddleware::class])->group(function(){
    //Role CRUD
    Route::apiResource('Role',CrudRoleController::class);
    Route::post('AssignRoleToUser/{user_id}',[CrudRoleController::class,'AssignRoleToUser']);
    Route::post('DeleteRoleFromUser/{user_id}',[CrudRoleController::class,'DeleteRoleFromUser']);

    //Crud User
    Route::apiResource('CrudUser',CrudUserController::class);

    //Crud Task
    Route::apiResource('CrudTask',CrudTaskController::class);
    Route::post('Task/{id}/Restore',[CrudTaskController::class, 'restore']);
    Route::get('Task/All_Soft_deleted_Tasks',[CrudTaskController::class, 'getAllSoftDeleteTask']);
    Route::post('Task/AddDependency/{task_id}',[CrudTaskController::class,'addDependency']);
    Route::post('Task/{id}/assign',[CrudTaskController::class,'assignTask']);
    Route::put('Task/{id}/reassign',[CrudTaskController::class,'reAssignUserTask']);

    Route::get('Comments',[CommentController::class,'index']);

    Route::post('Task/{id}/attachments',[AttachmentController::class,'uploadFile']); #TODO إختبر هذا الراوت

});

// change status task by user assigned to him
Route::put('Task/{task_id}/status',[CrudTaskController::class,'changeStautsTask']);
Route::get('Task/getTaskAssignedToMe',[UserController::class,'getTaskAssignedToMe']);

Route::middleware([canCommentOnTaskMiddleware::class])->group(function (){
    Route::post('Task/{id}/Comments',[CommentController::class,'store']);
});

Route::get('reports/daily-tasks',[ReportController::class,'generate']);
Route::post('filter_Generate_Report',[ReportController::class,'filterReportGenerate']);

#TODO إضافة التحقق من خلو الملف المرفق من الفيروسات والتحقق من اللاحقة الخاصة به
