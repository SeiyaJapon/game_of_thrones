<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Domain\Character\Service;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;

class LinkCharacterToActorService
{
    private ActorRepositoryInterface $actorRepository;
    private CharacterRepositoryInterface $characterRepository;

    public function __construct(
        ActorRepositoryInterface $actorRepository,
        CharacterRepositoryInterface $characterRepository
    ) {
        $this->actorRepository = $actorRepository;
        $this->characterRepository = $characterRepository;
    }

    public function execute(CharacterId $characterId, ActorId $actorId) : void
    {
        if (
            $this->actorRepository->findById($actorId) &&
            $this->characterRepository->findById($characterId)
        ) {
            $this->characterRepository->linkToActor($characterId, $actorId);
        }
    }
}