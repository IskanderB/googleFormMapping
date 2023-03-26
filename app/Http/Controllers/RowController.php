<?php

namespace App\Http\Controllers;

use App\Entity\Row\Row;
use App\Service\Document\AddDocumentService;
use Symfony\Component\HttpFoundation\JsonResponse;

class RowController extends Controller
{
    public function __construct(
        private AddDocumentService $addDocumentService,
    ) {
    }

    public function generate(Row $row): JsonResponse
    {
        $this->addDocumentService->addDocuments($row);

        return response()->json([
            'success' => true,
        ]);
    }
}
