<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateDailyReport;
use App\Response\ApiResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate(Request $request){


        GenerateDailyReport::dispatch($request->input('report_type'));
        return ApiResponse::success('Report Generation in progress',200);
    }
}
