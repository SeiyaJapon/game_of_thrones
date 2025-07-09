<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Http;

use App\GOTCastingContext\Application\Character\Command\UpdateCharacter\UpdateCharacterCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateCharacterByIdController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(string $characterId, Request $request): JsonResponse
    {
        $this->commandBus->handle(
            new UpdateCharacterCommand(
                $characterId,
                $request->input('characterName'),
                $request->input('actorId'),
                $request->input('houseName'),
                $request->input('nickname'),
                $request->input('characterImageThumb'),
                $request->input('characterImageFull'),
                $request->input('siblings', []),
                $request->input('parents', []),
                $request->input('killed', []),
                $request->input('guardedBy', [])
            )
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
