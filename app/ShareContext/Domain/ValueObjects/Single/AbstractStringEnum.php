<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use function get_class;
use function in_array;
use InvalidArgumentException;
use ReflectionException;

abstract class AbstractStringEnum extends AbstractStringValueObject
{
    use EnumTrait;

    /**
     * @throws ReflectionException
     */
    private static function isValid(string $value): bool
    {
        return in_array($value, static::toArray(), true);
    }

    /**
     * @throws ReflectionException
     */
    private function checkValueIsValid(string $value): void
    {
        if (!self::isValid($value)) {
            throw new InvalidArgumentException(sprintf('%s is not a valid value. Valid values are %s', $value, implode(',', static::toArray())));
        }
    }

    protected static $cache = [];

    /**
     * @throws ReflectionException
     */
    public function __construct($value)
    {
        $this->checkValueIsValid($value);
        parent::__construct($value);
    }

    /**
     * @throws ReflectionException
     */
    public static function from(string $value): AbstractStringEnum
    {
        return new static($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    final public function equals(?AbstractStringEnum $variable): bool
    {
        return $this->value() === $variable->value() &&
            static::class === get_class($variable);
    }
}
