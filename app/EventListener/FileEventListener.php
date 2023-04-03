<?php

namespace App\EventListener;

use App\Event\File\FileRemovedEvent;
use App\Service\File\RemoveFileService;
use Illuminate\Events\Dispatcher;

class FileEventListener
{
    public function __construct(
        private RemoveFileService $removeFileService,
    ) {
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            FileRemovedEvent::class,
            [self::class, 'removeFile']
        );
    }

    public function removeFile(FileRemovedEvent $event): void
    {
        $this->removeFileService->remove($event->getFile());
    }
}
