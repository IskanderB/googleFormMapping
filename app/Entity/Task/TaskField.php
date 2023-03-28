<?php

namespace App\Entity\Task;

use App\Entity\Task\Field\IndexField;
use App\Entity\Task\Field\PreviewField;
use App\Entity\Task\Field\ReplacebleField;
use App\Repository\TaskFieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskFieldRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'replaceble' => ReplacebleField::class,
    'index' => IndexField::class,
    'preview' => PreviewField::class,
])]
abstract class TaskField
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sheetKey = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $documentKey = null;

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
}
