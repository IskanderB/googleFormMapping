<?php

namespace App\Event\Document;

use App\Entity\Row\Row;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterAddDocumentsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private Row $row,
    ) {
    }

    /**
     * @return Row
     */
    public function getRow(): Row
    {
        return $this->row;
    }
}
