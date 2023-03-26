<?php

namespace App\Url;

use Illuminate\Support\Arr;
use Stringable;

class GoogleDocUrl implements Stringable
{
    private string $baseUrl = 'https://docs.google.com/document/d';
    private string $action = 'edit';
    private array $params = [
        'usp' => 'drive_web',
        'rtpof' => 'true',
    ];

    public function __construct(
        private string $driveCloudId,
    ) {
    }

    public function getUrl(): string
    {
        return url("{$this->baseUrl}/{$this->driveCloudId}/{$this->action}?") .Arr::query($this->params);
    }

    public function __toString(): string
    {
        return $this->getUrl();
    }
}
