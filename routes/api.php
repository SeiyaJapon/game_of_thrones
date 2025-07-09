<?php

use App\GOTCastingContext\Infrastructure\Actor\Http\CreateActorController;
use App\GOTCastingContext\Infrastructure\Actor\Http\DeleteActorByIdController;
use App\GOTCastingContext\Infrastructure\Actor\Http\GetActorByIdController;
use App\GOTCastingContext\Infrastructure\Actor\Http\ListActorsController;
use App\GOTCastingContext\Infrastructure\Actor\Http\SearchActorsController;
use App\GOTCastingContext\Infrastructure\Actor\Http\UpdateActorByIdController;
use App\GOTCastingContext\Infrastructure\Character\Http\CreateCharacterController;
use App\GOTCastingContext\Infrastructure\Character\Http\DeleteCharacterByIdController;
use App\GOTCastingContext\Infrastructure\Character\Http\GetCharacterByIdController;
use App\GOTCastingContext\Infrastructure\Character\Http\ListCharactersController;
use App\GOTCastingContext\Infrastructure\Character\Http\SearchCharactersController;
use App\GOTCastingContext\Infrastructure\Character\Http\UpdateCharacterByIdController;
use Illuminate\Support\Facades\Route;

Route::prefix('actors')->group(function () {
    Route::post('/', CreateActorController::class);
    Route::get('/list', ListActorsController::class);
    Route::get('/{id}', GetActorByIdController::class);
    Route::post('/search', SearchActorsController::class);
    Route::put('/{id}', UpdateActorByIdController::class);
    Route::delete('/{id}', DeleteActorByIdController::class);
});

Route::prefix('characters')->group(function () {
    Route::post('/', CreateCharacterController::class);
    Route::get('/list', ListCharactersController::class);
    Route::get('/{id}', GetCharacterByIdController::class);
    Route::post('/search', SearchCharactersController::class);
    Route::put('/{id}', UpdateCharacterByIdController::class);
    Route::delete('/{id}', DeleteCharacterByIdController::class);
});