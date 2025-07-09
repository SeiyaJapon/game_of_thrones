<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Query\GetCharacterById;

use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\Service\FindCharacterByIdService;

class GetCharacterByIdQueryHandler
{
    private FindCharacterByIdService $findCharacterByIdService;

    public function __construct(FindCharacterByIdService $findCharacterByIdService)
    {
        $this->findCharacterByIdService = $findCharacterByIdService;
    }

    public function handle(GetCharacterByIdQuery $query): GetCharacterByIdQueryResult
    {
        return new GetCharacterByIdQueryResult(
            $this->findCharacterByIdService->execute(
                new CharacterId($query->characterId())
            )->toArray()
        );
    }
}