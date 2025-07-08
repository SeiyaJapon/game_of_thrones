<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Domain\Actor;

use App\ShareContext\Domain\AggregateRoot;

class Actor extends AggregateRoot
{
    private ActorId $id;
    private ActorName $name;
    private ?string $biography;

    public function __construct(
        ActorId $id,
        ActorName $name,
        ?string $biography = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
    }

    public function rename(ActorName $newName): void
    {
        $this->name = $newName;
    }

    public function getName(): ActorName
    {
        return $this->name;
    }
    public function getId(): ActorId
    {
        return $this->id;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setId(ActorId $id): void
    {
        $this->id = $id;
    }

    public function setName(ActorName $name): void
    {
        $this->name = $name;
    }

    public function setBiography(?string $biography): void
    {
        $this->biography = $biography;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'biography' => $this->biography,
        ];
    }
}
