<?php

namespace App\GOTCastingContext\Domain\Character;

use App\GOTCastingContext\Domain\Actor\ActorId;

class Character
{
    private CharacterId $id;
    private CharacterName $name;
    private ?ActorId $actorId;
    private ?string $houseName;
    private ?string $nickname;
    private ?string $characterImageThumb;
    private ?string $characterImageFull;
    private array $siblings;
    private array $parents;
    private array $killed;
    private array $guardedBy;

    public function __construct(
        CharacterId $id,
        CharacterName $name,
        ?ActorId $actorId = null,
        ?string $houseName = null,
        ?string $nickname = null,
        ?string $characterImageThumb = null,
        ?string $characterImageFull = null,
        array $siblings = [],
        array $parents = [],
        array $killed = [],
        array $guardedBy = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->actorId = $actorId;
        $this->houseName = $houseName;
        $this->nickname = $nickname;
        $this->characterImageThumb = $characterImageThumb;
        $this->characterImageFull = $characterImageFull;
        $this->siblings = $siblings;
        $this->parents = $parents;
        $this->killed = $killed;
        $this->guardedBy = $guardedBy;
    }

    public function getId(): CharacterId
    {
        return $this->id;
    }

    public function getName(): CharacterName
    {
        return $this->name;
    }

    public function getActorId(): ?ActorId
    {
        return $this->actorId;
    }

    public function getHouseName(): ?string
    {
        return $this->houseName;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function getCharacterImageThumb(): ?string
    {
        return $this->characterImageThumb;
    }

    public function getCharacterImageFull(): ?string
    {
        return $this->characterImageFull;
    }

    public function getSiblings(): array
    {
        return $this->siblings;
    }

    public function getParents(): array
    {
        return $this->parents;
    }

    public function getKilled(): array
    {
        return $this->killed;
    }

    public function getGuardedBy(): array
    {
        return $this->guardedBy;
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

    public function setHouseName(?string $houseName): void
    {
        $this->houseName = $houseName;
    }

    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function setCharacterImageThumb(?string $characterImageThumb): void
    {
        $this->characterImageThumb = $characterImageThumb;
    }

    public function setCharacterImageFull(?string $characterImageFull): void
    {
        $this->characterImageFull = $characterImageFull;
    }

    public function setSiblings(array $siblings): void
    {
        $this->siblings = $siblings;
    }

    public function setParents(array $parents): void
    {
        $this->parents = $parents;
    }

    public function setKilled(array $killed): void
    {
        $this->killed = $killed;
    }

    public function setGuardedBy(array $guardedBy): void
    {
        $this->guardedBy = $guardedBy;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->value(),
            'name' => $this->getName()->value(),
            'actorId' => $this->getActorId() ? $this->getActorId()->value() : null,
            'houseName' => $this->getHouseName(),
            'nickname' => $this->getNickname(),
            'characterImageThumb' => $this->getCharacterImageThumb(),
            'characterImageFull' => $this->getCharacterImageFull(),
            'siblings' => $this->getSiblings(),
            'parents' => $this->getParents(),
            'killed' => $this->getKilled(),
            'guardedBy' => $this->getGuardedBy(),
        ];
    }
}