<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Application\Hotel\Command;

use PHPUnit\Framework\TestCase;
use App\HotelsContext\Application\Hotel\Command\UpdateHotelCommand;
use App\HotelsContext\Application\Hotel\Command\UpdateHotelCommandHandler;
use App\HotelsContext\Domain\Hotel\Services\UpdateHotelService;
use PHPUnit\Framework\MockObject\MockObject;

class UpdateHotelCommandHandlerTest extends TestCase
{
    private UpdateHotelService|MockObject $updateHotelService;
    private UpdateHotelCommandHandler $handler;

    protected function setUp(): void
    {
        $this->updateHotelService = $this->createMock(UpdateHotelService::class);
        $this->handler = new UpdateHotelCommandHandler($this->updateHotelService);
    }

    public function testHandleUpdatesHotelSuccessfully()
    {
        $command = new UpdateHotelCommand('uuid', 'Hotel 1', 'image.jpg', 5, 'City 1', 'Description');

        $this->updateHotelService->expects($this->once())
            ->method('update')
            ->with(
                $this->equalTo('uuid'),
                $this->equalTo('Hotel 1'),
                $this->equalTo('image.jpg'),
                $this->equalTo(5),
                $this->equalTo('City 1'),
                $this->equalTo('Description')
            );

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenHotelNotFound()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Hotel not found.');

        $command = new UpdateHotelCommand('uuid', 'Hotel 1', 'image.jpg', 5, 'City 1', 'Description');

        $this->updateHotelService->method('update')
            ->willThrowException(new \RuntimeException('Hotel not found.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenUpdateFails()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to update hotel.');

        $command = new UpdateHotelCommand('uuid', 'Hotel 1', 'image.jpg', 5, 'City 1', 'Description');

        $this->updateHotelService->method('update')
            ->willThrowException(new \RuntimeException('Failed to update hotel.'));

        $this->handler->handle($command);
    }
}
