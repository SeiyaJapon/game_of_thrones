<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Command\UpdateCharacter;

use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\CharacterName;
use App\GOTCasting\Domain\Character\Service\UpdateCharacterByIdService;

class UpdateCharacterCommandHandler
{
    private UpdateCharacterByIdService $updateCharacterByIdService;

    public function __construct(UpdateCharacterByIdService $updateCharacterService)
    {
        $this->updateCharacterByIdService = $updateCharacterService;
    }

    public function __invoke(UpdateCharacterCommand $command): void
    {
        $this->updateCharacterByIdService->execute(
            new CharacterId($command->id()),
            $command->name() !== null ? new CharacterName($command->name()) : null,
            new ActorId($command->getActorId())
        );
    }
}
