<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Actor\Messaging;

use App\GOTCastingContext\Domain\Actor\Actor;
use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Infrastructure\Actor\Persistence\ElasticsearchActorRepository;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ActorCreatedConsumer
{
    private string $queueName = 'actor_created';

    public function __construct(
        private ElasticsearchActorRepository $searchRepository,
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

            $actor = new Actor(
                new ActorId($payload['data']['id']),
                new ActorName($payload['data']['name']),
                $payload['data']['biography'] ?? null
            );

            $this->searchRepository->index($actor);
        };

        $channel->basic_consume($this->queueName, '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
} 