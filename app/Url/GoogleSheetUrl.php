<?php

namespace App\Url;

use Illuminate\Support\Str;

class GoogleSheetUrl
{
    private string $baseUrl = 'https://docs.google.com/spreadsheets/d';

    private function __construct(
        private string $cloudId,
    ) {
    }

    public static function fromUrl(string $url): self
    {
        $cloudId = Str::between($url, '/d/', '/');

        return new self($cloudId);
    }

    public static function fromCloudId(string $cloudId): self
    {
        return new self($cloudId);
    }

    public function getCloudId(): string
    {
        return $this->cloudId;
    }

    public function getUrl(): string
    {
        return url("{$this->baseUrl}/{$this->cloudId}");
    }
}
