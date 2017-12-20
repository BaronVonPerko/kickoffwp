<?php

namespace App\Console\Commands;

use App\Jobs\ClearStorage;
use Illuminate\Console\Command;

class CleanStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans the public storage directory';

    protected $job;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->job = new ClearStorage();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->job->handle();
    }
}
