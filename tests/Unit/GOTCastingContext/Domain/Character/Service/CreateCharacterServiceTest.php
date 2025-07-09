<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Domain\Character\Service;

use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Domain\Character\Service\CreateCharacterService;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use PHPUnit\Framework\MockObject\MockObject;

class CreateCharacterServiceTest extends TestCase
{
    private CharacterRepositoryInterface|MockObject $characterRepository;
    private CreateCharacterService $service;

    protected function setUp(): void
    {
        $this->characterRepository = $this->createMock(CharacterRepositoryInterface::class);
        $this->service = new CreateCharacterService($this->characterRepository);
    }

    public function testExecuteSavesCharacter()
    {
        $id = $this->createMock(CharacterId::class);
        $name = $this->createMock(CharacterName::class);
        $actorId = null;

        $this->characterRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(\App\GOTCastingContext\Domain\Character\Character::class));

        $this->service->execute($id, $name, $actorId);
    }
} 