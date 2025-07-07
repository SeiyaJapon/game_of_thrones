<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Application\Hotel\Query;

use App\HotelsContext\Application\Hotel\Query\GetHotelQuery;
use App\HotelsContext\Application\Hotel\Query\GetHotelQueryHandler;
use App\HotelsContext\Application\Hotel\Query\GetHotelQueryResult;
use App\HotelsContext\Domain\Hotel\Services\GetHotelService;
use App\HotelsContext\Domain\Hotel\Hotel;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class GetHotelQueryHandlerTest extends TestCase
{
    private GetHotelService|MockObject $getHotelService;
    private GetHotelQueryHandler $handler;

    protected function setUp(): void
    {
        $this->getHotelService = $this->createMock(GetHotelService::class);
        $this->handler = new GetHotelQueryHandler($this->getHotelService);
    }

    public function testHandleReturnsHotelSuccessfully()
    {
        $query = new GetHotelQuery('uuid');
        $hotel = new Hotel('uuid', 'Hotel 1', 'image.jpg', 5, 'City 1', 'Description');

        $this->getHotelService->method('get')
            ->with('uuid')
            ->willReturn($hotel);

        $result = $this->handler->ask($query);

        $this->assertInstanceOf(GetHotelQueryResult::class, $result);
        $hotelData = $result->result();
        $this->assertEquals('uuid', $hotelData['id']);
        $this->assertEquals('Hotel 1', $hotelData['name']);
        $this->assertEquals('image.jpg', $hotelData['image']);
        $this->assertEquals(5, $hotelData['stars']);
        $this->assertEquals('City 1', $hotelData['city']);
        $this->assertEquals('Description', $hotelData['description']);
    }

    public function testHandleReturnsNullWhenHotelNotFound()
    {
        $query = new GetHotelQuery('uuid');

        $this->getHotelService->method('get')
            ->with('uuid')
            ->willReturn(null);

        $result = $this->handler->ask($query);

        $this->assertNull($result);
    }
}
