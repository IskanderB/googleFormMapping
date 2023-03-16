<?php

namespace App\Document;

use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DocumentReplacer
{
    public function replace($stream, array $context, ?string $mimeType = null): UploadedFile
    {
        $temporaryFilepath = $this->createTemporaryFile($stream);

        $processor = new TemplateProcessor($temporaryFilepath);

        foreach ($context as $search => $replace) {
            $processor->setValue($this->prepareSearch($search), $replace);
        }

        $processor->saveAs($temporaryFilepath);

        return $this->getTemporaryFile($temporaryFilepath);
    }

    private function createTemporaryFile($stream): string
    {
        if (false === is_resource($stream)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument must be a valid resource type. %s given.',
                    gettype($stream)
                )
            );
        }

        // Temporary file system

        $temporaryFilename = $this->getNewTemporaryFilename();

        Storage::disk('temporary')->writeStream($temporaryFilename, $stream);

        return $this->getNewTemporaryFilepath($temporaryFilename);
    }

    public function getNewTemporaryFilepath(string $temporaryFilename): string
    {
        return sys_get_temp_dir() . '/' . $temporaryFilename;
    }

    private function getNewTemporaryFilename(): string
    {
        return uniqid('temporary_file-', true);
    }

    private function prepareSearch(string $search): string
    {
        return '{' . ltrim(rtrim($search, '}'), '{') . '}';
    }

    private function getTemporaryFile(string $temporaryFilepath, ?string $mimeType = null): UploadedFile
    {
        return new UploadedFile(
            path: $temporaryFilepath,
            originalName: 'replaced_document',
            mimeType: $mimeType,
        );
    }
}
