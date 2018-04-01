<?php

namespace App\Console\Commands;

use App\Jobs\NightlyReport;
use Illuminate\Console\Command;

class RunNightlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force the nightly report to run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        NightlyReport::dispatch();
    }
}
