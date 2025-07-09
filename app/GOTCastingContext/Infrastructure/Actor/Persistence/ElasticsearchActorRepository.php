<?php

declare (strict_types=1);

namespace App\GOTCastingContext\Infrastructure\Actor\Persistence;

use App\GOTCastingContext\Domain\Actor\Actor;
use App\GOTCastingContext\Domain\Actor\ActorId;
use App\GOTCastingContext\Domain\Actor\ActorName;
use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;
use App\GOTCastingContext\Domain\Actor\Exception\ActorNotFoundException;
use Elastic\Elasticsearch\Client;
use Illuminate\Http\Response;

class ElasticsearchActorRepository implements ActorRepositoryInterface
{
    private Client $client;
    private string $index;

    public function __construct(Client $client, string $index = 'actors')
    {
        $this->client = $client;
        $this->index = $index;
    }

    public function index(Actor $actor): void
    {
        try {
            $this->client->index([
                'index' => $this->index,
                'id'    => $actor->getId()->value(),
                'body'  => [
                    'id' => $actor->getId()->value(),
                    'name' => $actor->getName()->value(),
                    'biography' => $actor->getBiography()
                ]
            ]);
        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to index actor: " . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function findById(ActorId $id): Actor
    {
        try {
            $response = $this->client->get([
                'index' => $this->index,
                'id'    => $id->value(),
            ]);

            $source = $response['_source'] ?? null;

            if (!$source) {
                throw new ActorNotFoundException($id->value());
            }

            return new Actor(
                new ActorId($source['id']),
                new ActorName($source['name']),
                $source['biography'] ?? null
            );
        } catch (\Exception $e) {
            if ($e->getCode() === Response::HTTP_NOT_FOUND) {
                throw new ActorNotFoundException($id->value());
            }

            throw new \RuntimeException("Unexpected error fetching actor by ID: " . $e->getMessage(), $e->getCode(), $e);
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

        $actors = [];

        foreach ($response['hits']['hits'] as $hit) {
            $source = $hit['_source'];

            $actors[] = new Actor(
                new ActorId($source['id']),
                new ActorName($source['name']),
                $source['biography'] ?? null
            );
        }

        return $actors;
    }

    public function save(Actor $actor): void
    {
        throw new \BadMethodCallException("Write operations are not allowed in ElasticsearchActorRepository");
    }

    public function update(Actor $actor): void
    {
        throw new \BadMethodCallException("Write operations are not allowed in ElasticsearchActorRepository");
    }

    public function delete(ActorId $id): void
    {
        try {
            $response = $this->client->delete([
                'index' => $this->index,
                'id'    => $id->value(),
                'client' => [
                    'ignore' => [404]
                ]
            ]);

            if (!isset($response['result']) || ($response['result'] !== 'deleted' && $response['result'] !== 'not_found')) {
                throw new \RuntimeException("Failed to delete actor from Elasticsearch: " . json_encode($response));
            }

        } catch (\Exception $e) {
            throw new \RuntimeException("Error deleting actor from Elasticsearch: " . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function updateById(ActorId $actorId, ?ActorName $actorName, ?string $biography): void
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

        $actors = [];

        foreach ($response['hits']['hits'] as $hit) {
            $source = $hit['_source'];

            $actors[] = new Actor(
                new ActorId($source['id']),
                new ActorName($source['name']),
                $source['biography'] ?? null
            );
        }

        return $actors;
    }
}
