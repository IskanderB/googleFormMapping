<?php

namespace App\Entity\Task;

use App\Repository\TaskFieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskFieldRepository::class)]
class TaskField
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $sheetKey = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $documentKey = null;

    #[ORM\Column(nullable: false, options: ['default' => false])]
    private bool $preview = false;

    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'fields')]
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
    public function getSheetKey(): ?string
    {
        return $this->sheetKey;
    }

    /**
     * @param string|null $sheetKey
     * @return TaskField
     */
    public function setSheetKey(?string $sheetKey): TaskField
    {
        $this->sheetKey = $sheetKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDocumentKey(): ?string
    {
        return $this->documentKey;
    }

    /**
     * @param string|null $documentKey
     * @return TaskField
     */
    public function setDocumentKey(?string $documentKey): TaskField
    {
        $this->documentKey = $documentKey;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPreview(): bool
    {
        return $this->preview;
    }

    /**
     * @param bool $preview
     * @return TaskField
     */
    public function setPreview(bool $preview): TaskField
    {
        $this->preview = $preview;
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
     * @return TaskField
     */
    public function setTask(?Task $task): TaskField
    {
        $this->task = $task;
        return $this;
    }
}
