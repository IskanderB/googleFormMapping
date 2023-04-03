<?php

namespace App\Service;

use App\Entity\Task\Task;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RemoveTaskService
{
    public function remove(Task $task): void
    {
        EntityManager::remove($task);
        EntityManager::flush();
    }
}
