<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'report_type'=>'required|in:in_progress_tasks,overdue_tasks,blocked_tasks,completed_tasks'
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
            'report_type'=>'Report Type'
        ];
    }
    public function messages(){
        return [
            'required'=>'Error : The :attribute field is required',
            'in'=>'Error : The :attribute field value is Invalid '
        ];
    }
}
