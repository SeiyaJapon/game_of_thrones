<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Domain\Common\Services;

use PHPUnit\Framework\TestCase;
use App\HotelsContext\Domain\Common\Services\FieldMapper;

class FieldMapperTest extends TestCase
{
    private FieldMapper $fieldMapper;

    protected function setUp(): void
    {
        $this->fieldMapper = new FieldMapper();
    }

    public function testMapValidData()
    {
        $data = [
            ['Hotel Name' => 'Hotel 1', 'City' => 'City 1'],
            ['Hotel Name' => 'Hotel 2', 'City' => 'City 2']
        ];
        $result = $this->fieldMapper->map($data);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Hotel 1', $result[0]['name']);
        $this->assertEquals('City 1', $result[0]['city']);
        $this->assertEquals('Hotel 2', $result[1]['name']);
        $this->assertEquals('City 2', $result[1]['city']);
    }

    public function testMapEmptyData()
    {
        $data = [];
        $result = $this->fieldMapper->map($data);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testMapDataWithMissingFields()
    {
        $data = [
            ['Hotel Name' => 'Hotel 1'],
            ['City' => 'City 2']
        ];
        $result = $this->fieldMapper->map($data);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Hotel 1', $result[0]['name']);
        $this->assertArrayNotHasKey('city', $result[0]);
        $this->assertEquals('City 2', $result[1]['city']);
        $this->assertArrayNotHasKey('name', $result[1]);
    }

    public function testMapDataWithExtraFields()
    {
        $data = [
            ['Hotel Name' => 'Hotel 1', 'City' => 'City 1', 'extra' => 'Extra 1'],
            ['Hotel Name' => 'Hotel 2', 'City' => 'City 2', 'extra' => 'Extra 2']
        ];
        $result = $this->fieldMapper->map($data);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Hotel 1', $result[0]['name']);
        $this->assertEquals('City 1', $result[0]['city']);
        $this->assertArrayNotHasKey('extra', $result[0]);
        $this->assertEquals('Hotel 2', $result[1]['name']);
        $this->assertEquals('City 2', $result[1]['city']);
        $this->assertArrayNotHasKey('extra', $result[1]);
    }
}
