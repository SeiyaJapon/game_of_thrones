<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use InvalidArgumentException;

abstract class AbstractJsonValueObject extends AbstractStringValueObject
{
    protected function __construct(string $value)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    protected function validate(string $value): void
    {
        if (null === json_decode($value)) {
            throw new InvalidArgumentException('The value is not a valid json string');
        }
    }

    public function toArray(): array
    {
        return json_decode($this->value(), true);
    }
}
