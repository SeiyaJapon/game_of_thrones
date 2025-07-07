<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use InvalidArgumentException;

class Url
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->checkValueIsAValidUrl($value);
        $this->value = $value;
    }

    public static function fromValue(string $value): Url
    {
        return new Url($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    private function checkValueIsAValidUrl(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("$value is not a valid url");
        }
    }

    public function equal(Url $url): bool
    {
        return $this->value == $url->value;
    }
}
