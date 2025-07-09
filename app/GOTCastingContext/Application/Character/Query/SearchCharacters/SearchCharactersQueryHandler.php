<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Query\SearchCharacters;

use App\GOTCastingContext\Domain\Actor\Service\SearchActorsService;
use App\GOTCastingContext\Domain\Character\Service\SearchCharactersService;

class SearchCharactersQueryHandler
{
    private SearchCharactersService $searchCharactersService;

    public function __construct(SearchCharactersService $searchCharactersService)
    {
        $this->searchCharactersService = $searchCharactersService;
    }

    public function handle(SearchCharactersQuery $query): SearchCharactersQueryResult
    {
        return new SearchCharactersQueryResult(
            $this->searchCharactersService->execute($query->query())
        );
    }
}