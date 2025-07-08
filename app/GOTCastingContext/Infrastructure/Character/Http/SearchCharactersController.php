<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Http;

use App\GOTCastingContext\Application\Character\Query\SearchCharacters\SearchCharactersQuery;
use App\ShareContext\Infrastructure\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchCharactersController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $query = $request->get('q', '');

        $results = $this->queryBus->ask(
            new SearchCharactersQuery($query)
        );

        return new JsonResponse($results, JsonResponse::HTTP_OK);
    }
}
