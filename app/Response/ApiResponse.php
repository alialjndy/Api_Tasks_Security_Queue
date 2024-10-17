<?php
namespace App\Response;
class ApiResponse{
    public static function successStore($data = null , $item){
        return response()->json([
            'status'=>'success',
            'message'=>$item . ' created successfully',
            'data'=>$data
        ],201);
    }
    /**
     * Summary of successUpdate
     * @param mixed $item
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function successUpdate($item){
        return response()->json([
            'status'=>'success',
            'message'=>$item . ' updated successfully'
        ],200);
    }
    /**
     * Summary of successDelete
     * @param mixed $item
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function successDelete($item){
        return response()->json([
            'status'=>'success',
            'message'=>$item . ' Deleted successfully'
        ],200);
    }
    /**
     * Summary of successIndex
     * @param mixed $data
     * @param mixed $items
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function successIndex($data,$items){
        return response()->json([
            'status'=>'success',
            'message'=>'All '.$items ,
            'data'=>$data
        ],200);
    }
    /**
     * Summary of successShow
     * @param mixed $item
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function successShow($item){
        return response()->json([
            'status'=>'success',
            'message'=>'details' ,
            'data'=>$item
        ],200);
    }
    /**
     * Summary of error
     * @param mixed $message
     * @param mixed $code
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function error($message , $code){
        return response()->json([
            'status'=>false,
            'message'=>$message
        ],$code);
    }
    public static function success($message , $code = 200, $data = null){
        return response()->json([
            'status'=>'success',
            'message'=>$message,
            'data'=>$data
        ],$code);
    }
}
