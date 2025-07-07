<?php

declare (strict_types=1);

namespace App\GOTCasting\Domain\Actor\Service;

use App\GOTCasting\Domain\Actor\Actor;
use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\ActorName;
use App\GOTCasting\Domain\Actor\ActorRepositoryInterface;

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