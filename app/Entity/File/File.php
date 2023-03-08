<?php

namespace App\Entity\File;

use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'layout' => Layout::class,
    'document' => Document::class,
])]
abstract class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'uuid', unique: true, nullable: false)]
    private ?UuidInterface $uuid = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $storage = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $originalName = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $path = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $filename = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $extension = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $mimeType = null;

    #[ORM\Column(nullable: false)]
    private ?int $size = null;

    #[ORM\Column(nullable: false)]
    private ?DateTime $createdAt = null;

    public function __construct()
    {
        $this->uuid ??= Uuid::uuid4();
        $this->createdAt ??= new DateTime();
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
     * @return File
     */
    public function setId(?int $id): File
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return UuidInterface|null
     */
    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @param UuidInterface|null $uuid
     * @return File
     */
    public function setUuid(?UuidInterface $uuid): File
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStorage(): ?string
    {
        return $this->storage;
    }

    /**
     * @param string|null $storage
     * @return File
     */
    public function setStorage(?string $storage): File
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    /**
     * @param string|null $originalName
     * @return File
     */
    public function setOriginalName(?string $originalName): File
    {
        $this->originalName = $originalName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     * @return File
     */
    public function setPath(?string $path): File
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return File
     */
    public function setFilename(?string $filename): File
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @param string|null $extension
     * @return File
     */
    public function setExtension(?string $extension): File
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string|null $mimeType
     * @return File
     */
    public function setMimeType(?string $mimeType): File
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     * @return File
     */
    public function setSize(?int $size): File
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     * @return File
     */
    public function setCreatedAt(?DateTime $createdAt): File
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
