<?php

namespace App\Console\Commands;

use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorDeletedConsumer;
use Illuminate\Console\Command;

class ConsumeActorDeleted extends Command
{
    protected $signature = 'rabbitmq:consume-actor-deleted';
    protected $description = 'Consume actor_deleted queue and remove from Elasticsearch';

    public function handle(ActorDeletedConsumer $consumer)
    {
        $this->info('Consuming actor_deleted...');
        $consumer->consume();
    }
}