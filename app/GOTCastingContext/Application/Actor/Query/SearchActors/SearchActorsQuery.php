<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Query\SearchActors;

use App\ShareContext\Application\Query\QueryInterface;

class SearchActorsQuery implements QueryInterface
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