<?php

declare (strict_types=1);

namespace App\GOTCasting\Application\Actor\Command\CreateActor;

use App\ShareContext\Application\Command\CommandInterface;

class CreateActorCommand implements CommandInterface
{
    private string $actorId;
    private string $actorName;
    private ?string $biography;

    public function __construct(string $actorId, string $actorName, ?string $biography = null)
    {
        $this->actorId = $actorId;
        $this->actorName = $actorName;
        $this->biography = $biography;
    }

    public function getActorId(): string
    {
        return $this->actorId;
    }

    public function getActorName(): string
    {
        return $this->actorName;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }
}