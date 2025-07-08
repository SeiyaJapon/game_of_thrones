<?php

namespace App\Providers;

use App\GOTCastingContext\Domain\Actor\ActorRepositoryInterface;
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
use App\GOTCastingContext\Infrastructure\Actor\Messaging\ActorCreatedProducer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ActorCreatedProducer::class, function () {
            return new ActorCreatedProducer(
                config('services.rabbitmq.host'),
                config('services.rabbitmq.port'),
                config('services.rabbitmq.user'),
                config('services.rabbitmq.password')
            );
        });

        $this->app->bind(CreateActorService::class, function ($app) {
            return new CreateActorService($app->make(ActorRepositoryInterface::class));
        });

        $this->app->bind(DeleteActorByIdService::class, function ($app) {
            return new DeleteActorByIdService($app->make(ActorRepositoryInterface::class));
        });

        $this->app->bind(FindActorByIdService::class, function ($app) {
            return new FindActorByIdService($app->make(ActorRepositoryInterface::class));
        });

        $this->app->bind(ListActorsService::class, function ($app) {
            return new ListActorsService($app->make(ActorRepositoryInterface::class));
        });

        $this->app->bind(SearchActorsService::class, function ($app) {
            return new SearchActorsService($app->make(ActorRepositoryInterface::class));
        });

        $this->app->bind(UpdateActorByIdService::class, function ($app) {
            return new UpdateActorByIdService($app->make(ActorRepositoryInterface::class));
        });

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
                $app->make(ActorRepositoryInterface::class),
                $app->make(CharacterRepositoryInterface::class)
            );
        });

        $this->app->bind(ListCharactersService::class, function ($app) {
            return new ListCharactersService($app->make(CharacterRepositoryInterface::class));
        });

        $this->app->bind(UpdateActorByIdService::class, function ($app) {
            return new UpdateActorByIdService($app->make(CharacterRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
