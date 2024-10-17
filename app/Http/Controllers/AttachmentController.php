<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attachment\UploadFileRequest;
use App\Models\Attachment;
use App\Models\Task;
use App\Response\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentController extends Controller
{
    public function uploadFile(UploadFileRequest $request, $task_id){
        $data = $request->validated();
        $file = $request->file('file_name');
        $fileName = Str::random(32) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('attachments', $fileName, 'public');

        $task = Task::findOrFail($task_id);
        $attachment = $task->attachments()->create([
            'file_name'=>$fileName,
            'file_path'=>$filePath
        ]);
        return ApiResponse::success('File Uploaded successfully',201 ,$attachment);
    }

}
