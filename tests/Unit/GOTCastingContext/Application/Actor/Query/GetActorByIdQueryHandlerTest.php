<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Application\Actor\Query;

use App\GOTCastingContext\Domain\Actor\Exception\ActorNotFoundException;
use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Application\Actor\Query\GetActorById\GetActorByIdQuery;
use App\GOTCastingContext\Application\Actor\Query\GetActorById\GetActorByIdQueryHandler;
use App\GOTCastingContext\Application\Actor\Query\GetActorById\GetActorByIdQueryResult;
use App\GOTCastingContext\Domain\Actor\Service\FindActorByIdService;
use App\GOTCastingContext\Domain\Actor\Actor;
use PHPUnit\Framework\MockObject\MockObject;
use Ramsey\Uuid\Uuid;

class GetActorByIdQueryHandlerTest extends TestCase
{
    private FindActorByIdService|MockObject $findActorByIdService;
    private GetActorByIdQueryHandler $handler;

    protected function setUp(): void
    {
        $this->findActorByIdService = $this->createMock(FindActorByIdService::class);
        $this->handler = new GetActorByIdQueryHandler($this->findActorByIdService);
    }

    public function testHandleReturnsActorSuccessfully()
    {
        $id = Uuid::uuid4()->toString();
        $query = new GetActorByIdQuery($id);
        $actor = $this->createMock(Actor::class);

        $this->findActorByIdService->method('execute')
            ->with($this->callback(fn($idObj) => method_exists($idObj, 'value') && $idObj->value() === $id))
            ->willReturn($actor);

        $result = $this->handler->handle($query);

        $this->assertInstanceOf(GetActorByIdQueryResult::class, $result);
    }

    public function testHandleThrowsExceptionWhenActorNotFound()
    {
        $this->expectException(ActorNotFoundException::class);

        $id = Uuid::uuid4()->toString();
        $query = new GetActorByIdQuery($id);

        $this->findActorByIdService->method('execute')
            ->with($this->callback(fn($idObj) => method_exists($idObj, 'value') && $idObj->value() === $id))
            ->willThrowException(new ActorNotFoundException($id));

        $this->handler->handle($query);
    }
} 