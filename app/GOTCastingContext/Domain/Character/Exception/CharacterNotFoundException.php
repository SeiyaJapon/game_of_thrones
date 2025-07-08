<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Character\Exception;

use RuntimeException;

class CharacterNotFoundException extends RuntimeException
{
    public function __construct(string $characterId)
    {
        parent::__construct("Character not found with ID: {$characterId}");
    }
}