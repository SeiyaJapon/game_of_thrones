<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

abstract class GenerableId extends Id
{
    abstract public static function generate(): Id;
}
