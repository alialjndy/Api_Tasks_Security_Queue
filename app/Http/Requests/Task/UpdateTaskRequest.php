<?php

namespace App\Http\Requests\Task;

use App\Response\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = JWTAuth::parseToken()->authenticate();
        if($user && $user->hasRole('admin')){
            return true;
        }
        return ApiResponse::error('UnAuthorized',403);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'type'=>'nullable|in:Bug,Feature,Improvement',
        'description'=>'nullable|string|max:255',
        'title'=>'nullable|string|max:255|unique:tasks,title',
        'priority'=>'nullable|in:Low,Medium,High',
        'due_date'=>'nullable|date'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'failed validation please confirm the input',
                'errors'=>$validator->errors()
            ],403)
        );
    }
    public function attributes(){
        return [
            'type'=>'Task Type',
            'status'=>'Task Stauts',
            'description'=>'Task description',
            'title'=>'Task Title',
            'priority'=>'Task priority',
            'due_date'=>'Due Date',
            'Assigned_to'=>'User Assigned To'
        ];
    }
    public function messages(){
        return [
            'string'=>'Error : The :attribute field value must be a string',
            'max'=>'Error : The :attribute max character is :max',
            'unique'=>'Error : The :attribute field value must be a unique',
            'date'=>'Error : The :attribute value is not date',
            'in'=>'Error : The :attribute field value in invalid',
        ];
    }
}
