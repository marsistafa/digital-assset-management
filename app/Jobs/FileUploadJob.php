<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\Upload;
use App\Models\Files;
use App\Models\Folder;
use App\Models\Metadata;
use App\Events\FileUploadProgressEvent;
use App\Notifications\FileUploadedNotification;
use Illuminate\Support\Facades\Notification;
use RdKafka\Producer;
use RdKafka\ProducerTopic;
use RdKafka\Message;

class FileUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $filename;
    protected $id_category;
    protected $description;
    protected $title;
    protected $date;
    protected $id_type;
    protected $tags;

    // public $queue = 'file_uploads';
    /**
     * Create a new job instance.
     *
     * @param string $path
     * @param string $filename
     * @param int $id_category
     * @param string $description
     * @param string $title
     * @param string $date
     * @param string $id_type
     * @param string $tags
     */
    public function __construct( $path, $filename, $id_category, $description, $title, $date, $id_type, $tags)
    {
        // $this->file = $file;
        $this->path = $path;
        $this->filename = $filename;
        $this->id_category = $id_category;
        $this->description = $description;
        $this->title = $title;
        $this->date = $date;
        $this->id_type = $id_type;
        $this->tags = $tags;
    }

    

public function handle()
{ 
    $dateTime = new \DateTime('now');
    $currentDateTime = $dateTime->format('Y-m-d H:i:s');

    \Log::info('Job processing started.');
    $file = Files::create([
        'path' => $this->path,
        'date_entered' => $this->date,
        'file_name' => $this->filename,
        'id_type' => $this->id_type,
        'id_category' => $this->id_category,
        'title' => $this->title,
    ]);

    Metadata::create([
        'file_id' => $file->id,
        'description' => $this->description,
        'keywords' => $this->title,
        'expiration_date' => $this->date,
    ]);
    $file->attachTags(explode(',', $this->tags));

    \Log::info('Job processing completed.');
    $this->broadcastEvent($this->filename, $progress = 10);
    // Notification::send(auth()->user(), new FileUploadedNotification($this->filename));
    
    // auth()->user()->notify(new FileUploadedNotification($this->filename));
}

public function sendMessage()
{
    // Configure Kafka Producer
    $config = new \RdKafka\ProducerConfig();
    $config->setMetadataBrokerList(config('app.kafka_broker'));
    // Create Producer
    $producer = new Producer($config);
    // Create Topic
    $topic = $producer->newTopic('myTopic');
    // Produce Message
    $message = 'Your message data here';
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
    // Flush Producer to send the message
    $producer->flush(1000);
    return response()->json(['message' => 'Message sent to Kafka']);
}

public function broadcastEvent($filename, $progress)
{   
    event(new FileUploadProgressEvent($filename, $progress));
}
}