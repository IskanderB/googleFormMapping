<?php

namespace App\Entity\File;

use App\Entity\Task;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Document extends File
{
    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'documents')]
    private ?Task $task;

    /**
     * @return Task|null
     */
    public function getTask(): ?Task
    {
        return $this->task;
    }

    /**
     * @param Task|null $task
     * @return Document
     */
    public function setTask(?Task $task): Document
    {
        $this->task = $task;
        return $this;
    }
}
