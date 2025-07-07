<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use InvalidArgumentException;

/**
 * @deprecated use AbstractStringEnum
 */
abstract class Enum
{
    protected $value;

    private function __construct($value)
    {
        $this->checkValueIsValid($value);
        $this->value = $value;
    }

    /**
     * @param $value
     *
     * @return static
     */
    public static function fromValue($value)
    {
        return new static($value);
    }

    /**
     * Returns value.
     *
     * Override this method to strict type your Enum.
     */
    public function value()
    {
        return $this->value;
    }

    abstract public function allowedValues(): array;

    /**
     * Checks whether the value is valid for this Enum.
     *
     * Override this method to add other validations.
     *
     * @param $value
     */
    protected function checkValueIsValid($value): void
    {
        if (!in_array($value, $this->allowedValues())) {
            throw new InvalidArgumentException($this->valueNotValidMessage($value));
        }
    }

    /**
     * Generates the error message.
     *
     * Override this method if the validation is ok, but you want a different message.
     *
     * @param $value
     */
    protected function valueNotValidMessage($value): string
    {
        return "$value is not a valid value for this Enum";
    }

    public function equal(Enum $enum): bool
    {
        return $this->value == $enum->value;
    }
}
