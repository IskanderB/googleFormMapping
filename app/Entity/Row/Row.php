<?php

namespace App\Entity\Row;

use App\Entity\File\Document;
use App\Entity\Task\Task;
use App\Repository\RowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RowRepository::class)]
class Row
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'jsonb', nullable: false, options: ['jsonb' => true])]
    private array $content = [];

    #[ORM\ManyToOne(targetEntity: Task::class, inversedBy: 'rows')]
    private ?Task $task;

    #[ORM\JoinTable(name: 'rows_documents')]
    #[ORM\JoinColumn(name: 'row_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'document_id', referencedColumnName: 'id', unique: true)]
    #[ORM\ManyToMany(targetEntity: Document::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $documents;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * @param array $content
     * @return Row
     */
    public function setContent(array $content): Row
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

    /**
     * @return Collection
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    /**
     * @param Document $document
     * @return Row
     */
    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
        }

        return $this;
    }

    /**
     * @param Document $document
     * @return Row
     */
    public function removeDocument(Document $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
        }

        return $this;
    }
}
