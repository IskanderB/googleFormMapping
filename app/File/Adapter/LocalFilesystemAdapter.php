<?php

namespace App\File\Adapter;

use App\File\AbstractFilesystemAdapter;

class LocalFilesystemAdapter extends AbstractFilesystemAdapter
{
    public function getDriver(): string
    {
        return 'local';
    }
}
