<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Query\ListCharacters;

use App\GOTCastingContext\Domain\Character\Service\ListCharactersService;

class ListCharactersQueryHandler
{
    private ListCharactersService $listCharactersService;

    public function __construct(ListCharactersService $listCharactersService)
    {
        $this->listCharactersService = $listCharactersService;
    }

    public function handle(ListCharactersQuery $query): ListCharactersQueryResult
    {
        return new ListCharactersQueryResult(
            $this->listCharactersService->execute()
        );
    }
}