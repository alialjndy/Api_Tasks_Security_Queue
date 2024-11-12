<?php
namespace App\Service\Task;

use App\Models\Task;
use App\Models\Task_status_update;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CrudTaskService{
    public function filterTask(Request $request){
        $query = Task::query();
        if($request->has('type')){
            $query->where('type',$request->input('type'));
        }
        if($request->has('status')){
            $query->where('status',$request->input('status'));
        }
        if($request->has('assigned_to')){
            $query->where('assigned_to',$request->input('assigned_to'));
        }
        if($request->has('due_date')){
            $query->where('due_date',$request->input('due_date'));
        }
        if($request->has('priority')){
            $query->where('priority',$request->input('priority'));
        }
        if($request->has('depends_on')){
            $query->whereRelation('subTasks','sub_task_id' ,'=',$request->input('depends_on'));

        }
        return $query->get();
    }

    /**
     * create a new Task
     * @param array $data
     * @throws \Exception
     * @return
     */
    public function createTask(array $data){
        try{
            $task = Task::create($data);
            return $task ;
        }catch(Exception $e){
            Log::error('Error When Create Task '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * method for Update Task by ID
     * @param array $data
     * @param string $task_id
     * @throws \Exception
     * @return void
     */
    public function updateTask(array $data,string $task_id){
        try{
            $task = Task::findOrFail($task_id);
            $task->update($data) ;
        }catch(Exception $e){
            Log::error('Error When Update Task '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * this method for show task by its ID
     * @param string $task_id
     * @throws \Exception
     */
    public function showTask(string $task_id){
        try{
            $task = Task::with('subTasks')->find($task_id);
            return $task ;
        }catch(Exception $e){
            Log::error('Error When show Task '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * This method for Delete Task
     * @param string $task_id
     * @throws \Exception
     * @return mixed
     */
    public function deleteTask(string $task_id){
        try{
            $task = Task::findOrFail($task_id);
            return $task->delete() ;
        }catch(Exception $e){
            Log::error('Error When Delete Task '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function forceDelete(string $task_id){
        try{
            $task = Task::withTrashed()->findOrFail($task_id);
            $task->forceDelete();
        }catch(Exception $e){
            Log::error('Error When Force Delete the task '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    public function restore(string $task_id){
        try{
            $task = Task::withTrashed()->findOrFail($task_id);
            $task->restore();
            return $task ;
        }catch(Exception $e){
            Log::error('Error When Restore a one task '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
    /**
     * Add sub Task dependency on task
     * @param array $data
     * @param string $task_id
     * @throws \Exception
     */
    public function addSubTask(array $data,string $task_id){
        try{
            $task = Task::findOrFail($task_id);
            $task->subTasks()->syncWithoutDetaching($data['sub_task_id']);
            Task_status_update::create([
                'task_id'=>$task->id,
                'previous_status'=>$task->status ,
                'new_status'=>'Blocked'
            ]);
            $task->status = 'Blocked'; // change status task to blocked because it dependence on other task
            $task->save();


            return $task ;
        }catch(Exception $e){
            Log::error('Error When add sub Task '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
    /**
     * change status task function
     * @param array $data
     * @param string $task_id
     * @throws \Exception
     */
    public function changeStatusTask(array $data,string $task_id){

        try{
            $user = JWTAuth::parseToken()->authenticate();
            $task = Task::find($task_id);
            if(!$task){
                throw new Exception('Task not found');
            }

            if($task->Assigned_to != $user->id){ // test if Auth user can update task status
                throw new HttpException(403, 'You cant update status for this task');
            }

            if($task->subTasks()->where('status','!=','Completed')->exists()){
                throw new Exception('this task is dependence on other tasks');
            }

            Task_status_update::create([
                'task_id'=>$task->id,
                'previous_status'=>$task->status ,
                'new_status'=>$data['status']
            ]);
            $task->update($data);

            /**
             * In order to make sure that all the Associated subtasks are complete
             */
            Task::whereHas('subTasks')
                ->whereDoesntHave('subTasks', function ($query) {
                $query->where('status', '!=', 'Completed');
            })
            ->update(['status' => 'Open']);


            return $task ;
        }catch(HttpException $e){
            Log::error('Error When change status Task '.$e->getMessage());
            throw new HttpException(403,'There is an error in server '.$e->getMessage());
        }catch(Exception $e){
            Log::error('Error When change status task '.$e->getMessage());
            throw new HttpException(500, 'An unexcpected error occurred');
        }
    }
    /**
     * Summary of changeAssignedUserTask
     * @param mixed $user_id
     * @param mixed $task_id
     * @throws \Exception
     */
    public function changeAssignedUserTask($user_id,$task_id){
        try{
            $task = Task::findOrFail($task_id);
            $task->Assigned_to = $user_id; // Changing the user assigned to the task
            $task->save();

            return $task ;
        }catch(Exception $e){
            Log::error('Error When Change Assigned to new user '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of assignTaskToUser
     * @param mixed $data
     * @param mixed $task_id
     * @throws \Exception
     */
    public function assignTaskToUser($data, $task_id){
        try{
            $task = Task::findOrFail($task_id);
            $task->Assigned_to = $data['Assigned_to']; // Assign Task To User
            $task->status = 'In_Progress';
            $task->save();

            Task_status_update::create([
                'task_id'=>$task->id,
                'previous_status'=>$task->status ,
                'new_status'=>'In_Progress'
            ]);

            return $task;
        }catch(Exception $e){
            Log::error('Error When Assign Task To User '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    // public function getReportTaskDaily(Request $request){
    //     try{
    //         $query = Task::query();
    //         $report_type = $request->input('report_type');
    //         if($request->has('status')){
    //             $query->where('status',$request->input('status'));
    //             $report = $query->get();
    //             return $report;
    //         }
    //         if($request->has('due_date')){
    //             $query->where('due_date','<',$request->input('status'))->where('status','!=','completed');
    //             $report = $query->get();
    //             return $report;
    //         }
    //         if($request->has('Assigned_to')){
    //             $query->where('Assigned_to','=',$request->input('Assigned_to'));
    //             $report = $query->get();
    //             return $report;
    //         }

    //     }catch(Exception $e){
    //         Log::error('Error When Creaet Report '.$e->getMessage());
    //         throw new Exception('There is an error in server '.$e->getMessage());
    //     }
    // }
}
