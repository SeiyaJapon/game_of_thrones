<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Query\GetCharacterById;

use App\ShareContext\Application\Query\QueryInterface;

class GetCharacterByIdQuery implements QueryInterface
{
    private string $characterId;

    public function __construct(string $characterId)
    {
        $this->characterId = $characterId;
    }

    public function characterId(): string
    {
        return $this->characterId;
    }
}