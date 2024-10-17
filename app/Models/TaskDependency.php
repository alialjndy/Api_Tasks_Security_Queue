<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDependency extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'sub_task_id'
    ];
    protected $hidden = ['pivot'];
}
