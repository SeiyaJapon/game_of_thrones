<?php

declare(strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Character\Persistence;

use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Character\Character;
use App\GOTCastingContext\Domain\Character\CharacterId;
use App\GOTCastingContext\Domain\Character\CharacterName;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;
use App\GOTCastingContext\Domain\Character\Exception\CharacterNotFoundException;
use Elastic\Elasticsearch\Client;
use Illuminate\Http\Response;

class ElasticsearchCharacterRepository implements CharacterRepositoryInterface
{
    private Client $client;
    private string $index;

    public function __construct(Client $client, string $index = 'characters')
    {
        $this->client = $client;
        $this->index = $index;
    }

    public function index(Character $character): void
    {
        try {
            $this->client->index([
                'index' => $this->index,
                'id'    => $character->getId()->value(),
                'body'  => [
                    'id' => $character->getId()->value(),
                    'name' => $character->getName()->value(),
                    'actor_id' => $character->getActorId()?->value(),
                ]
            ]);
        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to index character: " . $e->getMessage(), $e->getCode(), $e);
        }
    }


    public function findById(CharacterId $id): Character
    {
        try {
            $response = $this->client->get([
                'index' => $this->index,
                'id'    => $id->value(),
            ]);

            $source = $response['_source'] ?? null;

            if (!$source) {
                throw new CharacterNotFoundException($id->value());
            }

            return new Character(
                new CharacterId($source['id']),
                new CharacterName($source['name']),
                $source['biography'] ?? null,
                $source['actor_id'] ?? null
            );
        } catch (\Exception $e) {
            if ($e->getCode() === Response::HTTP_NOT_FOUND) {
                throw new CharacterNotFoundException($id->value());
            }

            throw new \RuntimeException("Unexpected error fetching character by ID: " . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function findAll(): array
    {
        $response = $this->client->search([
            'index' => $this->index,
            'body' => [
                'query' => [
                    'match_all' => (object) []
                ]
            ]
        ]);

        $characters = [];

        foreach ($response['hits']['hits'] as $hit) {
            $source = $hit['_source'];

            $characters[] = new Character(
                new CharacterId($source['id']),
                new CharacterName($source['name']),
                $source['biography'] ?? null,
                $source['actor_id'] ?? null
            );
        }

        return $characters;
    }

    public function save(Character $character): void
    {
        throw new \BadMethodCallException("Write operations are not allowed in ElasticsearchCharacterRepository");
    }

    public function update(Character $character): void
    {
        throw new \BadMethodCallException("Write operations are not allowed in ElasticsearchCharacterRepository");
    }

    public function delete(CharacterId $id): void
    {
        throw new \BadMethodCallException("Write operations are not allowed in ElasticsearchCharacterRepository");
    }

    public function updateById(CharacterId $characterId, ?CharacterName $characterName, ?string $biography): void
    {
        // TODO: Implement updateById() method.
    }

    public function searchByQuery(string $query): array
    {
        $response = $this->client->search([
            'index' => $this->index,
            'body' => [
                'query' => [
                    'match' => [
                        'name' => [
                            'query'     => $query,
                            'fuzziness' => 'AUTO'
                        ]
                    ]
                ]
            ]
        ]);

        $characters = [];

        foreach ($response['hits']['hits'] as $hit) {
            $source = $hit['_source'];

            $characters[] = new Character(
                new CharacterId($source['id']),
                new CharacterName($source['name']),
                $source['biography'] ?? null,
                $source['actor_id'] ?? null
            );
        }

        return $characters;
    }

    public function linkToActor(CharacterId $characterId, ActorId $actorId): void
    {
        throw new \BadMethodCallException("Write operations are not allowed in ElasticsearchCharacterRepository");
    }
}