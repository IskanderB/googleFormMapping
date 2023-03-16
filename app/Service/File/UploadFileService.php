<?php

namespace App\Service\File;

use App\Entity\File\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService extends FileService
{
    public function upload(UploadedFile $uploadedFile, string $storage, string $class): File
    {
        if (!is_a($class, File::class, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Класс %s не наследует %s',
                    $class,
                    File::class
                )
            );
        }

        /** @var File $file */
        $file = new $class();

        $directoryPath = $this->getPath();
        $filename = $this->getNewFilename($uploadedFile);
        $path = $directoryPath . '/' . $filename;

        $stream = fopen($uploadedFile->getPathname(), 'r');
        Storage::disk($storage)->put($path, $stream);

        // storage
        $file->setStorage($storage);
        // originalName
        $file->setOriginalName($uploadedFile->getClientOriginalName());
        // path
        $file->setPath($path);
        // filename
        $file->setFilename($filename);
        // extension
        $file->setExtension($uploadedFile->guessExtension());
        // mimeType
        $file->setMimeType($uploadedFile->getMimeType());
        // size
        $file->setSize(max(0, $uploadedFile->getSize()));

        EntityManager::persist($file);
        EntityManager::flush();

        return $file;
    }

    private function getNewFilename(UploadedFile $uploadedFile): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = Str::slug($originalFilename);

        return $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
    }
}
