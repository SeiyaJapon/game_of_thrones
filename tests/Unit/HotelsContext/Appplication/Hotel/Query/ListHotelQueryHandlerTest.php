<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Application\Hotel\Query;

use App\HotelsContext\Application\Hotel\Query\ListHotelQuery;
use App\HotelsContext\Application\Hotel\Query\ListHotelQueryHandler;
use App\HotelsContext\Application\Hotel\Query\ListHotelQueryResult;
use App\HotelsContext\Domain\Hotel\Hotel;
use App\HotelsContext\Domain\Hotel\Services\ListHotelService;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class ListHotelQueryHandlerTest extends TestCase
{
    private ListHotelService|MockObject $listHotelsService;
    private ListHotelQueryHandler $handler;

    protected function setUp(): void
    {
        $this->listHotelsService = $this->createMock(ListHotelService::class);
        $this->handler = new ListHotelQueryHandler($this->listHotelsService);
    }

    public function testHandleReturnsListOfHotels()
    {
        $query = new ListHotelQuery();
        $expectedResult = [
            new Hotel('uuid1', 'Hotel 1', 'image1.jpg', 5, 'City 1', 'Description 1'),
            new Hotel('uuid2', 'Hotel 2', 'image2.jpg', 4, 'City 2', 'Description 2')
        ];

        $this->listHotelsService->expects($this->once())
            ->method('list')
            ->willReturn($expectedResult);

        $result = $this->handler->ask($query);

        $this->assertInstanceOf(ListHotelQueryResult::class, $result);
        $this->assertIsArray($result->result());
        $this->assertCount(2, $result->result());
    }

    public function testHandleReturnsEmptyListWhenNoHotelsFound()
    {
        $query = new ListHotelQuery();
        $expectedResult = [];

        $this->listHotelsService->expects($this->once())
            ->method('list')
            ->willReturn($expectedResult);

        $result = $this->handler->ask($query);

        $this->assertInstanceOf(ListHotelQueryResult::class, $result);
        $this->assertIsArray($result->result());
        $this->assertEmpty($result->result());
    }
}
