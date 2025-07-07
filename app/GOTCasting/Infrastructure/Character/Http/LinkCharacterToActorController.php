<?php

declare (strict_types=1);

namespace App\GOTCasting\Infrastructure\Character\Http;

use App\GOTCasting\Application\Character\Command\LinkCharacterToActor\LinkCharacterToActorCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LinkCharacterToActorController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(string $characterId, Request $request): JsonResponse
    {
        $this->commandBus->handle(
            new LinkCharacterToActorCommand(
                $characterId,
                $request->get('actor_id')
            )
        );

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
