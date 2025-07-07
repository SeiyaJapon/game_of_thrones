<?php

declare(strict_types=1);

namespace App\GOTCasting\Infrastructure\Actor\Http;

use App\GOTCasting\Application\Actor\Query\SearchActors\SearchActorsQuery;
use App\ShareContext\Infrastructure\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchActorsController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $query = $request->get('query', '');

        $result = $this->queryBus->ask(
            new SearchActorsQuery($query)
        );

        return new JsonResponse(
            $result,
            JsonResponse::HTTP_OK
        );
    }
}
