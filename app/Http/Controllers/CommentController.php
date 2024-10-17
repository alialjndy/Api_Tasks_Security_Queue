<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\CreateCommentsRequest;
use App\Http\Requests\Comments\UpdateCommentsRequest;
use App\Models\Comment;
use App\Models\Task;
use App\Response\ApiResponse;
use App\Service\Commnets\CrudCommentService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentController extends Controller
{
    protected $crudCommentService ;

    public function __construct(CrudCommentService $crudCommentService){
        $this->crudCommentService = $crudCommentService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allComments = Comment::all();
        return ApiResponse::successIndex($allComments , 'comments');
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(CreateCommentsRequest $request,$task_id)
        {
            $user = JWTAuth::ParseToken()->authenticate();
            $user_id = $user->id ;
            $data = $request->validated();
            $task = Task::findOrFail($task_id);


            $task->comments()->create([
                'content' => $data['content'],
                'user_id' => $user_id
            ]);
            return ApiResponse::successStore(null ,'comment');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $comment_id)
    {
        $comment = $this->crudCommentService->showComment($comment_id);
        return ApiResponse::successShow($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentsRequest $request, string $comment_id)
    {
        $data = $request->validated();
        $this->crudCommentService->updateComment($data,$comment_id);
        return ApiResponse::successUpdate('comment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $comment_id)
    {
        $this->crudCommentService->deleteComment($comment_id);
        return ApiResponse::successDelete('comment');
    }
}
