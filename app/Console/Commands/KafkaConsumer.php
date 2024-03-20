<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Enqueue\RdKafka\Consumer;
use Enqueue\RdKafka\Message;

class KafkaConsumer extends Command
{
    protected $signature = 'kafka:consume';
    protected $description = 'Consume messages from Kafka topic';

    public function handle()
    {
        // Configure Kafka Consumer
        $config = new \RdKafka\ConsumerConfig();
        $config->setMetadataBrokerList(config('app.kafka_broker'));
        $config->setGroupId('my-group');

        // Create Consumer
        $consumer = new Consumer($config);

        // Subscribe to Topic
        $topic = $consumer->newTopic('myTopic');
        $topic->consumeStart(0, RD_KAFKA_OFFSET_END);

        // Consume Messages
        while (true) {
            $message = $topic->consume(0, 1000);
            
            if ($message->err) {
                echo "Error: {$message->errstr()}\n";
            } else {
                echo "Received message: {$message->payload}\n";

                // Perform your actions with the received message
                // For example, log the message
                \Log::info("Kafka Message Received: {$message->payload}");
            }
        }
    }
}
