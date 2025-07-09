<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Actor\Http;

use App\GOTCastingContext\Application\Actor\Query\GetActorById\GetActorByIdQuery;
use App\ShareContext\Infrastructure\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;

class GetActorByIdController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(string $actorId): JsonResponse
    {
        $actor = $this->queryBus->ask(
            new GetActorByIdQuery($actorId)
        );

        return new JsonResponse(
            $actor->result(),
            JsonResponse::HTTP_OK
        );
    }
}