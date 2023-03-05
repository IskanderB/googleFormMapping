<?php

namespace App\Service;

use App\Entity\Task;
use Revolution\Google\Sheets\Facades\Sheets;

class SheetManager
{
    public function __construct(
        private Sheets $sheets
    ) {
    }

    public function getRows(Task $task): array
    {
        if ($task->getSheetName() !== null) {
            return $this->getSheet($task);
        }

        $rows = [];

        foreach ($this->getSheetList($task) as $sheetName) {
            $rows = array_merge($rows, $this->getSheet($task, $sheetName));
        }

        return $rows;
    }

    private function getSheet(Task $task, ?string $spreadsheetId = null): array
    {
        $sheet = Sheets::spreadsheet($task->getSpreadsheetId())->sheet($spreadsheetId ?: $task->getSheetName())->get();

        $header = $sheet->pull(0);

        return Sheets::collection($header, $sheet)->toArray();
    }

    private function getSheetList(Task $task): array
    {
        return Sheets::spreadsheet($task->getSpreadsheetId())->sheetList();
    }
}
