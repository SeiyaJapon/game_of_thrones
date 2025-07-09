<?php

namespace App\Providers;

use App\GOTCastingContext\Domain\Actor\Service\CreateActorService;
use App\GOTCastingContext\Domain\Actor\Service\DeleteActorByIdService;
use App\GOTCastingContext\Domain\Actor\Service\FindActorByIdService;
use App\GOTCastingContext\Domain\Actor\Service\ListActorsService;
use App\GOTCastingContext\Domain\Actor\Service\SearchActorsService;
use App\GOTCastingContext\Domain\Actor\Service\UpdateActorByIdService;
use App\GOTCastingContext\Domain\Character\CharacterRepositoryInterface;
use App\GOTCastingContext\Domain\Character\Service\CreateCharacterService;
use App\GOTCastingContext\Domain\Character\Service\DeleteCharacterByIdService;
use App\GOTCastingContext\Domain\Character\Service\FindCharacterByIdService;
use App\GOTCastingContext\Domain\Character\Service\LinkCharacterToActorService;
use App\GOTCastingContext\Domain\Character\Service\ListCharactersService;
use App\GOTCastingContext\Domain\Character\Service\SearchCharactersService;
use App\GOTCastingContext\Domain\Character\Service\UpdateCharacterByIdService;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorCreatedConsumer;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorCreatedProducer;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorDeletedConsumer;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorDeletedProducer;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorUpdatedConsumer;
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorUpdatedProducer;
use App\GOTCastingContext\Infrastructure\Actor\Persistence\ElasticsearchActorRepository;
use App\GOTCastingContext\Infrastructure\Actor\Persistence\PostgresActorRepository;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterCreatedConsumer;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterCreatedProducer;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterDeletedConsumer;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterDeletedProducer;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterUpdatedConsumer;
use App\GOTCastingContext\Infrastructure\Character\Messaging\CharacterUpdatedProducer;
use App\GOTCastingContext\Infrastructure\Character\Persistence\ElasticsearchCharacterRepository;
use App\GOTCastingContext\Infrastructure\Character\Persistence\PostgresCharacterRepository;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Actor — command side (Postgres)
        $this->app->bind(PostgresActorRepository::class, function () {
            return new PostgresActorRepository(
                app(ActorCreatedProducer::class),
                app(ActorUpdatedProducer::class),
                app(ActorDeletedProducer::class)
            );
        });

        // Actor — query side (Elasticsearch)
        $this->app->bind(ElasticsearchActorRepository::class, function () {
            $client = ClientBuilder::create()
                ->setHosts([config('services.elasticsearch.host')])
                ->build();
            return new ElasticsearchActorRepository($client);
        });

        // Elasticsearch client
        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts([config('services.elasticsearch.host')])
                ->build();
        });

        $this->app->bind(ElasticsearchCharacterRepository::class, function ($app) {
            return new ElasticsearchCharacterRepository($app->make(Client::class));
        });

        // Character — command side (Postgres)
        $this->app->bind(CharacterRepositoryInterface::class, PostgresCharacterRepository::class);

        // Actor Producers
        $this->app->bind(ActorCreatedProducer::class, function () {
            return new ActorCreatedProducer(
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        $this->app->bind(ActorUpdatedProducer::class, function () {
            return new ActorUpdatedProducer(
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        $this->app->bind(ActorDeletedProducer::class, function () {
            return new ActorDeletedProducer(
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        // Character Producers
        $this->app->bind(CharacterCreatedProducer::class, function () {
            return new CharacterCreatedProducer(
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        $this->app->bind(CharacterUpdatedProducer::class, function () {
            return new CharacterUpdatedProducer(
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        $this->app->bind(CharacterDeletedProducer::class, function () {
            return new CharacterDeletedProducer(
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        // Consumers
        $this->app->bind(CharacterCreatedConsumer::class, function ($app) {
            return new CharacterCreatedConsumer(
                $app->make(ElasticsearchCharacterRepository::class),
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });
        $this->app->bind(CharacterUpdatedConsumer::class, function ($app) {
            return new CharacterUpdatedConsumer(
                $app->make(ElasticsearchCharacterRepository::class),
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });
        $this->app->bind(CharacterDeletedConsumer::class, function ($app) {
            return new CharacterDeletedConsumer(
                $app->make(ElasticsearchCharacterRepository::class),
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });
        $this->app->bind(ActorCreatedConsumer::class, function ($app) {
            return new ActorCreatedConsumer(
                $app->make(ElasticsearchActorRepository::class),
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });
        $this->app->bind(ActorUpdatedConsumer::class, function ($app) {
            return new ActorUpdatedConsumer(
                $app->make(ElasticsearchActorRepository::class),
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });
        $this->app->bind(ActorDeletedConsumer::class, function ($app) {
            return new ActorDeletedConsumer(
                $app->make(ElasticsearchActorRepository::class),
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        // Actor services (command side)
        $this->app->bind(CreateActorService::class, function ($app) {
            return new CreateActorService($app->make(PostgresActorRepository::class));
        });

        $this->app->bind(DeleteActorByIdService::class, function ($app) {
            return new DeleteActorByIdService($app->make(PostgresActorRepository::class));
        });

        $this->app->bind(UpdateActorByIdService::class, function ($app) {
            return new UpdateActorByIdService($app->make(PostgresActorRepository::class));
        });

        // Actor services (query side)
        $this->app->bind(FindActorByIdService::class, function ($app) {
            return new FindActorByIdService($app->make(ElasticsearchActorRepository::class));
        });

        $this->app->bind(ListActorsService::class, function ($app) {
            return new ListActorsService($app->make(ElasticsearchActorRepository::class));
        });

        $this->app->bind(SearchActorsService::class, function ($app) {
            return new SearchActorsService($app->make(ElasticsearchActorRepository::class));
        });

        // Character services (command side)
        $this->app->bind(CreateCharacterService::class, function ($app) {
            return new CreateCharacterService($app->make(CharacterRepositoryInterface::class));
        });

        $this->app->bind(DeleteCharacterByIdService::class, function ($app) {
            return new DeleteCharacterByIdService($app->make(CharacterRepositoryInterface::class));
        });

        $this->app->bind(FindCharacterByIdService::class, function ($app) {
            return new FindCharacterByIdService($app->make(CharacterRepositoryInterface::class));
        });

        $this->app->bind(LinkCharacterToActorService::class, function ($app) {
            return new LinkCharacterToActorService(
                $app->make(PostgresActorRepository::class),
                $app->make(CharacterRepositoryInterface::class)
            );
        });

        $this->app->bind(ListCharactersService::class, function ($app) {
            return new ListCharactersService($app->make(CharacterRepositoryInterface::class));
        });

        $this->app->bind(UpdateCharacterByIdService::class, function ($app) {
            return new UpdateCharacterByIdService($app->make(CharacterRepositoryInterface::class));
        });

        $this->app->bind(SearchCharactersService::class, function ($app) {
            return new SearchCharactersService($app->make(ElasticsearchCharacterRepository::class));
        });
    }

    public function boot(): void
    {
        //
    }
}
