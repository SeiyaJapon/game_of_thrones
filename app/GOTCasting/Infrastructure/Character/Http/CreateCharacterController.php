<?php

declare (strict_types=1);

namespace App\GOTCasting\Infrastructure\Character\Http;

use App\GOTCasting\Application\Character\Command\CreateCharacter\CreateCharacterCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CreateCharacterController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $characterId = $request->input('characterId') ?? Uuid::uuid4()->toString();
        $characterName = $request->input('characterName');
        $actorId = $request->input('actorId');

        $this->commandBus->handle(
            new CreateCharacterCommand(
                $characterId,
                $characterName,
                $actorId
            )
        );

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }
}
