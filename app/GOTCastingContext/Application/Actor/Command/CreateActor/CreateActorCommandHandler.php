<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Command\CreateActor;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Domain\Actor\Service\CreateActorService;

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