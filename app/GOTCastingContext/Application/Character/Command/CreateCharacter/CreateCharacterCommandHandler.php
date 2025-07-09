<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\CreateCharacter;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Domain\Character\Service\CreateCharacterService;

class CreateCharacterCommandHandler
{
    private CreateCharacterService $createCharacterService;

    public function __construct(CreateCharacterService $createCharacterService)
    {
        $this->createCharacterService = $createCharacterService;
    }

    public function handle(CreateCharacterCommand $command): void
    {
        $this->createCharacterService->execute(
            new CharacterId($command->id()),
            new CharacterName($command->name()),
            $command->actorId() ? new ActorId($command->actorId()) : null,
            $command->houseName(),
            $command->nickname(),
            $command->characterImageThumb(),
            $command->characterImageFull(),
            $command->siblings(),
            $command->parents(),
            $command->killed(),
            $command->guardedBy()
        );
    }
}