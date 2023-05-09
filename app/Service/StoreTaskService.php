<?php

namespace App\Service;

use App\Entity\File\Layout;
use App\Entity\Task\Task;
use App\Event\Task\TaskCreatedEvent;
use App\Service\File\UploadFileService;
use App\Entity\Lock\Lock;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Throwable;

class StoreTaskService
{
    public function __construct(
        private UploadFileService $uploadFileService,
    ) {
    }

    /**
     * @param Task $task
     * @param UploadedFile[] $layoutFiles
     *
     * @return void
     *
     * @throws Throwable
     */
    public function store(Task $task, array $layoutFiles): void
    {
        try {
            EntityManager::beginTransaction();

            foreach ($layoutFiles as $layoutFile) {
                $task
                    ->addLayout(
                    $this->uploadFileService->upload(
                        uploadedFile: $layoutFile,
                        storage: 'layout',
                        class: Layout::class,
                    )
                );
            }

            $task->setLock(new Lock());

            EntityManager::persist($task);
            EntityManager::flush();

            EntityManager::commit();

            TaskCreatedEvent::dispatch($task);
        } catch (Throwable $throwable) {
            EntityManager::rollback();

            throw $throwable;
        }
    }
}
