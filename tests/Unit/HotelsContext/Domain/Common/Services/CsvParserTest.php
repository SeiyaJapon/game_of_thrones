<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Domain\Common\Services;

use PHPUnit\Framework\TestCase;
use App\HotelsContext\Domain\Common\Services\CsvParser;

class CsvParserTest extends TestCase
{
    public function testParseValidCsv()
    {
        $csvContent = "name;city\nHotel 1;City 1\nHotel 2;City 2";
        $filePath = tempnam(sys_get_temp_dir(), 'test') . '.csv';
        file_put_contents($filePath, $csvContent);

        $csvParser = new CsvParser();
        $result = $csvParser->parse($filePath);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Hotel 1', $result[0]['name']);
        $this->assertEquals('City 1', $result[0]['city']);
        $this->assertEquals('Hotel 2', $result[1]['name']);
        $this->assertEquals('City 2', $result[1]['city']);

        unlink($filePath); // Clean up the temporary file
    }
}
