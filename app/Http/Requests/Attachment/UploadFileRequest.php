<?php

namespace App\Http\Requests\Attachment;

use App\Response\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UploadFileRequest extends FormRequest
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
            // 'file' => 'required|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,application/pdf|max:2048',
            'file_name' => 'required|file|mimes:jpeg,png,gif,webp,pdf,jpg|max:2048',
            'file_path'=>'required|string',
            // 'attachable_type' => 'required|string',
            // 'attachable_id' => 'required|integer',
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
            //
        ];
    }
    public function messages(){
        return [
            //
        ];
    }
}
