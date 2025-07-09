<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Application\Actor\Command;

use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Application\Actor\Command\UpdateActorById\UpdateActorByIdCommand;
use App\GOTCastingContext\Application\Actor\Command\UpdateActorById\UpdateActorByIdCommandHandler;
use App\GOTCastingContext\Domain\Actor\Service\UpdateActorByIdService;
use PHPUnit\Framework\MockObject\MockObject;
use Ramsey\Uuid\Uuid;

class UpdateActorByIdCommandHandlerTest extends TestCase
{
    private UpdateActorByIdService|MockObject $updateActorByIdService;
    private UpdateActorByIdCommandHandler $handler;

    protected function setUp(): void
    {
        $this->updateActorByIdService = $this->createMock(UpdateActorByIdService::class);
        $this->handler = new UpdateActorByIdCommandHandler($this->updateActorByIdService);
    }

    public function testHandleUpdatesActorSuccessfully()
    {
        $id = Uuid::uuid4()->toString();
        $command = new UpdateActorByIdCommand($id, 'Actor 1', 'Bio');

        $this->updateActorByIdService->expects($this->once())
            ->method('execute')
            ->with(
                $this->callback(fn($idObj) => method_exists($idObj, 'value') && $idObj->value() === $id),
                $this->callback(fn($name) => method_exists($name, 'value') ? $name->value() === 'Actor 1' : (string)$name === 'Actor 1'),
                $this->equalTo('Bio')
            );

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenActorNotFound()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Actor not found.');

        $id = Uuid::uuid4()->toString();
        $command = new UpdateActorByIdCommand($id, 'Actor 1', 'Bio');

        $this->updateActorByIdService->method('execute')
            ->willThrowException(new \RuntimeException('Actor not found.'));

        $this->handler->handle($command);
    }
} 