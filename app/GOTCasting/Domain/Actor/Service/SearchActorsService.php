<?php

declare(strict_types=1);

namespace App\GOTCasting\Domain\Actor\Service;

use App\GOTCasting\Domain\Actor\Actor;
use App\GOTCasting\Domain\Actor\ActorRepositoryInterface;

class SearchActorsService
{
    private ActorRepositoryInterface $actorRepository;

    public function __construct(ActorRepositoryInterface $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    /**
     * @return Actor[]
     */
    public function execute(string $query): array
    {
        return $this->actorRepository->searchByQuery($query);
    }
}