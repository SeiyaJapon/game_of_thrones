<?php

namespace App\Console\Commands;

use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorCreatedProducer;
use Illuminate\Console\Command;

class TestRabbitMQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-rabbit-m-q';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $producer = app(ActorCreatedProducer::class);

        $producer->publish([
            'event' => 'ActorCreated',
            'data' => [
                'id' => 'test-id',
                'name' => 'Jon Snow',
                'biography' => 'Knows nothing.'
            ]
        ]);

        $this->info('Mensaje enviado a RabbitMQ');
    }

}
