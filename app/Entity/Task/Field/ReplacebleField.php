<?php

namespace App\Entity\Task\Field;

use App\Entity\Task\Task;
use App\Entity\Task\TaskField;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ReplacebleField extends TaskField
{
    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'replacebleFields')]
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
     * @return ReplacebleField
     */
    public function setTask(?Task $task): self
    {
        $this->task = $task;
        return $this;
    }
}
