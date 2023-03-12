<?php

namespace App\Entity\File;

use App\Entity\Row\Document;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DocumentFile extends File
{
    #[ORM\OneToOne(mappedBy: 'file', targetEntity: Document::class)]
    private Document $document;

    /**
     * @return Document
     */
    public function getDocument(): Document
    {
        return $this->document;
    }

    /**
     * @param Document $document
     * @return DocumentFile
     */
    public function setDocument(Document $document): DocumentFile
    {
        $this->document = $document;
        return $this;
    }
}
