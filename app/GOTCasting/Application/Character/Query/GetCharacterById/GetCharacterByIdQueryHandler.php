<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Query\GetCharacterById;

use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\Service\FindCharacterByIdService;

class GetCharacterByIdQueryHandler
{
    private FindCharacterByIdService $findCharacterByIdService;

    public function __construct(FindCharacterByIdService $findCharacterByIdService)
    {
        $this->findCharacterByIdService = $findCharacterByIdService;
    }

    public function ask(GetCharacterByIdQuery $query): GetCharacterByIdQueryResult
    {
        return new GetCharacterByIdQueryResult(
            $this->findCharacterByIdService->execute(
                new CharacterId($query->characterId())
            )->toArray()
        );
    }
}