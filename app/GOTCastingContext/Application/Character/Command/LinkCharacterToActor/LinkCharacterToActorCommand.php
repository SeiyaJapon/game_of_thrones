<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\LinkCharacterToActor;

use App\ShareContext\Application\Command\CommandInterface;

class LinkCharacterToActorCommand implements CommandInterface
{
    private string $characterId;
    private string $actorId;

    public function __construct(string $characterId, string $actorId)
    {
        $this->characterId = $characterId;
        $this->actorId = $actorId;
    }

    public function characterId(): string
    {
        return $this->characterId;
    }

    public function actorId(): string
    {
        return $this->actorId;
    }
}