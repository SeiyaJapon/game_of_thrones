<?php

declare (strict_types=1);

namespace App\GOTCasting\Application\Actor\Query\GetActorById;

use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\Service\FindActorByIdService;

class GetActorByIdQueryHandler
{
    private FindActorByIdService $findActorByIdService;

    public function __construct(FindActorByIdService $findActorByIdService)
    {
        $this->findActorByIdService = $findActorByIdService;
    }

    public function ask(GetActorByIdQuery $query): GetActorByIdQueryResult
    {
        return new GetActorByIdQueryResult(
            $this->findActorByIdService->execute(
                new ActorId($query->actorId())
            )->toArray()
        );
    }
}