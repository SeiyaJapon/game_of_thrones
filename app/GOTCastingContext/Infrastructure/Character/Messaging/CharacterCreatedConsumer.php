<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Messaging;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Infrastructure\Character\Persistence\ElasticsearchCharacterRepository;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class CharacterCreatedConsumer
{
    private string $queueName = 'character_created';

    public function __construct(
        private ElasticsearchCharacterRepository $searchRepository,
        private string $host,
        private int $port,
        private string $user,
        private string $password
    ) {}

    public function consume(): void
    {
        $connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);
        $channel = $connection->channel();
        $channel->queue_declare($this->queueName, false, true, false, false);

        $callback = function ($msg) {
            $payload = json_decode($msg->getBody(), true);

            $character = new Character(
                new CharacterId($payload['data']['id']),
                new CharacterName($payload['data']['name']),
                isset($payload['data']['actor_id']) ? new ActorId($payload['data']['actor_id']) : null
            );

            $this->searchRepository->index($character);
        };

        $channel->basic_consume($this->queueName, '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
