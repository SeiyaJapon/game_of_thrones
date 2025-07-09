<?php

namespace App\Console\Commands;

use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterDeletedConsumer;
use Illuminate\Console\Command;

class ConsumeCharacterDeleted extends Command
{
    protected $signature = 'rabbitmq:consume-character-deleted';
    protected $description = 'Consume character_deleted queue and remove from Elasticsearch';

    public function handle(CharacterDeletedConsumer $consumer)
    {
        $this->info('Consuming character_deleted...');
        $consumer->consume();
    }
}