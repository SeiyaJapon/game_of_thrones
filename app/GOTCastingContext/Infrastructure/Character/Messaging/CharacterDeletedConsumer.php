<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Messaging;

use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Infrastructure\Character\Persistence\ElasticsearchCharacterRepository;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class CharacterDeletedConsumer
{
    private string $queueName = 'character_deleted';

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
            $characterId = new CharacterId($payload['data']['id']);
            $this->searchRepository->delete($characterId);
        };

        $channel->basic_consume($this->queueName, '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
} 