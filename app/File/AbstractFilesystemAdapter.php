<?php

namespace App\File;

use App\Exceptions\FilesystemException;
use Illuminate\Support\Facades\Storage;

abstract class AbstractFilesystemAdapter implements FilesystemAdapterInterface
{
    public function __construct(
        protected string $storage,
    ) {
    }

    public function write(string $path, string $content): void
    {
        Storage::disk($this->storage)->put($path, $content);
    }

    public function writeStream(string $path, $content): void
    {
        Storage::disk($this->storage)->writeStream($path, $content);
    }

    public function read(string $path): string
    {
        return Storage::disk($this->storage)->get($path);
    }

    public function readStream(string $path)
    {
        return Storage::disk($this->storage)->readStream($path);
    }

    public function getShowUrl(string $path): ?string
    {
        return null;
    }

    public function remove(string $path): void
    {
        $success = Storage::disk($this->storage)->delete($path);

        if ($success) {
            return;
        }

        throw new FilesystemException('File deleting is failed');
    }
}
