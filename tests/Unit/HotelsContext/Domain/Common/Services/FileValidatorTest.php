<?php

declare(strict_types=1);

namespace Tests\Unit\HotelsContext\Domain\Common\Services;

use PHPUnit\Framework\TestCase;
use App\HotelsContext\Domain\Common\Services\FileValidator;

class FileValidatorTest extends TestCase
{
    public function testValidateExistingFile()
    {
        $filePath = tempnam(sys_get_temp_dir(), 'test') . '.csv';
        file_put_contents($filePath, "name;city\nHotel 1;City 1");

        $fileValidator = new FileValidator();
        $result = $fileValidator->validate($filePath);

        $this->assertTrue($result);

        unlink($filePath); // Clean up the temporary file
    }

    public function testValidateNonExistingFile()
    {
        $fileValidator = new FileValidator();
        $result = $fileValidator->validate('/path/to/nonexistent/file.csv');

        $this->assertFalse($result);
    }
}
