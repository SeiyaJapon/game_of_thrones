<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use InvalidArgumentException;

class Name
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromValue(string $value): Name
    {
        self::checkValueIsAValidName($value);
        return new Name($value);
    }

    protected static function checkValueIsAValidName(string $value): void
    {
        if (strlen($value) === 0) {
            throw new InvalidArgumentException("Name value must have at least one character");
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(Name $name): bool
    {
        return $this->value === $name->value;
    }
}
