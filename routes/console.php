<?php

use App\Console\Commands\GenerateReport;
use App\Jobs\GenerateDailyReport;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Schedule::job(new GenerateDailyReport('completed'))->daily();
// Schedule::job(new GenerateDailyReport('overdue'))->daily();
