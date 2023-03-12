<?php

namespace App\Entity\Row;

use App\Entity\Task\Task;
use App\Repository\RowRepository;
use App\ValueObject\Content;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RowRepository::class)]
class Row
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Embedded(class: Content::class, columnPrefix: false)]
    private Content $content;

    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'rows')]
    private ?Task $task;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }

    /**
     * @param Content $content
     * @return Row
     */
    public function setContent(Content $content): Row
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Task|null
     */
    public function getTask(): ?Task
    {
        return $this->task;
    }

    /**
     * @param Task|null $task
     * @return Row
     */
    public function setTask(?Task $task): Row
    {
        $this->task = $task;
        return $this;
    }
}
