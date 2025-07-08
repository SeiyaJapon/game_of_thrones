<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Http;

use App\GOTCastingContext\Application\Character\Command\DeleteCharacter\DeleteCharacterCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;

class DeleteCharacterByIdController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(string $characterId): JsonResponse
    {
        $this->commandBus->handle(
            new DeleteCharacterCommand($characterId)
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
