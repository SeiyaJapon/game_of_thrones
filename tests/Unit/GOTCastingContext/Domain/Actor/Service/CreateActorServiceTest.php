<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Domain\Actor\Service;

use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Domain\Actor\Service\CreateActorService;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;
use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use PHPUnit\Framework\MockObject\MockObject;

class CreateActorServiceTest extends TestCase
{
    private ActorRepositoryInterface|MockObject $actorRepository;
    private CreateActorService $service;

    protected function setUp(): void
    {
        $this->actorRepository = $this->createMock(ActorRepositoryInterface::class);
        $this->service = new CreateActorService($this->actorRepository);
    }

    public function testExecuteSavesActor()
    {
        $id = $this->createMock(ActorId::class);
        $name = $this->createMock(ActorName::class);
        $biography = 'Bio';

        $this->actorRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(\App\GOTCastingContext\Domain\Actor\Actor::class));

        $this->service->execute($id, $name, $biography);
    }
} 