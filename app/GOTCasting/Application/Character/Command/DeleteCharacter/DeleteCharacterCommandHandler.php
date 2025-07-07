<?php

declare(strict_types=1);

namespace App\GOTCasting\Application\Character\Command\DeleteCharacter;

use App\GOTCasting\Domain\Character\CharacterId;
use App\GOTCasting\Domain\Character\Service\DeleteCharacterByIdService;

class DeleteCharacterCommandHandler
{
    private DeleteCharacterByIdService $deleteCharacterByIdService;

    public function __construct(DeleteCharacterByIdService $deleteCharacterByIdService)
    {
        $this->deleteCharacterByIdService = $deleteCharacterByIdService;
    }

    public function __invoke(DeleteCharacterCommand $command): void
    {
        $this->deleteCharacterByIdService->execute(
            new CharacterId($command->id())
        );
    }
}
