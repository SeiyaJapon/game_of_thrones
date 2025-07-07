<?php

declare (strict_types=1);

namespace App\GOTCasting\Application\Actor\Command\CreateActor;

use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\ActorName;
use App\GOTCasting\Domain\Actor\Service\CreateActorService;

class CreateActorCommandHandler
{
    private CreateActorService $createActorService;

    public function __construct(CreateActorService $createActorService)
    {
        $this->createActorService = $createActorService;
    }

    public function handle(CreateActorCommand $command)
    {
        $this->createActorService->execute(
            new ActorId($command->getActorId()),
            new ActorName($command->getActorName()),
            $command->getBiography()
        );
    }
}