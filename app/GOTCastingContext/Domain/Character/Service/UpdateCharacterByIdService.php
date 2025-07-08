<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Character\Service;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;

class UpdateCharacterByIdService
{
    private CharacterRepositoryInterface $characterRepository;

    public function __construct(CharacterRepositoryInterface $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function execute(
        CharacterId $id,
        ?CharacterName $name = null,
        ?ActorId $actorId = null
    ): void {
        $this->characterRepository->updateById(
            $id,
            $name,
            $actorId?->value()
        );
    }
}
