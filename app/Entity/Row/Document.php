<?php

namespace App\Entity\Row;

use App\Entity\File\DocumentFile;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Row::class, inversedBy: 'documents')]
    private ?Row $row;

    #[ORM\OneToOne(inversedBy: 'document', targetEntity: DocumentFile::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private DocumentFile $file;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Document
     */
    public function setId(?int $id): Document
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Row|null
     */
    public function getRow(): ?Row
    {
        return $this->row;
    }

    /**
     * @param Row|null $row
     * @return Document
     */
    public function setRow(?Row $row): Document
    {
        $this->row = $row;
        return $this;
    }

    /**
     * @return DocumentFile
     */
    public function getFile(): DocumentFile
    {
        return $this->file;
    }

    /**
     * @param DocumentFile $file
     * @return Document
     */
    public function setFile(DocumentFile $file): Document
    {
        $this->file = $file;
        return $this;
    }
}
