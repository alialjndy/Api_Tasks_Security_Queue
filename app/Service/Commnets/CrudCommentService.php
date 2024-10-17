<?php
namespace App\Service\Commnets;

use App\Models\Comment;
use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class  CrudCommentService{
    public function createComment(array $data){
        try{
            $comment = Comment::create([
                'content'=>$data['content'],
                'user_id'=>$data['user_id']
            ]);
            return $comment ;
        }catch(Exception $e){
            Log::error('Error When Create Commnet '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
    public function showComment(string $comment_id){
        try{
            $comment = Comment::findOrFail($comment_id);
            return $comment ;
        }catch(Exception $e){
            Log::error('Error When Show Commnet '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
    public function updateComment(array $data, string $comment_id){
        try{
            $comment = Comment::findOrFail($comment_id);
            $user = JWTAuth::parseToken()->authenticate();
            $user_id = $user->id ;

            if($comment->user_id != $user_id){
                throw new Exception('you Cant Update this comment');
            }
            return $comment->update($data) ;
        }catch(Exception $e){
            Log::error('Error When Update Commnet '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
    public function deleteComment($comment_id){
        try{
            $user =JWTAuth::parseToken()->authenticate();
            $comment = Comment::findOrFail($comment_id);

            if($comment->user_id != $user->id){
                throw new Exception('You cant delete this comment');
            }
            $comment->delete();
        }catch(Exception $e){
            Log::error('Error When Delete Comment '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }

}