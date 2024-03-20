<?php
namespace App\Http\Controllers;

use Enqueue\RdKafka\RdKafkaProducer;
use Enqueue\RdKafka\RdKafkaConsumer;
use Enqueue\RdKafka\RdKafkaContext;
use Enqueue\RdKafka\RdKafkaTopic;
use Enqueue\RdKafka\Serializer\JsonSerializer; 
use RdKafka\KafkaConsumer;


class KafkaController extends Controller
{
    protected $consumer;
    protected $context;
    protected $topic;

    public function __construct()
    {
        // Assuming you have a configuration array
        $config = \config('enqueue');

        $context = new RdKafkaContext($config);
        $topic = $context->createTopic('myTopic');

        $consumer = new RdKafkaConsumer($config);
        // Create an instance of RdKafkaConsumer
        $rdKafkaConsumer = new RdKafkaConsumer($consumer, $context, $topic,$config);
        
        
        // Now you have a new instance of RdKafkaConsumer that you can use
        // You can perform operations like subscribing, receiving messages, etc.
        
    }
    public function produceMessage()
    {
        $producer = new RdKafkaProducer(\config('enqueue'));

        $message = $producer->createMessage('Hello, Kafka!');
        $producer->send('myTopic', $message);

        return 'Message sent to Kafka!';
    }

    public function consumeMessages()
    {
        // $config = \config('enqueue');
        // // Create a Kafka consumer instance
        // $kafkaConsumer = new RdKafkaConsumer($config);
        // // Get the Kafka topic instance
        // $topic = $kafkaConsumer->newTopic('myTopic');
        // // Create RdKafkaConsumer using the Kafka consumer and topic instances
        // $consumer = new \RdKafkaConsumer($kafkaConsumer, $topic);
        // Subscribe to the topic
        $consumer->subscribe();

        while (true) {
            $message = $consumer->receive(1000); // Adjust timeout as needed

            if ($message) {
                $payload = $message->getBody();
                $message->acknowledge();

                \Log::info('Received message: ' . $payload);
            }
        }
    }
}
