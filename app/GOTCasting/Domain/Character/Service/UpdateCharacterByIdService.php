<?php

declare(strict_types=1);

namespace App\GOTCasting\Domain\Character\Service;

use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\CharacterName;
use App\GOTCasting\Domain\Character\CharacterRepositoryInterface;

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
