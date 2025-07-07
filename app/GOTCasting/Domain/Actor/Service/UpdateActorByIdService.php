<?php

declare(strict_types=1);

namespace App\GOTCasting\Domain\Actor\Service;

use App\GOTCasting\Domain\Actor\ActorRepositoryInterface;
use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\ActorName;

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