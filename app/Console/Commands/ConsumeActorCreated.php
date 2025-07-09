<?php

namespace App\Console\Commands;

use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorCreatedConsumer;
use Illuminate\Console\Command;

class ConsumeActorCreated extends Command
{
    protected $signature = 'rabbitmq:consume-actor-created';
    protected $description = 'Consume actor_created queue and index in Elasticsearch';

    public function handle(ActorCreatedConsumer $consumer)
    {
        $this->info('Consuming actor_created...');
        $consumer->consume();
    }
}