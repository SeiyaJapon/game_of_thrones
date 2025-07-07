<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Query\SearchCharacters;

use App\GOTCasting\Domain\Character\Service\SearchCharactersService;

class SearchCharactersQueryHandler
{
    private SearchCharactersService $searchCharactersService;

    public function __construct(SearchCharactersService $searchCharactersService)
    {
        $this->searchCharactersService = $searchCharactersService;
    }

    public function ask(SearchCharactersQuery $query): SearchCharactersQueryResult
    {
        return new SearchCharactersQueryResult(
            $this->searchCharactersService->execute($query->query())
        );
    }
}