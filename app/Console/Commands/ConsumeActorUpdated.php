<?php

namespace App\Console\Commands;

use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorUpdatedConsumer;
use Illuminate\Console\Command;

class ConsumeActorUpdated extends Command
{
    protected $signature = 'rabbitmq:consume-actor-updated';
    protected $description = 'Consume actor_updated queue and update in Elasticsearch';

    public function handle(ActorUpdatedConsumer $consumer)
    {
        $this->info('Consuming actor_updated...');
        $consumer->consume();
    }
}