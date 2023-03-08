<?php

namespace App\Entity;

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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $preview = null;

    #[ORM\OneToMany(mappedBy: 'task', targetEntity: Row::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $rows;

    #[ORM\OneToMany(mappedBy: 'task', targetEntity: TaskField::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $fields;

    public function __construct()
    {
        $this->rows = new ArrayCollection();
        $this->fields = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Task
     */
    public function setId(?int $id): Task
    {
        $this->id = $id;
        return $this;
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
     * @return string|null
     */
    public function getPreview(): ?string
    {
        return $this->preview;
    }

    /**
     * @param string|null $preview
     * @return Task
     */
    public function setPreview(?string $preview): Task
    {
        $this->preview = $preview;
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
    public function getFields(): Collection
    {
        return $this->fields;
    }

    /**
     * @param TaskField $field
     * @return $this
     */
    public function addField(TaskField $field): self
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);

            $field->setTask($this);
        }

        return $this;
    }

    /**
     * @param TaskField $field
     * @return $this
     */
    public function removeField(TaskField $field): self
    {
        if ($this->fields->contains($field)) {
            $this->fields->removeElement($field);

            $field->setTask(null);
        }

        return $this;
    }
}
