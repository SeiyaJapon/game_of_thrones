<?php

declare (strict_types=1);

namespace App\GOTCasting\Infrastructure\Actor\Persistence;

use App\GOTCasting\Domain\Actor\Actor;
use App\GOTCasting\Domain\Actor\ActorId;
use App\GOTCasting\Domain\Actor\ActorName;
use App\GOTCasting\Domain\Actor\ActorRepositoryInterface;
use App\GOTCasting\Domain\Actor\Exception\ActorNotFoundException;
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
        throw new \BadMethodCallException("Write operations are not allowed in ElasticsearchActorRepository");
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
