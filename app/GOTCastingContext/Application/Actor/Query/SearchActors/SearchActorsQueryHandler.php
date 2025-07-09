<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Query\SearchActors;

use App\GOTCastingContext\Domain\Actor\Service\SearchActorsService;

class SearchActorsQueryHandler
{
    private SearchActorsService $searchActorsService;

    public function __construct(SearchActorsService $searchActorsService)
    {
        $this->searchActorsService = $searchActorsService;
    }

    public function handle(SearchActorsQuery $query): SearchActorsQueryResult
    {
        return new SearchActorsQueryResult(
            $this->searchActorsService->execute($query->query())
        );
    }
}