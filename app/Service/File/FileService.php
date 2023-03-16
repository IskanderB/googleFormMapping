<?php

namespace App\Service\File;

class FileService
{
    protected function getPath(): string
    {
        return date('Y/m/d');
    }
}
