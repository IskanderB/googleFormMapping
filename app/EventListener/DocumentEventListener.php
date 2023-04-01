<?php

namespace App\EventListener;

use App\Event\Document\AfterAddDocumentsEvent;
use App\Event\Document\BeforeAddDocumentsEvent;
use App\Service\Lock\LockService;
use Illuminate\Events\Dispatcher;

class DocumentEventListener
{
    public function __construct(
        private LockService $lockService,
    ) {
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            BeforeAddDocumentsEvent::class,
            [self::class, 'lockRow'],
        );

        $events->listen(
            AfterAddDocumentsEvent::class,
            [self::class, 'unLockRow'],
        );
    }

    public function unLockRow(AfterAddDocumentsEvent $event): void
    {
        $row = $event->getRow();

        $this->lockService->unLock($row->getLock());
    }

    public function lockRow(BeforeAddDocumentsEvent $event): void
    {
        $row = $event->getRow();

        $this->lockService->lock($row->getLock());
    }
}
