<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Collection;

use App\ShareContext\Domain\ValueObjects\Single\Id;

class IdCollection extends AbstractCollection
{
    protected function itemClass(): string
    {
        return Id::class;
    }
}
