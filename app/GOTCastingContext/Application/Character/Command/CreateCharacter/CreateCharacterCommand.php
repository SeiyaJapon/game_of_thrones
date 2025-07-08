<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\CreateCharacter;

use App\ShareContext\Application\Command\CommandInterface;

class CreateCharacterCommand implements CommandInterface
{
    private string $id;
    private string $name;
    private ?string $actorId;

    public function __construct(string $id, string $name, ?string $actorId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->actorId = $actorId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function getActorId(): ?string
    {
        return $this->actorId;
    }
}