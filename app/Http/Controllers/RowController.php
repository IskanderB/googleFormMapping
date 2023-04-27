<?php

namespace App\Http\Controllers;

use App\Entity\Row\Row;
use App\Service\Document\AddDocumentService;
use App\Service\Row\RowService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RowController extends Controller
{
    public function __construct(
        private AddDocumentService $addDocumentService,
        private RowService $rowService,
    ) {
    }

    public function generateMultiple(Request $request): JsonResponse
    {
        $rowIds = $request->json('rowIds');

        $this->addDocumentService->addDocumentsMultiple($rowIds);

        return response()->json([
            'success' => true,
        ]);
    }

    public function generate(Row $row): JsonResponse
    {
        $this->addDocumentService->addDocuments($row);

        return response()->json([
            'success' => true,
        ]);
    }

    public function removeDocumentsMultiple(Request $request): JsonResponse
    {
        $rowIds = $request->json('rowIds');

        $this->rowService->removeDocumentsMultiple($rowIds);

        return response()->json([
            'success' => true,
        ]);
    }

    public function removeDocuments(Row $row): JsonResponse
    {
        $this->rowService->removeDocuments($row);

        return response()->json([
            'success' => true,
        ]);
    }
}
