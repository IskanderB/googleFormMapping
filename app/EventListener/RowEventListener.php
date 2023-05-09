<?php

namespace App\EventListener;

use App\Event\Row\RowCreatedEvent;
use App\Service\Document\AddDocumentService;
use Illuminate\Events\Dispatcher;

class RowEventListener
{
    public function __construct(
        private readonly AddDocumentService $addDocumentService,
    ) {
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            RowCreatedEvent::class,
            [self::class, 'addDocuments'],
        );
    }

    public function addDocuments(RowCreatedEvent $event): void
    {
        $row = $event->getRow();

        $this->addDocumentService->addDocuments($row);
    }
}
