<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;
use App\Response\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GenerateDailyReport implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    protected $reportType;

    public function __construct($reportType)
    {
        $this->reportType = $reportType;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info('Report generation initiated', ['reportType' => $this->reportType]);
        $query = Task::query();
        if($this->reportType == 'completed_tasks'){
            $tasks = $query->where('status','Completed')->get();
            Log::info('reported created successfully');
            Log::info('Completed tasks retrieved successfully', ['tasks' => $tasks]);
            return $tasks ;
        }
        if($this->reportType == 'in_progress_tasks'){
            $tasks = $query->where('status','In_Progress')->get();
            // Log::info('reported created successfully');
            Log::info('Completed tasks retrieved successfully', ['tasks' => $tasks]);
            return $tasks ;
        }
        if($this->reportType == 'blocked_tasks'){
            $tasks = $query->where('status','Blocked')->get();
            // Log::info('reported created successfully');
            Log::info('Completed tasks retrieved successfully', ['tasks' => $tasks]);
            return $tasks ;
        }
        if($this->reportType == 'overdue_tasks'){
            $tasks = $query->where('due_date','<',now())->get();
            // Log::info('reported created successfully');
            Log::info('Completed tasks retrieved successfully', ['tasks' => $tasks]);
            return $tasks ;
        }
        return ApiResponse::error('Reported Error',404);



    }
}

