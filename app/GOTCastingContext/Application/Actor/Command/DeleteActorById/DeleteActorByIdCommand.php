<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Actor\Command\DeleteActorById;

use App\ShareContext\Application\Command\CommandInterface;

class DeleteActorByIdCommand implements CommandInterface
{
    private string $actorId;

    public function __construct(string $actorId)
    {
        $this->actorId = $actorId;
    }

    public function getActorId(): string
    {
        return $this->actorId;
    }
}