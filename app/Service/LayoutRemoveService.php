<?php

namespace App\Service;

use App\Entity\File\Layout;
use App\Entity\Task\Task;
use App\Event\File\FileRemovedEvent;
use LaravelDoctrine\ORM\Facades\EntityManager;

class LayoutRemoveService
{
    public function removeLayout(Layout $layout, Task $task): void
    {
        $task->removeLayout($layout);

        FileRemovedEvent::dispatch($layout);

        EntityManager::flush();
    }
}
