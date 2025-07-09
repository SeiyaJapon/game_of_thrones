<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Actor\Http;

use App\GOTCastingContext\Application\Actor\Command\UpdateActorById\UpdateActorByIdCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateActorByIdController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(string $actorId, Request $request): JsonResponse
    {
        $actorName = $request->input('name');
        $biography = $request->input('biography');

        $this->commandBus->handle(
            new UpdateActorByIdCommand($actorId, $actorName, $biography)
        );

        return new JsonResponse(
            ['message' => 'Actor updated successfully'],
            JsonResponse::HTTP_OK
        );
    }
}