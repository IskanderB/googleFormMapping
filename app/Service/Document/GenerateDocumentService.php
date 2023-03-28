<?php

namespace App\Service\Document;

use App\Document\DocumentReplacer;
use App\Entity\File\Document;
use App\Entity\File\Layout;
use App\Repository\FileRepository;
use App\Service\File\UploadFileService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GenerateDocumentService
{
    public function __construct(
        private FileRepository    $fileRepository,
        private UploadFileService $uploadFileService,
        private DocumentReplacer  $documentReplacer,
    ) {
    }

    public function generate(int $layoutId, array $context): Document
    {
        /** @var Layout $layout */
        $layout = $this->fileRepository->find($layoutId);

        $temporaryFile = $this->documentReplacer->replace(
            Storage::disk($layout->getStorage())->readStream($layout->getPath()),
            context: $context,
        );

        /** @var Document $document */
        $document = $this->uploadFileService->upload(
            uploadedFile: new UploadedFile(
                path: $temporaryFile->getRealPath(),
                originalName: $layout->getOriginalName(),
                mimeType: $layout->getMimeType(),
            ),
            storage: 'document',
            class: Document::class,
        );

        return $document;
    }
}
