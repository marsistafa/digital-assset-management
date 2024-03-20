<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileUploadProgressEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fileName;
    public $progress;

    public function __construct($fileName,$progress)
    {
        $this->fileName = $fileName;
        $this->progress = $progress;
    }
    public function broadcastOn()
    {
        return [];
    }
}
