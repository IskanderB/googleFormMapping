<?php

namespace App\Service\Row;

use App\Entity\Row\Row;
use App\Event\File\FileRemovedEvent;
use App\Repository\RowRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RowService
{
    public function __construct(
        private RowRepository $rowRepository,
    ) {
    }

    public function removeDocumentsMultiple(array $rowIds): void
    {
        foreach ($rowIds as $rowId) {
            $row = $this->rowRepository->find($rowId);

            if ($row === null) {
                throw new NotFoundHttpException('Row is not exists');
            }

            $this->removeDocuments($row);
        }
    }

    public function removeDocuments(Row $row): void
    {
        foreach ($row->getDocuments() as $document) {
            $row->removeDocument($document);

            FileRemovedEvent::dispatch($document);
        }

        EntityManager::flush();
    }
}
