<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

abstract class AbstractNullableString extends AbstractStringValueObject
{
    public static function createOrNull(?string $value = null): ?AbstractNullableString
    {
        if (!$value) {
            return null;
        }
        return new static($value);
    }
}
