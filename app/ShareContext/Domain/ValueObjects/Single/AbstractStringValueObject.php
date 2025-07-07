<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

abstract class AbstractStringValueObject
{
    /** @var string  */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
