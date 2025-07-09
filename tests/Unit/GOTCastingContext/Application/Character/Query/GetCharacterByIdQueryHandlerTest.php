<?php

declare(strict_types=1);

namespace Tests\Unit\GOTCastingContext\Application\Character\Query;

use App\GOTCastingContext\Domain\Character\Exception\CharacterNotFoundException;
use PHPUnit\Framework\TestCase;
use App\GOTCastingContext\Application\Character\Query\GetCharacterById\GetCharacterByIdQuery;
use App\GOTCastingContext\Application\Character\Query\GetCharacterById\GetCharacterByIdQueryHandler;
use App\GOTCastingContext\Application\Character\Query\GetCharacterById\GetCharacterByIdQueryResult;
use App\GOTCastingContext\Domain\Character\Service\FindCharacterByIdService;
use App\GOTCastingContext\Domain\Character\Character;
use PHPUnit\Framework\MockObject\MockObject;
use Ramsey\Uuid\Uuid;

class GetCharacterByIdQueryHandlerTest extends TestCase
{
    private FindCharacterByIdService|MockObject $findCharacterByIdService;
    private GetCharacterByIdQueryHandler $handler;

    protected function setUp(): void
    {
        $this->findCharacterByIdService = $this->createMock(FindCharacterByIdService::class);
        $this->handler = new GetCharacterByIdQueryHandler($this->findCharacterByIdService);
    }

    public function testHandleReturnsCharacterSuccessfully()
    {
        $id = Uuid::uuid4()->toString();
        $query = new GetCharacterByIdQuery($id);
        $character = $this->createMock(Character::class);

        $this->findCharacterByIdService->method('execute')
            ->with($this->callback(fn($idObj) => method_exists($idObj, 'value') && $idObj->value() === $id))
            ->willReturn($character);

        $result = $this->handler->handle($query);

        $this->assertInstanceOf(GetCharacterByIdQueryResult::class, $result);
    }

    public function testHandleThrowsExceptionWhenCharacterNotFound()
    {
        $id = Uuid::uuid4()->toString();
        $query = new GetCharacterByIdQuery($id);

        $this->findCharacterByIdService->method('execute')
            ->with($this->callback(fn($idObj) => method_exists($idObj, 'value') && $idObj->value() === $id))
            ->willThrowException(new CharacterNotFoundException($id));

        $this->expectException(CharacterNotFoundException::class);

        $this->handler->handle($query);
    }
} 