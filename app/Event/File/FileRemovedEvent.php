<?php

namespace App\Event\File;

use App\Entity\File\File;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileRemovedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private File $file,
    ) {
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }
}
