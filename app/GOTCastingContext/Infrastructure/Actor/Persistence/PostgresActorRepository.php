<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Actor\Persistence;

use App\GOTCastingContext\Domain\Actor\Actor;
use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorCreatedProducer;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorDeletedProducer;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorUpdatedProducer;
use App\Models\Actor as EloquentActor;

class PostgresActorRepository implements ActorRepositoryInterface
{
    private ActorCreatedProducer $actorCreatedProducer;
    private ActorUpdatedProducer $actorUpdatedProducer;
    private ActorDeletedProducer $actorDeletedProducer;

    public function __construct(
        ActorCreatedProducer $actorCreatedProducer,
        ActorUpdatedProducer $actorUpdatedProducer,
        ActorDeletedProducer $actorDeletedProducer
    ) {
        $this->actorCreatedProducer = $actorCreatedProducer;
        $this->actorUpdatedProducer = $actorUpdatedProducer;
        $this->actorDeletedProducer = $actorDeletedProducer;
    }

    public function findById(ActorId $id): Actor
    {
        // TODO: Implement findById() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function save(Actor $actor): void
    {
        EloquentActor::create([
            'id' => $actor->getId()->value(),
            'name' => $actor->getName()->value(),
            'biography' => $actor->getBiography()
        ]);

        $this->actorCreatedProducer->publish([
            'event' => 'ActorCreated',
            'data' => [
                'id' => $actor->getId()->value(),
                'name' => $actor->getName()->value(),
                'biography' => $actor->getBiography()
            ]
        ]);
    }

    public function update(Actor $actor): void
    {
        // TODO: Implement update() method.
    }

    public function updateById(ActorId $actorId, ?ActorName $actorName, ?string $biography): void
    {
        $eloquentActor = EloquentActor::find($actorId->value());

        if ($eloquentActor) {
            if ($actorName !== null) {
                $eloquentActor->name = $actorName->value();
            }

            $eloquentActor->biography = $biography;

            $eloquentActor->save();
        } else {
            throw new \Exception("Actor not found");
        }

        $this->actorUpdatedProducer->publish([
            'event' => 'ActorUpdated',
            'data' => [
                'id' => $actorId->value(),
                'name' => $actorName ? $actorName->value() : null,
                'biography' => $biography
            ]
        ]);
    }

    public function delete(ActorId $id): void
    {
        $eloquentActor = EloquentActor::find($id->value());

        if (!$eloquentActor) {
            throw new \Exception("Actor not found");
        }

        $eloquentActor->delete();

        $this->actorDeletedProducer->publish([
            'event' => 'ActorDeleted',
            'data' => [
                'id' => $id->value()
            ]
        ]);
    }

    public function searchByQuery(string $query): array
    {
        // TODO: Implement searchByQuery() method.
    }
}