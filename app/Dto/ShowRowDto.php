<?php

namespace App\Dto;

class ShowRowDto
{
    private int $id;
    private array $content = [];
    private array $documents = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ShowRowDto
     */
    public function setId(int $id): ShowRowDto
    {
        $this->id = $id;
        return $this;
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
     * @return ShowRowDto
     */
    public function setContent(array $content): ShowRowDto
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    /**
     * @param array $documents
     * @return ShowRowDto
     */
    public function setDocuments(array $documents): ShowRowDto
    {
        $this->documents = $documents;
        return $this;
    }
}
