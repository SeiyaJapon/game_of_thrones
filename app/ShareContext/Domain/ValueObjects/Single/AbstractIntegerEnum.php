<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

abstract class AbstractIntegerEnum extends AbstractIntegerValueObject
{
    use EnumTrait;

    /**
     * @throws \ReflectionException
     */
    private static function isValid(int $value): bool
    {
        return in_array($value, static::toArray(), true);
    }

    /**
     * @throws \ReflectionException
     */
    private function checkValueIsValid(int $value): void
    {
        if (!self::isValid($value)) {
            throw new \InvalidArgumentException(sprintf('%d is not a valid value. Valid values are %s', $value, implode(',', static::toArray())));
        }
    }

    protected static $cache = [];

    /**
     * @throws \ReflectionException
     */
    private function __construct($value)
    {
        $this->checkValueIsValid($value);
        parent::__construct($value);
    }

    /**
     * @throws \ReflectionException
     */
    public static function from(int $value): AbstractIntegerEnum
    {
        return new static($value);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    final public function equals(?AbstractIntegerEnum $variable): bool
    {
        return $this->value() === $variable->value() &&
            static::class === get_class($variable);
    }
}
