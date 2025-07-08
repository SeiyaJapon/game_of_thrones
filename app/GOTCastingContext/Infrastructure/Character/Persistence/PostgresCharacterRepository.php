<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Persistence;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterCreatedProducer;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterDeletedProducer;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterUpdatedProducer;
use App\Models\Character as EloquentCharacter;

class PostgresCharacterRepository implements CharacterRepositoryInterface
{
    private CharacterCreatedProducer $characterCreatedProducer;
    private CharacterUpdatedProducer $characterUpdatedProducer;
    private CharacterDeletedProducer $characterDeletedProducer;

    public function __construct(
        CharacterCreatedProducer $characterCreatedProducer,
        CharacterUpdatedProducer $characterUpdatedProducer,
        CharacterDeletedProducer $characterDeletedProducer
    ) {
        $this->characterCreatedProducer = $characterCreatedProducer;
        $this->characterUpdatedProducer = $characterUpdatedProducer;
        $this->characterDeletedProducer = $characterDeletedProducer;
    }

    public function findById(CharacterId $id): ?Character
    {
        $eloquentCharacter = EloquentCharacter::find($id->value());

        if (!$eloquentCharacter) {
            return null;
        }

        return new Character(
            new CharacterId($eloquentCharacter->id),
            new CharacterName($eloquentCharacter->name),
            $eloquentCharacter->actor_id ? new ActorId($eloquentCharacter->actor_id) : null
        );
    }

    public function findAll(): array
    {
        return EloquentCharacter::all()
            ->map(fn ($eloquentCharacter) => new Character(
                new CharacterId($eloquentCharacter->id),
                new CharacterName($eloquentCharacter->name),
                $eloquentCharacter->actor_id ? new ActorId($eloquentCharacter->actor_id) : null
            ))
            ->toArray();
    }

    public function save(Character $character): void
    {
        EloquentCharacter::create([
            'id' => $character->getId()->value(),
            'name' => $character->getName()->value(),
            'actor_id' => $character->getActorId()?->value(),
        ]);

        $this->characterCreatedProducer->publish([
            'event' => 'CharacterCreated',
            'data' => [
                'id' => $character->getId()->value(),
                'name' => $character->getName()->value(),
                'actor_id' => $character->getActorId()?->value()
            ]
        ]);
    }

    public function update(Character $character): void
    {
        // TODO: Implement linkToActor() method.
    }

    public function updateById(CharacterId $characterId, ?CharacterName $characterName, ?string $actorId): void
    {
        $eloquentCharacter = EloquentCharacter::find($characterId->value());

        if (!$eloquentCharacter) {
            throw new \Exception("Character not found");
        }

        if ($characterName !== null) {
            $eloquentCharacter->name = $characterName->value();
        }

        $eloquentCharacter->actor_id = $actorId;

        $eloquentCharacter->save();

        $this->characterUpdatedProducer->publish([
            'event' => 'CharacterUpdated',
            'data' => [
                'id' => $characterId->value(),
                'name' => $characterName?->value(),
                'actor_id' => $actorId
            ]
        ]);
    }

    public function delete(CharacterId $id): void
    {
        $eloquentCharacter = EloquentCharacter::find($id->value());

        if (!$eloquentCharacter) {
            throw new \Exception("Character not found");
        }

        $eloquentCharacter->delete();

        $this->characterDeletedProducer->publish([
            'event' => 'CharacterDeleted',
            'data' => [
                'id' => $id->value()
            ]
        ]);
    }

    public function searchByQuery(string $query): array
    {
        throw new \BadMethodCallException("Search is not allowed in PostgresCharacterRepository (use Elasticsearch)");
    }

    public function linkToActor(CharacterId $characterId, ActorId $actorId): void
    {
        $eloquentCharacter = EloquentCharacter::find($characterId->value());

        if (!$eloquentCharacter) {
            throw new \Exception("Character not found");
        }

        $eloquentCharacter->actor_id = $actorId->value();
        $eloquentCharacter->save();

        $this->characterUpdatedProducer->publish([
            'event' => 'CharacterLinkedToActor',
            'data' => [
                'character_id' => $characterId->value(),
                'actor_id' => $actorId->value()
            ]
        ]);
    }

}
