<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Actor\Service;

use App\GOTCastingContext\Domain\Actor\Actor;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;

class ListActorsService
{
    private ActorRepositoryInterface $actorRepository;

    public function __construct(ActorRepositoryInterface $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    /**
     * @return Actor[]
     */
    public function execute(): array
    {
        return $this->actorRepository->findAll();
    }
}