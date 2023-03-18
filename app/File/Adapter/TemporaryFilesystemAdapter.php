<?php

namespace App\File\Adapter;

use App\File\AbstractFilesystemAdapter;

class TemporaryFilesystemAdapter extends AbstractFilesystemAdapter
{
    public function getDriver(): string
    {
        return 'local';
    }
}
