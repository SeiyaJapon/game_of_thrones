<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Command\CreateCharacter;

use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\CharacterName;
use App\GOTCasting\Domain\Character\Service\CreateCharacterService;

class CreateCharacterCommandHandler
{
    private CreateCharacterService $createCharacterService;

    public function __construct(CreateCharacterService $createCharacterService)
    {
        $this->createCharacterService = $createCharacterService;
    }

    public function __invoke(CreateCharacterCommand $command): void
    {
        $this->createCharacterService->execute(
            new CharacterId($command->id()),
            new CharacterName($command->name()),
            $command->getActorId()
        );
    }
}