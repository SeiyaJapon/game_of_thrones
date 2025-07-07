<?php

declare (strict_types=1);

namespace App\GOTCasting\Infrastructure\Actor\Persistence;

use App\GOTCasting\Domain\Actor\Actor;
use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\ActorName;
use App\GOTCasting\Domain\Actor\ActorRepositoryInterface;
use App\GOTCasting\Infrastructure\Actor\Messaging\ActorCreatedProducer;
use App\GOTCasting\Infrastructure\Actor\Messaging\ActorDeletedProducer;
use App\GOTCasting\Infrastructure\Actor\Messaging\ActorUpdatedProducer;
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

    public function findById(ActorId $id): ?Actor
    {
        // TODO: Implement findById() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function save(Actor $actor): void
    {
        EloquentActor::create(
            $actor->getId()->value(),
            $actor->getName()->value(),
            $actor->getBiography()
        );

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

        if ($eloquentActor) {
            $eloquentActor->delete();
        } else {
            throw new \Exception("Actor not found");
        }

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