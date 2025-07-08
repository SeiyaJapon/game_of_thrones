<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Actor\Http;

use App\GOTCastingContext\Application\Actor\Command\CreateActor\CreateActorCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Ramsey\Uuid\Uuid;

class CreateActorController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $actorId = $request->input('actorId') ?? Uuid::uuid4()->toString();
        $actorName = $request->input('actorName');
        $biography = $request->input('biography');

        $this->commandBus->handle(
            new CreateActorCommand($actorId, $actorName, $biography)
        );

        return new JsonResponse(
            ['message' => 'Actor created successfully'],
            JsonResponse::HTTP_CREATED
        );
    }
}