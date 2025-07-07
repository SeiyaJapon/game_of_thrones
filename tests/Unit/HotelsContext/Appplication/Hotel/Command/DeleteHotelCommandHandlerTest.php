<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Application\Hotel\Command;

use PHPUnit\Framework\TestCase;
use App\HotelsContext\Application\Hotel\Command\DeleteHotelCommand;
use App\HotelsContext\Application\Hotel\Command\DeleteHotelCommandHandler;
use App\HotelsContext\Domain\Hotel\Services\DeleteHotelService;
use PHPUnit\Framework\MockObject\MockObject;

class DeleteHotelCommandHandlerTest extends TestCase
{
    private DeleteHotelService|MockObject $deleteHotelService;
    private DeleteHotelCommandHandler $handler;

    protected function setUp(): void
    {
        $this->deleteHotelService = $this->createMock(DeleteHotelService::class);
        $this->handler = new DeleteHotelCommandHandler($this->deleteHotelService);
    }

    public function testHandleDeletesHotelSuccessfully()
    {
        $command = new DeleteHotelCommand('uuid');

        $this->deleteHotelService->expects($this->once())
            ->method('delete')
            ->with($this->equalTo('uuid'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenHotelNotFound()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Hotel not found.');

        $command = new DeleteHotelCommand('uuid');

        $this->deleteHotelService->method('delete')
            ->willThrowException(new \RuntimeException('Hotel not found.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenDeleteFails()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to delete hotel.');

        $command = new DeleteHotelCommand('uuid');

        $this->deleteHotelService->method('delete')
            ->willThrowException(new \RuntimeException('Failed to delete hotel.'));

        $this->handler->handle($command);
    }
}
