<?php

declare(strict_types=1);

namespace App\GOTCasting\Infrastructure\Actor\Http;

use App\GOTCasting\Application\Actor\Command\DeleteActorById\DeleteActorByIdCommand;
use App\ShareContext\Infrastructure\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class DeleteActorByIdController
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request, string $actorId): JsonResponse
    {
        $this->commandBus->handle(
            new DeleteActorByIdCommand($actorId)
        );

        return new JsonResponse(
            ['message' => 'Actor deleted successfully'],
            JsonResponse::HTTP_OK
        );
    }
}