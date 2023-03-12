<?php

namespace App\Entity\Task;

use App\Entity\File\LayoutFile;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Layout
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'layouts')]
    private ?Task $task;

    #[ORM\OneToOne(inversedBy: 'layout', targetEntity: LayoutFile::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private LayoutFile $file;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Layout
     */
    public function setId(?int $id): Layout
    {
        $this->id = $id;
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
     * @return Layout
     */
    public function setTask(?Task $task): Layout
    {
        $this->task = $task;
        return $this;
    }

    /**
     * @return LayoutFile
     */
    public function getFile(): LayoutFile
    {
        return $this->file;
    }

    /**
     * @param LayoutFile $file
     * @return Layout
     */
    public function setFile(LayoutFile $file): Layout
    {
        $this->file = $file;
        return $this;
    }
}
