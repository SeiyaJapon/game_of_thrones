<?php

declare (strict_types=1);

namespace App\GOTCasting\Domain\Actor\Exception;

use Exception;

class ActorNotFoundException extends Exception
{
    public function __construct(string $actorId)
    {
        parent::__construct("Actor no encontrado con ID: {$actorId}");
    }
}