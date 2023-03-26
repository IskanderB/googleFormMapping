<?php

namespace App\Service\Row;

use App\Dto\ShowDocumentDto;
use App\Dto\ShowRowDto;
use App\Entity\Task\Task;
use App\Repository\RowRepository;
use App\Url\GoogleDocUrl;

class RowService
{
    public function __construct(
        private RowRepository $rowRepository,
    ) {
    }

    public function get(Task $task): array
    {
        $rawRows = $this->rowRepository->getRows($task);

        $rows = [];

        foreach ($rawRows as $rawRow) {
            $rows[] = $this->buildRow($rawRow);
        }

        return $rows;
    }

    private function buildRow(array $rawRow): ShowRowDto
    {
        return (new ShowRowDto())
            ->setId($rawRow['id'])
            ->setContent($rawRow['content'])
            ->setDocuments($this->buildDocuments($rawRow['documents']));
    }

    private function buildDocuments(array $rawDocuments): array
    {
        $documents = [];

        foreach ($rawDocuments as $rawDocument) {
            $document = $this->buildDocument($rawDocument);

            if ($document === null) {
                continue;
            }

            $documents[] = $document;
        }

        return $documents;
    }

    private function buildDocument(array $rawDocument): ?ShowDocumentDto
    {
        if ($rawDocument['cloudId'] === null && $rawDocument['path'] === null) {
            return null;
        }

        return (new ShowDocumentDto())
            ->setOriginalName($rawDocument['originalName'])
            ->setUrl(
                $rawDocument['cloudId']
                    ? new GoogleDocUrl($rawDocument['cloudId'])
                    : $rawDocument['path']
            );
    }
}
