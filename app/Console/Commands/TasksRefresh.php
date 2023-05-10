<?php

namespace App\Console\Commands;

use App\Service\RefreshTaskService;
use Illuminate\Console\Command;

class TasksRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tasks:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh all tasks';

    public function __construct(
        private readonly RefreshTaskService $refreshTaskService,
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->refreshTaskService->refreshAll();
    }
}
