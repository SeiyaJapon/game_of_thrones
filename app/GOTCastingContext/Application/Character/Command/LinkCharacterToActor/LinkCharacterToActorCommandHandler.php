<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\LinkCharacterToActor;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\Service\LinkCharacterToActorService;

class LinkCharacterToActorCommandHandler
{
    private LinkCharacterToActorService $service;

    public function __construct(LinkCharacterToActorService $service)
    {
        $this->service = $service;
    }

    public function __invoke(LinkCharacterToActorCommand $command): void
    {
        $characterId = new CharacterId($command->characterId());
        $actorId = new ActorId($command->actorId());

        $this->service->execute($characterId, $actorId);
    }
}