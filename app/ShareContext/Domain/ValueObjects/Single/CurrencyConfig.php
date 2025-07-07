<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Single;

class CurrencyConfig
{
    /**
     * @var int
     */
    private $iso;

    /**
     * @var int
     */
    private $decimals;

    public function __construct(int $iso, int $decimals)
    {
        $this->iso = $iso;
        $this->decimals = $decimals;
    }

    public function iso(): int
    {
        return $this->iso;
    }

    public function decimals(): int
    {
        return $this->decimals;
    }
}
