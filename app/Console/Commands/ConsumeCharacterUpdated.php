<?php

namespace App\Console\Commands;

use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterUpdatedConsumer;
use Illuminate\Console\Command;

class ConsumeCharacterUpdated extends Command
{
    protected $signature = 'rabbitmq:consume-character-updated';
    protected $description = 'Consume character_updated queue and update in Elasticsearch';

    public function handle(CharacterUpdatedConsumer $consumer)
    {
        $this->info('Consuming character_updated...');
        $consumer->consume();
    }
}