<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Command\LinkCharacterToActor;

use App\GOTCasting\Domain\Character\Service\LinkCharacterToActorService;
use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Actor\ActorId;

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