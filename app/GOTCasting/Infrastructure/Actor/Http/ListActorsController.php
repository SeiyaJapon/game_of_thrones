<?php

declare(strict_types=1);

namespace App\GOTCasting\Infrastructure\Actor\Http;

use App\GOTCasting\Application\Actor\Query\ListActors\ListActorsQuery;
use App\ShareContext\Infrastructure\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;

class ListActorsController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(): JsonResponse
    {
        $actors = $this->queryBus->ask(
            new ListActorsQuery()
        );

        return new JsonResponse(
            $actors,
            JsonResponse::HTTP_OK
        );
    }
}
