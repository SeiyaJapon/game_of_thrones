<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Actor\Service;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;

class DeleteActorByIdService
{
    private ActorRepositoryInterface $repository;

    public function __construct(ActorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $actorId): void
    {
        $this->repository->delete(new ActorId($actorId));
    }
}