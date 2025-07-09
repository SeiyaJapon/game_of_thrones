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
        CharacterId $characterId,
        ?CharacterName $name = null,
        ?ActorId $actorId = null,
        ?string $houseName = null,
        ?string $nickname = null,
        ?string $characterImageThumb = null,
        ?string $characterImageFull = null,
        ?array $siblings = null,
        ?array $parents = null,
        ?array $killed = null,
        ?array $guardedBy = null
    ): void {
        $this->characterRepository->updateById(
            $characterId,
            $name,
            $actorId,
            $houseName,
            $nickname,
            $characterImageThumb,
            $characterImageFull,
            $siblings,
            $parents,
            $killed,
            $guardedBy
        );
    }

}
