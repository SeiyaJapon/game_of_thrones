<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Actor\Query\ListActors;

use App\GOTCasting\Domain\Actor\Service\ListActorsService;

class ListActorsQueryHandler
{
    private ListActorsService $listActorsService;

    public function __construct(ListActorsService $listActorsService)
    {
        $this->listActorsService = $listActorsService;
    }

    public function __invoke(ListActorsQuery $query): ListActorsQueryResult
    {
        return new ListActorsQueryResult(
            $this->listActorsService->execute()
        );
    }
}