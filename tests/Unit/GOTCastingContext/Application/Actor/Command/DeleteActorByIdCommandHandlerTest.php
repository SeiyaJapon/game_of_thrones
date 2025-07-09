<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Application\Actor\Command;

use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Application\Actor\Command\DeleteActorById\DeleteActorByIdCommand;
use App\GOTCastingContext\Application\Actor\Command\DeleteActorById\DeleteActorByIdCommandHandler;
use App\GOTCastingContext\Domain\Actor\Service\DeleteActorByIdService;
use PHPUnit\Framework\MockObject\MockObject;

class DeleteActorByIdCommandHandlerTest extends TestCase
{
    private DeleteActorByIdService|MockObject $deleteActorByIdService;
    private DeleteActorByIdCommandHandler $handler;

    protected function setUp(): void
    {
        $this->deleteActorByIdService = $this->createMock(DeleteActorByIdService::class);
        $this->handler = new DeleteActorByIdCommandHandler($this->deleteActorByIdService);
    }

    public function testHandleDeletesActorSuccessfully()
    {
        $command = new DeleteActorByIdCommand('uuid');

        $this->deleteActorByIdService->expects($this->once())
            ->method('execute')
            ->with($this->equalTo('uuid'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenActorNotFound()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Actor not found.');

        $command = new DeleteActorByIdCommand('uuid');

        $this->deleteActorByIdService->method('execute')
            ->willThrowException(new \RuntimeException('Actor not found.'));

        $this->handler->handle($command);
    }
} 