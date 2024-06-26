<?php

namespace App\Listeners;

use App\Events\FileUploadProgressEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessFileUpload implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FileUploadProgressEvent $event)
    {
        \Log::info('File uploaded: ' . $event->fileName);
    }
}
