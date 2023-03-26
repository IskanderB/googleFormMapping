<?php

namespace App\Dto;

class ShowDocumentDto
{
    private string $url;
    private string $originalName;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return ShowDocumentDto
     */
    public function setUrl(string $url): ShowDocumentDto
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     * @return ShowDocumentDto
     */
    public function setOriginalName(string $originalName): ShowDocumentDto
    {
        $this->originalName = $originalName;
        return $this;
    }
}
