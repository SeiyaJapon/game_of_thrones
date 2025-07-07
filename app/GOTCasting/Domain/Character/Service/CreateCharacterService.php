<?php

declare(strict_types=1);

namespace App\GOTCasting\Domain\Character\Service;

use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Character\Character;
use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\CharacterName;
use App\GOTCasting\Domain\Character\CharacterRepositoryInterface;

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