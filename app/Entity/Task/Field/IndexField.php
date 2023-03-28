<?php

namespace App\Entity\Task\Field;

use App\Entity\Task\Task;
use App\Entity\Task\TaskField;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class IndexField extends TaskField
{
    #[ORM\OneToOne(inversedBy: 'indexField', targetEntity: Task::class)]
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
     * @return IndexField
     */
    public function setTask(?Task $task): self
    {
        $this->task = $task;
        return $this;
    }
}
