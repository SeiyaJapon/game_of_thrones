<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

class Description
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromValue(string $value): Description
    {
        return new Description($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(Description $description): bool
    {
        return $this->value === $description->value;
    }
}
