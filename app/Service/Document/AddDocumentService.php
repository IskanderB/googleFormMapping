<?php

namespace App\Service\Document;

use App\Entity\File\Layout;
use App\Entity\Row\Row;
use App\Entity\Task\TaskField;
use App\Event\Document\AfterAddDocumentsEvent;
use App\Event\Document\BeforeAddDocumentsEvent;
use App\Message\GenerateDocumentMessage;
use App\Repository\RowRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddDocumentService
{
    public function __construct(
        private RowRepository $rowRepository,
        private GenerateDocumentService $documentService,
    ) {
    }

    public function addDocumentsMultiple(array $rowIds): void
    {
        foreach ($rowIds as $rowId) {
            $row = $this->rowRepository->find($rowId);

            if ($row === null) {
                throw new NotFoundHttpException('Row is not exists');
            }

            $this->addDocuments($row);
        }
    }

    public function addDocuments(Row $row): void
    {
        if ($row->getDocuments()->isEmpty() === false) {
            return;
        }

        BeforeAddDocumentsEvent::dispatch($row);

        /** @var Layout $layout */
        foreach ($row->getTask()->getLayouts() as $layout) {
            GenerateDocumentMessage::dispatch($row->getId(), $layout->getId());
        }
    }

    public function documentProcessing(int $rowId, int $layoutId): void
    {
        /** @var Row $row */
        $row = $this->rowRepository->find($rowId);

        $document = $this->documentService->generate($layoutId, $this->prepareContext($row));

        $row->addDocument($document);

        EntityManager::persist($row);
        EntityManager::flush();

        if ($this->checkAllDocumentsAdded($row)) {
            AfterAddDocumentsEvent::dispatch($row);
        }
    }

    private function checkAllDocumentsAdded(Row $row): bool
    {
        $countLayouts = $row->getTask()->getLayouts()->count();
        $countDocuments = $row->getDocuments()->count();

        return $countLayouts <= $countDocuments;
    }

    public function prepareContext(Row $row): array
    {
        $fields = $row->getTask()->getReplacebleFields();

        $rowContextRaw = $row->getContent();

        $rowContext = [];

        foreach ($rowContextRaw as $key => $value) {
            $rowContext[preg_replace('/\s+/', ' ', $key)] = $value;
        }

        $context = [];

        /** @var TaskField $field */
        foreach ($fields as $field) {
            $sheetKey = $field->getSheetKey();

            if (!isset($rowContext[$sheetKey])) {
                continue;
            }

            $context[$field->getDocumentKey()] = $rowContext[$sheetKey];
        }

        $context[$row->getTask()->getIndexField()->getDocumentKey()] = $row->getId();

        return $context;
    }
}
