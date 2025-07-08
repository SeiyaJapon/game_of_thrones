<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Domain\Actor\Service;

use App\GOTCastingContext\Domain\Actor\Actor;
use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;

class CreateActorService
{
    private ActorRepositoryInterface $actorRepository;

    public function __construct(ActorRepositoryInterface $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function execute(ActorId $id, ActorName $name, ?string $biography = null): void
    {
        $this->actorRepository->save(
            new Actor($id, $name, $biography)
        );
    }
}