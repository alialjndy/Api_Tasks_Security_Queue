<?php

namespace App\Http\Middleware;

use App\Models\Task;
use App\Models\User;
use App\Response\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class canCommentOnTaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $task_id = $request->route('id');
        $task = Task::findOrFail($task_id);

        $user = JWTAuth::ParseToken()->authenticate();
        if($user && ($user->hasRole('admin') || $task->Assigned_to == $user->id)){

            return $next($request);
        }
        return ApiResponse::error('UnAuthorized',403);
    }
}
