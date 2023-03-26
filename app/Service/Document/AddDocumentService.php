<?php

namespace App\Service\Document;

use App\Entity\Row\Row;
use App\Entity\Task\Layout;
use App\Entity\Task\TaskField;
use App\Message\GenerateDocumentMessage;
use App\Repository\RowRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AddDocumentService
{
    public function __construct(
        private RowRepository $rowRepository,
        private GenerateDocumentService $documentService,
    ) {
    }

    public function addDocuments(Row $row): void
    {
        if ($row->getDocuments()->isEmpty() === false) {
            return;
        }

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

    }

    private function prepareContext(Row $row): array
    {
        $fields = $row->getTask()->getFields();

        $rowContext = $row->getContent();

        $context = [];

        /** @var TaskField $field */
        foreach ($fields as $field) {
            $sheetKey = $field->getSheetKey();

            if (!isset($rowContext[$sheetKey])) {
                continue;
            }

            $context[$field->getDocumentKey()] = $rowContext[$sheetKey];
        }

        return $context;
    }
}
