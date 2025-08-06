<?php

namespace App\Service;

use App\Entity\Lock\Lock;
use App\Entity\Row\Row;
use App\Entity\Task\Task;
use App\Event\Row\RowCreatedEvent;
use App\Event\Task\AfterTaskRefreshEvent;
use App\Event\Task\BeforeTaskRefreshEvent;
use App\Message\TaskMessage;
use App\Repository\RowRepository;
use App\Repository\TaskRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RefreshTaskService
{
    public function __construct(
        private SheetManager $sheetManager,
        private RowRepository $rowRepository,
        private TaskRepository $taskRepository,
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
        BeforeTaskRefreshEvent::dispatch($task);

        TaskMessage::dispatch($task->getId());
    }

    public function handle(int $taskId): void
    {
        /** @var Task $task */
        $task = $this->taskRepository->find($taskId);

        $rows = $this->sheetManager->getRows($task);

        foreach ($rows as $content) {
            if ($this->rowRepository->exists($task, $content)) {
                continue;
            }

            $rowEntity = (new Row())
                ->setContent($content)
                ->setLock(new Lock());

            EntityManager::persist($rowEntity);

            $task->addRow($rowEntity);

//            EntityManager::flush();

//            RowCreatedEvent::dispatch($rowEntity);
        }
EntityManager::flush();

foreach ($task->getRows() as $rowEntity) {
            RowCreatedEvent::dispatch($rowEntity);
        }

        AfterTaskRefreshEvent::dispatch($task);
    }
}
