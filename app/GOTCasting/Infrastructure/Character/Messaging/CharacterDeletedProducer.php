<?php

declare(strict_types=1);

namespace App\GOTCasting\Infrastructure\Character\Messaging;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class CharacterDeletedProducer
{
    public function __construct(
        private string $host,
        private int $port,
        private string $user,
        private string $password,
        private string $queueName = 'character_deleted'
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
