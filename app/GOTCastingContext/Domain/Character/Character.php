<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Domain\Character;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\ShareContext\Domain\AggregateRoot;

class Character extends AggregateRoot
{
    private CharacterId $id;
    private CharacterName $name;
    private ?ActorId $actorId;

    public function __construct(
        CharacterId $id,
        CharacterName $name,
        ?ActorId $actorId = null,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->actorId = $actorId;
    }

    public function assignActor(ActorId $actorId): void
    {
        $this->actorId = $actorId;
    }

    public function rename(CharacterName $name): void
    {
        $this->name = $name;
    }

    public function getActorId(): ?ActorId
    {
        return $this->actorId;
    }
    public function getName(): CharacterName
    {
        return $this->name;
    }
    public function getId(): CharacterId
    {
        return $this->id;
    }

    public function setId(CharacterId $id): void
    {
        $this->id = $id;
    }

    public function setName(CharacterName $name): void
    {
        $this->name = $name;
    }

    public function setActorId(?ActorId $actorId): void
    {
        $this->actorId = $actorId;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->value(),
            'name' => $this->getName()->value(),
            'actorId' => $this->actorId ? $this->getActorId()->value() : null,
        ];
    }
}
