<?php

namespace App\Event\Task;

use App\Entity\Task\Task;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterTaskRefreshEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private Task $task,
    ) {
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }
}
