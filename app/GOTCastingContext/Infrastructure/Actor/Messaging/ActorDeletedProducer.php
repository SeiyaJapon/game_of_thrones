<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Actor\Messaging;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ActorDeletedProducer
{
    public function __construct(
        private string $host,
        private int $port,
        private string $user,
        private string $password,
        private string $queueName = 'actor_deleted'
    ) {}

    public function publish(array $data): void
    {
        $connection = new AMQPStreamConnection(
            $this->host,
            $this->port,
            $this->user,
            $this->password
        );

        $channel = $connection->channel();
        $channel->queue_declare($this->queueName, false, true, false, false);

        $message = new AMQPMessage(json_encode($data));
        $channel->basic_publish($message, '', $this->queueName);

        $channel->close();
        $connection->close();
    }
}