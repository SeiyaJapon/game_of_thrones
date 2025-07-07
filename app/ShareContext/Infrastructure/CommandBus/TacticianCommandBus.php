<?php

declare (strict_types=1);

namespace App\ShareContext\Infrastructure\CommandBus;

use App\ShareContext\Application\Command\CommandInterface;
use League\Tactician\CommandBus;

class TacticianCommandBus implements CommandBusInterface
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(CommandInterface $command)
    {
        return $this->commandBus->handle($command);
    }
}
