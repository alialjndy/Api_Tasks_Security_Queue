<?php

namespace App\Console\Commands;

use App\Jobs\GenerateDailyReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schedule;

class GenerateReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Report and logs informations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        GenerateDailyReport::dispatch('in_progress_tasks');
        GenerateDailyReport::dispatch('overdue_tasks');
        GenerateDailyReport::dispatch('blocked_tasks');
        GenerateDailyReport::dispatch('completed_tasks');
    }
}
