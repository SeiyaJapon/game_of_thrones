<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Application\Character\Command;

use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Application\Character\Command\CreateCharacter\CreateCharacterCommand;
use App\GOTCastingContext\Application\Character\Command\CreateCharacter\CreateCharacterCommandHandler;
use App\GOTCastingContext\Domain\Character\Service\CreateCharacterService;
use PHPUnit\Framework\MockObject\MockObject;
use Ramsey\Uuid\Uuid;

class CreateCharacterCommandHandlerTest extends TestCase
{
    private CreateCharacterService|MockObject $createCharacterService;
    private CreateCharacterCommandHandler $handler;

    protected function setUp(): void
    {
        $this->createCharacterService = $this->createMock(CreateCharacterService::class);
        $this->handler = new CreateCharacterCommandHandler($this->createCharacterService);
    }

    public function testHandleCreatesCharacterSuccessfully()
    {
        $id = Uuid::uuid4()->toString();
        $actorId = Uuid::uuid4()->toString();
        $command = new CreateCharacterCommand($id, 'Character 1', $actorId);

        $this->createCharacterService->expects($this->once())
            ->method('execute')
            ->with(
                $this->callback(fn($idObj) => method_exists($idObj, 'value') && $idObj->value() === $id),
                $this->callback(fn($nameObj) => method_exists($nameObj, 'value') && $nameObj->value() === 'Character 1'),
                $this->callback(fn($actorIdObj) => method_exists($actorIdObj, 'value') && $actorIdObj->value() === $actorId),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->anything()
            );

        $this->handler->handle($command);

        $this->addToAssertionCount(1); // Para evitar el warning de "no assertions"
    }

    public function testHandleThrowsExceptionWhenCharacterAlreadyExists()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Character already exists.');

        $id = Uuid::uuid4()->toString();
        $actorId = Uuid::uuid4()->toString();
        $command = new CreateCharacterCommand($id, 'Character 1', $actorId);

        $this->createCharacterService->method('execute')
            ->willThrowException(new \RuntimeException('Character already exists.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenSaveFails()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to save character.');

        $id = Uuid::uuid4()->toString();
        $actorId = Uuid::uuid4()->toString();
        $command = new CreateCharacterCommand($id, 'Character 1', $actorId);

        $this->createCharacterService->method('execute')
            ->willThrowException(new \RuntimeException('Failed to save character.'));

        $this->handler->handle($command);
    }
} 