<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Actor\Command\DeleteActorById;

use App\GOTCasting\Domain\Actor\Service\DeleteActorByIdService;

class DeleteActorByIdCommandHandler
{
    private DeleteActorByIdService $service;

    public function __construct(DeleteActorByIdService $service)
    {
        $this->service = $service;
    }

    public function __invoke(DeleteActorByIdCommand $command): void
    {
        $this->service->execute($command->getActorId());
    }
}