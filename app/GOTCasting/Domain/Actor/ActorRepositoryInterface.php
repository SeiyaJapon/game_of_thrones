<?php

declare (strict_types=1);

namespace App\GOTCasting\Domain\Actor;

interface ActorRepositoryInterface
{
    public function findById(ActorId $id): Actor;
    public function findAll(): array;
    public function save(Actor $actor): void;
    public function update(Actor $actor): void;
    public function updateById(ActorId $actorId, ?ActorName $actorName, ?string $biography): void;
    public function delete(ActorId $id): void;
    /**
     * @return Actor[]
     */
    public function searchByQuery(string $query): array;
}