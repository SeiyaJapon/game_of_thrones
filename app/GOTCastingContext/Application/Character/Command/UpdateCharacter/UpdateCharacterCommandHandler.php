<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\UpdateCharacter;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Domain\Character\Service\UpdateCharacterByIdService;

class UpdateCharacterCommandHandler
{
    private UpdateCharacterByIdService $updateCharacterByIdService;

    public function __construct(UpdateCharacterByIdService $updateCharacterService)
    {
        $this->updateCharacterByIdService = $updateCharacterService;
    }

    public function handle(UpdateCharacterCommand $command): void
    {
        $this->updateCharacterByIdService->execute(
            new CharacterId($command->id()),
            $command->name() ? new CharacterName($command->name()) : null,
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
