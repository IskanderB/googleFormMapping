<?php

namespace App\Service\Row;

use App\Entity\Row\Row;
use App\Entity\Task\TaskField;
use App\Repository\RowRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RowService
{
    public function __construct(
        private RowRepository $rowRepository,
        private DocumentService $documentService,
    ) {
    }

    public function createDocument(int $rowId, int $layoutId): void
    {
        /** @var Row $row */
        $row = $this->rowRepository->find($rowId);

        $document = $this->documentService->create($layoutId, $this->prepareContext($row));

        $row->addDocument($document);

        EntityManager::persist($row);
        EntityManager::flush();

    }

    public function prepareContext(Row $row): array
    {
        $fields = $row->getTask()->getFields();

        $rowContext = $row->getContent()->getContent();

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
