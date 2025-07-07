<?php

declare (strict_types=1);

namespace App\GOTCasting\Infrastructure\Character\Http;

use App\GOTCasting\Application\Character\Query\ListCharacters\ListCharactersQuery;
use App\ShareContext\Infrastructure\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;

class ListCharactersController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(): JsonResponse
    {
        $characters = $this->queryBus->ask(new ListCharactersQuery());

        return new JsonResponse($characters, JsonResponse::HTTP_OK);
    }
}
