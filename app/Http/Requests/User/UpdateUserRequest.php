<?php

namespace App\Http\Requests\User;

use App\Response\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateUserRequest extends FormRequest
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
            'name'=>'nullable|string|max:100|min:3|unique:users,name',
            'email'=>'nullable|email|unique:users,email'
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
            'name'=>'User Name',
            'email'=>'User Email',
        ];
    }
    public function messages(){
        return [
            'string'=>'Error : The :attribute field value must be a string',
            'max'=>'Error : The :attribute max character is :max',
            'min'=>'Error : The :attribute min character is :min',
            'unique'=>'Error : The :attribute field value must be a unique',
            'email'=>'Error : please Enter a valid email'
        ];
    }
}
