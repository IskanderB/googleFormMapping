<?php

namespace App\Entity\File;

use App\Entity\Task\Task;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Layout extends File
{
    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'layouts')]
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
     * @return Layout
     */
    public function setTask(?Task $task): Layout
    {
        $this->task = $task;
        return $this;
    }
}
