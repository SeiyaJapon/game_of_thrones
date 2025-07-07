<?php

declare (strict_types = 1);

namespace App\ShareContext\Infrastructure\CommandBus;

use App\ShareContext\Application\Command\CommandInterface;

interface CommandBusInterface
{
    public function handle(CommandInterface $command);
}
