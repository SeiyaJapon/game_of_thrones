<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Persistence;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;
use App\GOTCastingContext\Domain\Character\Exception\CharacterNotFoundException;
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
            throw new CharacterNotFoundException($id->value());
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
            'house_name' => $character->getHouseName(),
            'nickname' => $character->getNickname(),
            'character_image_thumb' => $character->getCharacterImageThumb(),
            'character_image_full' => $character->getCharacterImageFull(),
            'siblings' => json_encode($character->getSiblings()),
            'parents' => json_encode($character->getParents()),
            'killed' => json_encode($character->getKilled()),
            'guarded_by' => json_encode($character->getGuardedBy()),
        ]);

        $this->characterCreatedProducer->publish([
            'event' => 'CharacterCreated',
            'data' => [
                'id' => $character->getId()->value(),
                'name' => $character->getName()->value(),
                'actor_id' => $character->getActorId()?->value(),
                'house_name' => $character->getHouseName(),
                'nickname' => $character->getNickname(),
                'character_image_thumb' => $character->getCharacterImageThumb(),
                'character_image_full' => $character->getCharacterImageFull(),
                'siblings' => $character->getSiblings(),
                'parents' => $character->getParents(),
                'killed' => $character->getKilled(),
                'guarded_by' => $character->getGuardedBy(),
            ]
        ]);
    }


    public function update(Character $character): void
    {
        // TODO: Implement linkToActor() method.
    }

    public function updateById(
        CharacterId $characterId,
        ?CharacterName $name = null,
        ?ActorId $actorId = null,
        ?string $houseName = null,
        ?string $nickname = null,
        ?string $characterImageThumb = null,
        ?string $characterImageFull = null,
        ?array $siblings = null,
        ?array $parents = null,
        ?array $killed = null,
        ?array $guardedBy = null
    ): void {
        $eloquentCharacter = EloquentCharacter::find($characterId->value());

        if (!$eloquentCharacter) {
            throw new \Exception("Character not found");
        }

        if ($name !== null) {
            $eloquentCharacter->name = $name->value();
        }
        if ($actorId !== null) {
            $eloquentCharacter->actor_id = $actorId->value();
        }
        if ($houseName !== null) {
            $eloquentCharacter->house_name = $houseName;
        }
        if ($nickname !== null) {
            $eloquentCharacter->nickname = $nickname;
        }
        if ($characterImageThumb !== null) {
            $eloquentCharacter->character_image_thumb = $characterImageThumb;
        }
        if ($characterImageFull !== null) {
            $eloquentCharacter->character_image_full = $characterImageFull;
        }
        if ($siblings !== null) {
            $eloquentCharacter->siblings = $siblings;
        }
        if ($parents !== null) {
            $eloquentCharacter->parents = $parents;
        }
        if ($killed !== null) {
            $eloquentCharacter->killed = $killed;
        }
        if ($guardedBy !== null) {
            $eloquentCharacter->guarded_by = $guardedBy;
        }

        $eloquentCharacter->save();

        $this->characterUpdatedProducer->publish([
            'event' => 'CharacterUpdated',
            'data' => [
                'id' => $characterId->value(),
                'name' => $name?->value(),
                'actor_id' => $actorId?->value(),
                'house_name' => $houseName,
                'nickname' => $nickname,
                'character_image_thumb' => $characterImageThumb,
                'character_image_full' => $characterImageFull,
                'siblings' => $siblings,
                'parents' => $parents,
                'killed' => $killed,
                'guarded_by' => $guardedBy,
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

    public function searchByQuery(string $query): array
    {
        throw new \BadMethodCallException("Search is not allowed in PostgresCharacterRepository (use Elasticsearch)");
    }
}
