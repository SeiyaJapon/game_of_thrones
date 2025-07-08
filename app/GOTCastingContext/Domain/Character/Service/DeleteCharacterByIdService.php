<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Character\Service;

use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;

class DeleteCharacterByIdService
{
    private CharacterRepositoryInterface $repository;

    public function __construct(CharacterRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CharacterId $id): void
    {
        $this->repository->delete($id);
    }
}