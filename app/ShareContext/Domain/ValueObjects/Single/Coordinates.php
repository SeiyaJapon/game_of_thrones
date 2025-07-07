<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

class Coordinates
{
    /**
     * @var CoordinatesLongitude
     */
    private $longitude;

    /**
     * @var CoordinatesLatitude
     */
    private $latitude;

    private function __construct(CoordinatesLongitude $longitude, CoordinatesLatitude $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public static function fromValues(float $longitude, float $latitude): Coordinates
    {
        return new self(
            CoordinatesLongitude::fromValue($longitude),
            CoordinatesLatitude::fromValue($latitude)
        );
    }

    public function longitude(): CoordinatesLongitude
    {
        return $this->longitude;
    }

    public function latitude(): CoordinatesLatitude
    {
        return $this->latitude;
    }
}
