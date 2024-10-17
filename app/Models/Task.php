<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'type',
        'status',
        'description',
        'title',
        'priority',
        'due_date',
        'Assigned_to'
    ];
    protected $hidden = ['pivot','created_at','updated_at'];
    public function user(){
        return $this->belongsTo(User::class,'Assigned_to');
    }
    // get all sub tasks related with parent task
    public function subTasks(){
        return $this->belongsToMany(Task::class,'task_dependencies','task_id','sub_task_id')
        ->withPivot('task_id','sub_task_id')->withTimestamps();
    }
    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

}
