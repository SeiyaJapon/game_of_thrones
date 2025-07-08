<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Character\Service;

use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;

class FindCharacterByIdService
{
    private CharacterRepositoryInterface $repository;

    public function __construct(CharacterRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CharacterId $id): Character
    {
        return $this->repository->findById($id);
    }
}