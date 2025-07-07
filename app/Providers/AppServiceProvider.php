<?php

namespace App\Providers;

use App\HotelsContext\Domain\Common\FileParserStrategy;
use App\HotelsContext\Domain\Common\Services\CsvParser;
use App\HotelsContext\Domain\Common\Services\FileParserContext;
use App\HotelsContext\Domain\Common\Services\JsonParser;
use App\HotelsContext\Domain\Hotel\HotelRepositoryInterface;
use App\HotelsContext\Domain\Hotel\Services\CreateHotelService;
use App\HotelsContext\Domain\Hotel\Services\DeleteHotelService;
use App\HotelsContext\Domain\Hotel\Services\UpdateHotelService;
use App\HotelsContext\Infrastructure\Hotel\Persistence\Repositories\EloquentHotelRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('files', function () {
            return new Filesystem();
        });

        $this->app->singleton(FileParserStrategy::class, function ($app) {
            if (env('PARSER_TYPE') === 'csv') {
                return new CsvParser();
            }
            return new JsonParser();
        });

        $this->app->bind(HotelRepositoryInterface::class, EloquentHotelRepository::class);

        $this->app->singleton(FileParserContext::class, function ($app) {
            return new FileParserContext($app->make(FileParserStrategy::class));
        });

        $this->app->bind(CreateHotelService::class, function ($app) {
            return new CreateHotelService($app->make(HotelRepositoryInterface::class));
        });

        $this->app->bind(DeleteHotelService::class, function ($app) {
            return new DeleteHotelService($app->make(HotelRepositoryInterface::class));
        });

        $this->app->bind(UpdateHotelService::class, function ($app) {
            return new UpdateHotelService($app->make(HotelRepositoryInterface::class));
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
