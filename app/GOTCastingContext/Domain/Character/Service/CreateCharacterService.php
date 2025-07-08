<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Domain\Character\Service;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;

class CreateCharacterService
{
    private CharacterRepositoryInterface $characterRepository;

    public function __construct(CharacterRepositoryInterface $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function execute(CharacterId $id, CharacterName $name, ?ActorId $actorId): void
    {
        $this->characterRepository->save(
            new Character($id, $name, $actorId)
        );
    }
}