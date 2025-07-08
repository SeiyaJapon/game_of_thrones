<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Actor\Service;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;

class UpdateActorByIdService
{
    private ActorRepositoryInterface $repository;

    public function __construct(ActorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ActorId $actorId, ?ActorName $actorName, ?string $biography): void
    {
        $this->repository->updateById($actorId, $actorName, $biography);
    }
}