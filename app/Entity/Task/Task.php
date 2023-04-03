<?php

namespace App\Entity\Task;

use App\Entity\Lock\Lock;
use App\Entity\File\Layout;
use App\Entity\Row\Row;
use App\Entity\Task\Field\IndexField;
use App\Entity\Task\Field\PreviewField;
use App\Entity\Task\Field\ReplacebleField;
use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $spreadsheetId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sheetName = null;

    #[ORM\OneToOne(mappedBy: 'task', targetEntity: IndexField::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private IndexField $indexField;

    #[ORM\OneToOne(mappedBy: 'task', targetEntity: PreviewField::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private PreviewField $previewField;

    #[ORM\JoinColumn(name: 'lock_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\OneToOne(targetEntity: Lock::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private ?Lock $lock = null;

    #[ORM\OneToMany(mappedBy: 'task', targetEntity: Row::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['id' => 'DESC'])]
    private Collection $rows;

    #[ORM\OneToMany(mappedBy: 'task', targetEntity: ReplacebleField::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $replacebleFields;

    #[ORM\JoinTable(name: 'tasks_layouts')]
    #[ORM\JoinColumn(name: 'task_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'layout_id', referencedColumnName: 'id', unique: true)]
    #[ORM\ManyToMany(targetEntity: Layout::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $layouts;

    public function __construct()
    {
        $this->rows = new ArrayCollection();
        $this->replacebleFields = new ArrayCollection();
        $this->layouts = new ArrayCollection();
    }

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Task
     */
    public function setName(?string $name): Task
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpreadsheetId(): ?string
    {
        return $this->spreadsheetId;
    }

    /**
     * @param string|null $spreadsheetId
     * @return Task
     */
    public function setSpreadsheetId(?string $spreadsheetId): Task
    {
        $this->spreadsheetId = $spreadsheetId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSheetName(): ?string
    {
        return $this->sheetName;
    }

    /**
     * @param string|null $sheetName
     * @return Task
     */
    public function setSheetName(?string $sheetName): Task
    {
        $this->sheetName = $sheetName;
        return $this;
    }

    /**
     * @return IndexField
     */
    public function getIndexField(): IndexField
    {
        return $this->indexField;
    }

    /**
     * @param IndexField $indexField
     * @return Task
     */
    public function setIndexField(IndexField $indexField): Task
    {
        $this->indexField = $indexField;

        $indexField->setTask($this);

        return $this;
    }

    /**
     * @return PreviewField
     */
    public function getPreviewField(): PreviewField
    {
        return $this->previewField;
    }

    /**
     * @param PreviewField $previewField
     * @return Task
     */
    public function setPreviewField(PreviewField $previewField): Task
    {
        $this->previewField = $previewField;

        $previewField->setTask($this);

        return $this;
    }

    /**
     * @return Lock|null
     */
    public function getLock(): ?Lock
    {
        return $this->lock;
    }

    /**
     * @param Lock|null $lock
     * @return Task
     */
    public function setLock(?Lock $lock): Task
    {
        $this->lock = $lock;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getRows(): Collection
    {
        return $this->rows;
    }

    /**
     * @param Row $row
     * @return $this
     */
    public function addRow(Row $row): self
    {
        if (!$this->rows->contains($row)) {
            $this->rows->add($row);

            $row->setTask($this);
        }

        return $this;
    }

    /**
     * @param Row $row
     * @return $this
     */
    public function removeRow(Row $row): self
    {
        if ($this->rows->contains($row)) {
            $this->rows->removeElement($row);

            $row->setTask(null);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getReplacebleFields(): Collection
    {
        return $this->replacebleFields;
    }

    /**
     * @param ReplacebleField $replacebleField
     * @return $this
     */
    public function addReplacebleField(ReplacebleField $replacebleField): self
    {
        if (!$this->replacebleFields->contains($replacebleField)) {
            $this->replacebleFields->add($replacebleField);

            $replacebleField->setTask($this);
        }

        return $this;
    }

    /**
     * @param ReplacebleField $replacebleField
     * @return $this
     */
    public function removeReplacebleField(ReplacebleField $replacebleField): self
    {
        if ($this->replacebleFields->contains($replacebleField)) {
            $this->replacebleFields->removeElement($replacebleField);

            $replacebleField->setTask(null);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getLayouts(): Collection
    {
        return $this->layouts;
    }

    /**
     * @param Layout $layout
     * @return Task
     */
    public function addLayout(Layout $layout): Task
    {
        if (!$this->layouts->contains($layout)) {
            $this->layouts->add($layout);
        }

        return $this;
    }

    /**
     * @param Layout $layout
     * @return $this
     */
    public function removeLayout(Layout $layout): self
    {
        if ($this->layouts->contains($layout)) {
            $this->layouts->removeElement($layout);
        }

        return $this;
    }
}
