<?php

declare(strict_types=1);

namespace App\GOTCasting\Domain\Character\Service;

use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\CharacterRepositoryInterface;

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