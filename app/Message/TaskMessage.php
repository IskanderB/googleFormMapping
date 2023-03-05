<?php

namespace App\Message;

use App\Service\RefreshTaskService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaskMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $taskId
    ) {
    }

    public function handle(RefreshTaskService $refreshTaskService): void
    {
        $refreshTaskService->handle($this->taskId);
    }
}
