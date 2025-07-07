<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Actor\Query\SearchActors;

use App\GOTCasting\Domain\Actor\Service\SearchActorsService;

class SearchActorsQueryHandler
{
    private SearchActorsService $searchActorsService;

    public function __construct(SearchActorsService $searchActorsService)
    {
        $this->searchActorsService = $searchActorsService;
    }

    public function __invoke(SearchActorsQuery $query): SearchActorsQueryResult
    {
        return new SearchActorsQueryResult(
            $this->searchActorsService->execute($query->query())
        );
    }
}