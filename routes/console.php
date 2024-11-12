<?php

use App\Console\Commands\GenerateReport;
use App\Jobs\GenerateDailyReport;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

app()->booted(function(){
    $schedule = app(Schedule::class);
    $schedule->command('app:generate-report')->daily();
});
