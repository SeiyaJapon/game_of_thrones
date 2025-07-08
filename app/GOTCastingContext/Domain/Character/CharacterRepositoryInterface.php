<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Domain\Character;

use App\GOTCastingContext\Domain\Actor\ActorId;

interface CharacterRepositoryInterface
{
    public function findById(CharacterId $id): ?Character;
    public function findAll(): array;
    public function save(Character $character): void;
    public function update(Character $character): void;
    public function delete(CharacterId $id): void;
    public function linkToActor(CharacterId $characterId, ActorId $actorId): void;
}