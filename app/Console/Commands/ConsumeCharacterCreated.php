<?php

namespace App\Console\Commands;

use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterCreatedConsumer;
use Illuminate\Console\Command;

class ConsumeCharacterCreated extends Command
{
    protected $signature = 'rabbitmq:consume-character-created';
    protected $description = 'Consume character_created queue and index in Elasticsearch';

    /**
     * Execute the console command.
     */
    public function handle(CharacterCreatedConsumer $consumer)
    {
        $this->info('Consuming character_created...');
        $consumer->consume();
    }
}
