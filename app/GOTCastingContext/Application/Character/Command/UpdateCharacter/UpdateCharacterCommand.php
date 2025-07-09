<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Application\Character\Command\UpdateCharacter;

use App\ShareContext\Application\Command\CommandInterface;

class UpdateCharacterCommand implements CommandInterface
{
    public function __construct(
        private string $id,
        private ?string $name = null,
        private ?string $actorId = null,
        private ?string $houseName = null,
        private ?string $nickname = null,
        private ?string $characterImageThumb = null,
        private ?string $characterImageFull = null,
        private ?array $siblings = null,
        private ?array $parents = null,
        private ?array $killed = null,
        private ?array $guardedBy = null
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function actorId(): ?string
    {
        return $this->actorId;
    }

    public function houseName(): ?string
    {
        return $this->houseName;
    }

    public function nickname(): ?string
    {
        return $this->nickname;
    }

    public function characterImageThumb(): ?string
    {
        return $this->characterImageThumb;
    }

    public function characterImageFull(): ?string
    {
        return $this->characterImageFull;
    }

    public function siblings(): ?array
    {
        return $this->siblings;
    }

    public function parents(): ?array
    {
        return $this->parents;
    }

    public function killed(): ?array
    {
        return $this->killed;
    }

    public function guardedBy(): ?array
    {
        return $this->guardedBy;
    }
}