<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use InvalidArgumentException;

class CoordinatesLongitude
{
    /**
     * @var float
     */
    private $value;

    private function __construct(float $value)
    {
        $this->checkLongitudeIsValid($value);
        $this->value = $value;
    }

    public static function fromValue(float $value): CoordinatesLongitude
    {
        return new self($value);
    }

    public function value(): float
    {
        return $this->value;
    }

    private function checkLongitudeIsValid(float $value): void
    {
        if ($value > 180 || $value < -180) {
            throw new InvalidArgumentException('Longitude must be a float number between -180.00 and 180.00.');
        }
    }
}
