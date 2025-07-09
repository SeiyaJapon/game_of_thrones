<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Domain\Character\Service;

use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;

class SearchCharactersService
{

    private CharacterRepositoryInterface $characterRepository;

    public function __construct(CharacterRepositoryInterface $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * @param string $query
     * @return Character[]
     */
    public function execute(string $query): array
    {
        return $this->characterRepository->searchByQuery($query);
    }
}