<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Application\Hotel\Command;

use PHPUnit\Framework\TestCase;
use App\HotelsContext\Application\Hotel\Command\CreateHotelCommand;
use App\HotelsContext\Application\Hotel\Command\CreateHotelCommandHandler;
use App\HotelsContext\Domain\Hotel\Services\CreateHotelService;
use PHPUnit\Framework\MockObject\MockObject;

class CreateHotelCommandHandlerTest extends TestCase
{
    private CreateHotelService|MockObject $createHotelService;
    private CreateHotelCommandHandler $handler;

    protected function setUp(): void
    {
        $this->createHotelService = $this->createMock(CreateHotelService::class);
        $this->handler = new CreateHotelCommandHandler($this->createHotelService);
    }

    public function testHandleCreatesHotelSuccessfully()
    {
        $command = new CreateHotelCommand('uuid', 'Hotel 1', 'image.jpg', 5, 'City 1', 'Description');

        $this->createHotelService->expects($this->once())
            ->method('create')
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

    public function testHandleThrowsExceptionWhenHotelAlreadyExists()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Hotel already exists.');

        $command = new CreateHotelCommand('uuid', 'Hotel 1', 'image.jpg', 5, 'City 1', 'Description');

        $this->createHotelService->method('create')
            ->willThrowException(new \RuntimeException('Hotel already exists.'));

        $this->handler->handle($command);
    }

    public function testHandleThrowsExceptionWhenSaveFails()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Failed to save hotel.');

        $command = new CreateHotelCommand('uuid', 'Hotel 1', 'image.jpg', 5, 'City 1', 'Description');

        $this->createHotelService->method('create')
            ->willThrowException(new \RuntimeException('Failed to save hotel.'));

        $this->handler->handle($command);
    }
}
