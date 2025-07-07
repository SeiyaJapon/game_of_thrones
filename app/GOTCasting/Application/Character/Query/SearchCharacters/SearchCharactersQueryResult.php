<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Query\SearchCharacters;

use App\ShareContext\Application\Query\QueryResultInterface;

class SearchCharactersQueryResult implements QueryResultInterface
{
    private array $characters;

    public function __construct(array $characters)
    {
        $this->characters = $characters;
    }

    public function result(): array
    {
        return array_map(fn($character) => $character->toArray(), $this->characters);
    }
}