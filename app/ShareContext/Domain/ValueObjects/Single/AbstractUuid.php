<?php
declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

abstract class AbstractUuid
{
    private $value;

    public function __construct(string $value)
    {
        Assert::uuid($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    protected static function randomValue(): string
    {
        return Uuid::uuid4()->toString();
    }

    public function equals(AbstractUuid $id): bool
    {
        return $this->value() === $id->value() &&
            static::class === get_class($id);
    }
}
