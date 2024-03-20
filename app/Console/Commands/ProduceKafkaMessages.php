<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProduceKafkaMessages extends Command
{
    protected $signature = 'kafka:produce-messages';

    public function handle()
    {
        // Your Kafka producing logic here
        $this->info('Producing Kafka messages...');
    }
}
