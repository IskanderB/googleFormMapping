<?php

namespace App\Service;

use App\Entity\File\LayoutFile;
use App\Entity\Task\Layout;
use App\Entity\Task\Task;
use App\Service\File\UploadFileService;
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
                $task->addLayout(
                    (new Layout())
                        ->setFile($this->uploadFileService->upload(
                            uploadedFile: $layoutFile,
                            storage: 'layout',
                            class: LayoutFile::class,
                        ))
                );
            }

            EntityManager::persist($task);
            EntityManager::flush();

            EntityManager::commit();
        } catch (Throwable $throwable) {
            EntityManager::rollback();

            throw $throwable;
        }
    }
}
