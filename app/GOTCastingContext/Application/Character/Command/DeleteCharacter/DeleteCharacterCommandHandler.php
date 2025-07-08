<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\DeleteCharacter;

use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\Service\DeleteCharacterByIdService;

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
