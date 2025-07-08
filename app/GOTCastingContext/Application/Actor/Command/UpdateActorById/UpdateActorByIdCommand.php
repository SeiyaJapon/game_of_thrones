<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Command\UpdateActorById;

use App\ShareContext\Application\Command\CommandInterface;

class UpdateActorByIdCommand implements CommandInterface
{
    private string $actorId;
    private string $actorName;
    private ?string $biography;

    public function __construct(string $actorId, string $actorName, ?string $biography)
    {
        $this->actorId = $actorId;
        $this->actorName = $actorName;
        $this->biography = $biography;
    }

    public function actorId(): string
    {
        return $this->actorId;
    }

    public function actorName(): string
    {
        return $this->actorName;
    }

    public function biography(): ?string
    {
        return $this->biography;
    }
}