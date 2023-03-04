<?php

namespace App\Entity;

use App\Repository\RowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RowRepository::class)]
class Row
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text', nullable: false)]
    private ?string $content = null;

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
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Row
     */
    public function setContent(?string $content): Row
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
