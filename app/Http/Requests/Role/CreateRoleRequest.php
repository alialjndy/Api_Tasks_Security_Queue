<?php

namespace App\Http\Requests\Role;

use App\Models\User;
use App\Response\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = JWTAuth::parseToken()->authenticate();
        if($user && $user->hasRole('admin')){
            return true ;
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
            'name'=>'required|string|min:3|max:40|unique:roles,name'
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
            'name'=>'Roel Name'
        ];
    }
    public function messages(){
        return [
            'required'=>'Error : The :attribute field is required',
            'string'=>'Error : The :attribute field value must be a string',
            'max'=>'Error : The :attribute max character is :max',
            'min'=>'Error : The :attribute min character is :min',
            'unique'=>'Error : The :attribute field value must be a unique'
        ];
    }
}
