<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

trait EnumTrait
{
    /**
     * @throws \ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        $array = static::toArray();
        $constantName = strtoupper(self::camelToSnake($name));
        if (isset($array[$constantName]) || array_key_exists($constantName, $array)) {
            return new static($array[$constantName]);
        }
        throw new \BadMethodCallException("No static method or enum constant '$name' in class ".static::class);
    }

    protected static function camelToSnake(string $word): string
    {
        return ctype_lower($word) ? $word : strtolower(preg_replace('/([^A-Z\s])([A-Z])/', '$1_$2', $word));
    }

    /**
     * @throws \ReflectionException
     */
    protected static function toArray()
    {
        $class = static::class;

        if (!isset(static::$cache[$class])) {
            $reflection = new \ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }

        return static::$cache[$class];
    }
}
