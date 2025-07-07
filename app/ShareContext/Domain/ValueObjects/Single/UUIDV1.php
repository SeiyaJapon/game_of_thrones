<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UUIDV1 extends Id
{
    /**
     * @var UuidInterface
     */
    private $id;

    private function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    /**
     * @throws Exception
     */
    public static function generate(): UUIDV1
    {
        return new static(Uuid::uuid1());
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public static function fromString(string $string): Id
    {
        return new static(Uuid::fromString($string));
    }

    public function getHumanReadableId(): string
    {
        return $this->id->toString();
    }
}
