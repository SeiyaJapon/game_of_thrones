<?php

declare (strict_types=1);

namespace App\GOTCasting\Domain\Actor\Service;

use App\GOTCasting\Domain\Actor\Actor;
use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\ActorRepositoryInterface;

class FindActorByIdService
{
    private ActorRepositoryInterface $actorRepository;

    public function __construct(ActorRepositoryInterface $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function execute(ActorId $actorId): Actor
    {
        return $this->actorRepository->findById($actorId);
    }
}