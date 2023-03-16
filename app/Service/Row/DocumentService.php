<?php

namespace App\Service\Row;

use App\Document\DocumentReplacer;
use App\Entity\File\DocumentFile;
use App\Entity\Row\Document;
use App\Entity\Task\Layout;
use App\Repository\LayoutRepository;
use App\Service\File\UploadFileService;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function __construct(
        private LayoutRepository $layoutRepository,
        private UploadFileService $uploadFileService,
        private DocumentReplacer $documentReplacer,
    ) {
    }

    public function create(int $layoutId, array $context): Document
    {
        /** @var Layout $layout */
        $layout = $this->layoutRepository->find($layoutId);

        $layoutFile = $layout->getFile();

        $temporaryFile = $this->documentReplacer->replace(
            Storage::disk($layoutFile->getStorage())->readStream($layoutFile->getPath()),
            context: $context,
        );

        /** @var DocumentFile $documentFile */
        $documentFile = $this->uploadFileService->upload(
            uploadedFile: $temporaryFile,
            storage: 'document',
            class: DocumentFile::class,
        );

        return (new Document())
            ->setFile($documentFile);
    }
}
