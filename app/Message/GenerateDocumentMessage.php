<?php

namespace App\Message;

use App\Service\RefreshTaskService;
use App\Service\Document\AddDocumentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateDocumentMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $rowId,
        public int $layoutId,
    ) {
    }

    public function handle(AddDocumentService $rowService): void
    {
        $rowService->documentProcessing($this->rowId, $this->layoutId);
    }
}
