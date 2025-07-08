<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Query\GetCharacterById;

use App\ShareContext\Application\Query\QueryResultInterface;

class GetCharacterByIdQueryResult implements QueryResultInterface
{
    private array $character;

    public function __construct(array $character)
    {
        $this->character = $character;
    }

    public function result(): array
    {
        return $this->character;
    }
}