<?php

namespace App\EventListener;

use App\Event\Task\AfterTaskRefreshEvent;
use App\Event\Task\BeforeTaskRefreshEvent;
use App\Service\Lock\LockService;
use Illuminate\Events\Dispatcher;

class TaskEventListener
{
    public function __construct(
        private LockService $lockService,
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
