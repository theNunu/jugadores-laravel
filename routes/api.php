<?php

use App\Http\Controllers\Api\PlayerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::prefix('players')->group(function () {
    Route::get('/', [PlayerController::class, 'index']);
    Route::post('/', [PlayerController::class, 'store']);
    Route::get('/{player_id}', [App\Http\Controllers\Api\PlayerController::class, 'show']); //jugador con sus competiones
    Route::get('/com/{competition_id}', [App\Http\Controllers\Api\PlayerController::class, 'showCom']); //competicion con sus jugadores

    Route::put('/{player_id}', [App\Http\Controllers\Api\PlayerController::class, 'update']);
    Route::delete('/{player_id}', [App\Http\Controllers\Api\PlayerController::class, 'destroy']);
});


Route::prefix('competitions')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\CompetitionController::class, 'index']);
    Route::post('/', [App\Http\Controllers\Api\CompetitionController::class, 'store']);
    Route::get('/{competition_id}', [App\Http\Controllers\Api\CompetitionController::class, 'show']);
    Route::put('/{competition_id}', [App\Http\Controllers\Api\CompetitionController::class, 'update']);
    // Route::put('/{competition}', [App\Http\Controllers\Api\CompetitionController::class, 'update']);
    // Route::delete('/{competition}', [App\Http\Controllers\Api\CompetitionController::class, 'destroy']);
});

Route::prefix('public')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\PublicController::class, 'index']);
    Route::get('/{player_id}', [App\Http\Controllers\Api\PublicController::class, 'show']); //jugador con sus competiones
    Route::get('/com/{competition_id}', [App\Http\Controllers\Api\PublicController::class, 'showCom']); //competicion con sus jugadores

    Route::get( '/{player_id}/competitions',[App\Http\Controllers\Api\PublicController::class, 'competitions']); //mostar un array de competiciones de un jugador
});
