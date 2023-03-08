<?php

namespace App\Service;

use App\Entity\Row;
use App\Entity\Task;
use App\Message\TaskMessage;
use App\Repository\RowRepository;
use App\Repository\TaskRepository;
use App\ValueObject\Content;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RefreshTaskService
{
    public function __construct(
        private SheetManager $sheetManager,
        private RowRepository $rowRepository,
        private TaskRepository $taskRepository
    ) {
    }

    public function refreshAll(): void
    {
        foreach ($this->taskRepository->findAll() as $task) {
            $this->refresh($task);
        }
    }

    public function refresh(Task $task): void
    {
        TaskMessage::dispatch($task->getId());
    }

    public function handle(int $taskId): void
    {
        /** @var Task $task */
        $task = $this->taskRepository->find($taskId);

        $rows = $this->sheetManager->getRows($task);

        foreach ($rows as $row) {
            $content = new Content($row);

            if ($this->rowRepository->exists($task, $content)) {
                continue;
            }

            $rowEntity = (new Row())->setContent($content);

            EntityManager::persist($rowEntity);

            $task->addRow($rowEntity);
        }

        EntityManager::flush();
    }
}