<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Query\ListCharacters;

use App\GOTCasting\Domain\Character\Service\ListCharactersService;

class ListCharactersQueryHandler
{
    private ListCharactersService $listCharactersService;

    public function __construct(ListCharactersService $listCharactersService)
    {
        $this->listCharactersService = $listCharactersService;
    }

    public function ask(ListCharactersQuery $query): ListCharactersQueryResult
    {
        return new ListCharactersQueryResult(
            $this->listCharactersService->execute()
        );
    }
}