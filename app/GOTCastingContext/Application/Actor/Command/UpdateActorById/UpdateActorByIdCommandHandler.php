<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Command\UpdateActorById;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Domain\Actor\Service\UpdateActorByIdService;

class UpdateActorByIdCommandHandler
{
    private UpdateActorByIdService $service;

    public function __construct(UpdateActorByIdService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateActorByIdCommand $command): void
    {
        $this->service->execute(
            new ActorId($command->actorId()),
            new ActorName($command->actorName()),
            $command->biography()
        );
    }
}