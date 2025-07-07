<?php
declare(strict_types=1);

namespace App\ShareContext\Domain;

use Illuminate\Support\Facades\Event;

abstract class AggregateRoot
{
    private $domainEvents = [];

    public function pullDomainEvents(): array
    {
        $events = $this->domainEvents;

        $this->domainEvents = [];

        return $events;
    }

    final protected function record(Event $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
