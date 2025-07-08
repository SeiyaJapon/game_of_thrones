<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Query\GetActorById;

use App\ShareContext\Application\Query\QueryResultInterface;

class GetActorByIdQueryResult implements QueryResultInterface
{
    private array $actor;

    public function __construct(array $actor)
    {
        $this->actor = $actor;
    }

    public function result(): array
    {
        return $this->actor;
    }
}