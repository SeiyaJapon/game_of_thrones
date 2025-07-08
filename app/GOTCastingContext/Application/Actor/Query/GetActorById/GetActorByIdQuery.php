<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Query\GetActorById;

use App\ShareContext\Application\Query\QueryInterface;

class GetActorByIdQuery implements QueryInterface
{
    private string $actorId;

    public function __construct(string $actorId)
    {
        $this->actorId = $actorId;
    }

    public function actorId(): string
    {
        return $this->actorId;
    }
}