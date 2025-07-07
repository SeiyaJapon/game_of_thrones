<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Query\SearchCharacters;

use App\ShareContext\Application\Query\QueryInterface;

class SearchCharactersQuery implements QueryInterface
{
    private string $query;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    public function query(): string
    {
        return $this->query;
    }
}