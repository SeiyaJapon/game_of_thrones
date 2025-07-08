<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Query\ListActors;

use App\ShareContext\Application\Query\QueryResultInterface;

class ListActorsQueryResult implements QueryResultInterface
{
    private array $actors;

    public function __construct(array $actors)
    {
        $this->actors = $actors;
    }

    public function result(): array
    {
        return array_map(fn($actor) => $actor->toArray(), $this->actors);
    }
}