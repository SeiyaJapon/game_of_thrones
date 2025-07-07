<?php

declare (strict_types=1);

namespace App\GOTCasting\Infrastructure\Character\Http;

use App\GOTCasting\Application\Character\Query\GetCharacterById\GetCharacterByIdQuery;
use App\ShareContext\Infrastructure\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;

class GetCharacterByIdController
{
    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(string $characterId): JsonResponse
    {
        $character = $this->queryBus->ask(
            new GetCharacterByIdQuery($characterId)
        );

        return new JsonResponse($character, JsonResponse::HTTP_OK);
    }
}
