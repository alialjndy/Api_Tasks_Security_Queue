<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\CreateReportRequest;
use App\Jobs\GenerateDailyReport;
use App\Response\ApiResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate(){
        GenerateDailyReport::dispatch('in_progress_tasks');
        GenerateDailyReport::dispatch('overdue_tasks');
        GenerateDailyReport::dispatch('blocked_tasks');
        GenerateDailyReport::dispatch('completed_tasks');
        return ApiResponse::success('Report Generation in progress',200);
    }
    public function filterReportGenerate(CreateReportRequest $request){
        $data = $request->validated();
        GenerateDailyReport::dispatch($data);
        return ApiResponse::success('Report Generation In Progress',200);
    }
}
