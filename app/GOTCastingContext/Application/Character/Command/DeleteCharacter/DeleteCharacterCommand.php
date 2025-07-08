<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\DeleteCharacter;

use App\ShareContext\Application\Command\CommandInterface;

final class DeleteCharacterCommand implements CommandInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
