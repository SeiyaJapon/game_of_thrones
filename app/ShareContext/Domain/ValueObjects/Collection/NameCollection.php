<?php

declare(strict_types=1);

namespace App\ShareContext\Domain\ValueObjects\Collection;

use App\ShareContext\Domain\ValueObjects\Single\Name;

class NameCollection extends AbstractCollection
{
    protected function itemClass(): string
    {
        return Name::class;
    }
}
