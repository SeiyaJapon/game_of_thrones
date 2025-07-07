<?php

declare (strict_types=1);

namespace App\ShareContext\Infrastructure\QueryBus;

use App\ShareContext\Application\Query\QueryInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query);
}
