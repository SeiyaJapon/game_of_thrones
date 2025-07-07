<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

abstract class AbstractFloatValueObject
{
    private $value;

    protected function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }
}
