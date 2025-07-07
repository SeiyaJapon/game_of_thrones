<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Domain\Common\Services;

use PHPUnit\Framework\TestCase;
use App\HotelsContext\Domain\Common\Services\JsonParser;

class JsonParserTest extends TestCase
{
    public function testParseValidJson()
    {
        $jsonContent = '[{"name": "Hotel 1", "city": "City 1"}, {"name": "Hotel 2", "city": "City 2"}]';
        $filePath = tempnam(sys_get_temp_dir(), 'test') . '.json';
        file_put_contents($filePath, $jsonContent);

        $jsonParser = new JsonParser();
        $result = $jsonParser->parse($filePath);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Hotel 1', $result[0]['name']);
        $this->assertEquals('City 1', $result[0]['city']);
        $this->assertEquals('Hotel 2', $result[1]['name']);
        $this->assertEquals('City 2', $result[1]['city']);

        unlink($filePath); // Clean up the temporary file
    }
}
