<?php

namespace App\Service\File;

use App\Entity\File\File;
use App\File\FilesystemFactory;
use Illuminate\Support\Facades\Storage;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RemoveFileService
{
    public function __construct(
        private FilesystemFactory $filesystemFactory,
    ) {
    }

    public function remove(File $file): void
    {
        $this->removeFromStorage($file);
        $this->removeEntity($file);
    }

    private function removeEntity(File $file): void
    {
        EntityManager::remove($file);
    }

    private function removeFromStorage(File $file): void
    {
        $filesystem = $this->filesystemFactory->get($file->getStorage());

        $filesystem->remove($file->getPath());
    }
}
