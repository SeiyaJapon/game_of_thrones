<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Application\Actor\Command;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Application\Actor\Command\CreateActor\CreateActorCommand;
use App\GOTCastingContext\Application\Actor\Command\CreateActor\CreateActorCommandHandler;
use App\GOTCastingContext\Domain\Actor\Service\CreateActorService;
use PHPUnit\Framework\MockObject\MockObject;
use Ramsey\Uuid\Uuid;

class CreateActorCommandHandlerTest extends TestCase
{
    private CreateActorService|MockObject $createActorService;
    private CreateActorCommandHandler $handler;

    protected function setUp(): void
    {
        $this->createActorService = $this->createMock(CreateActorService::class);
        $this->handler = new CreateActorCommandHandler($this->createActorService);
    }

    public function testHandleCreatesActorSuccessfully()
    {
        $id = Uuid::uuid4()->toString();
        $name = 'Actor 1';
        $biography = 'Biography';
        $command = new CreateActorCommand($id, $name, $biography);

        $this->createActorService->expects($this->once())
            ->method('execute')
            ->with(
                $this->isInstanceOf(ActorId::class),
                $this->isInstanceOf(ActorName::class),
                $biography
            );

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenActorAlreadyExists()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Actor already exists.');

        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $command = new CreateActorCommand($id, 'Actor 1', 'Biography');

        $this->createActorService->expects($this->once())
            ->method('execute')
            ->with(
                $this->isInstanceOf(ActorId::class),
                $this->isInstanceOf(ActorName::class),
                'Biography'
            )
            ->willThrowException(new \RuntimeException('Actor already exists.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenSaveFails()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to save actor.');

        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $command = new CreateActorCommand($id, 'Actor 1', 'Biography');

        $this->createActorService->expects($this->once())
            ->method('execute')
            ->with(
                $this->isInstanceOf(ActorId::class),
                $this->isInstanceOf(ActorName::class),
                'Biography'
            )
            ->willThrowException(new \RuntimeException('Failed to save actor.'));

        $this->handler->handle($command);
    }
} 