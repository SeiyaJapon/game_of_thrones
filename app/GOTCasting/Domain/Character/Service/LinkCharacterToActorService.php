<?php

declare (strict_types=1);

namespace App\GOTCasting\Domain\Character\Service;

use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\ActorRepositoryInterface;
use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\CharacterRepositoryInterface;

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