<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Messaging;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Infrastructure\Character\Persistence\ElasticsearchCharacterRepository;
use App\Models\Character as EloquentCharacter;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class CharacterUpdatedConsumer
{
    private string $queueName = 'character_updated';

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

            $eloquentCharacter = EloquentCharacter::find($payload['data']['id']);

            $character = new Character(
                new CharacterId($payload['data']['id']),
                new CharacterName($eloquentCharacter->name),
                isset($payload['data']['actor_id']) && $payload['data']['actor_id'] !== null
                    ? new ActorId($payload['data']['actor_id'])
                    : ($eloquentCharacter?->actor_id ? new ActorId($eloquentCharacter->actor_id) : null),
                $payload['data']['house_name'] ?? $eloquentCharacter?->house_name ?? '',
                $payload['data']['nickname'] ?? $eloquentCharacter?->nickname ?? '',
                $payload['data']['character_image_thumb'] ?? $eloquentCharacter?->character_image_thumb ?? '',
                $payload['data']['character_image_full'] ?? $eloquentCharacter?->character_image_full ?? '',
                $payload['data']['siblings'] ?? $eloquentCharacter?->siblings ?? [],
                $payload['data']['parents'] ?? $eloquentCharacter?->parents ?? [],
                $payload['data']['killed'] ?? $eloquentCharacter?->killed ?? [],
                $payload['data']['guarded_by'] ?? $eloquentCharacter?->guarded_by ?? []
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