<?php

namespace App\EventListener;

use App\Event\Task\AfterTaskRefreshEvent;
use App\Event\Task\BeforeTaskRefreshEvent;
use App\Event\Task\TaskCreatedEvent;
use App\Service\Lock\LockService;
use App\Service\RefreshTaskService;
use Illuminate\Events\Dispatcher;

class TaskEventListener
{
    public function __construct(
        private readonly LockService $lockService,
        private readonly RefreshTaskService $refreshTaskService,
    ) {
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            BeforeTaskRefreshEvent::class,
            [self::class, 'lockTask'],
        );

        $events->listen(
            AfterTaskRefreshEvent::class,
            [self::class, 'unLockTask'],
        );

        $events->listen(
            TaskCreatedEvent::class,
            [self::class, 'refreshTask'],
        );
    }

    public function refreshTask(TaskCreatedEvent $event): void
    {
        $task = $event->getTask();

        $this->refreshTaskService->refresh($task);
    }

    public function lockTask(BeforeTaskRefreshEvent $event): void
    {
        $task = $event->getTask();

        $this->lockService->lock($task->getLock());
    }

    public function unLockTask(AfterTaskRefreshEvent $event): void
    {
        $task = $event->getTask();

        $this->lockService->unLock($task->getLock());
    }
}
