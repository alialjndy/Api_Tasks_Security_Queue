<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_status_update extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'previous_status',
        'new_status',
        'progress'
    ];
    public function tasks(){
        return $this->hasMany(Task::class,'task_id');
    }
}
