<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoGamesController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('register', [AuthController::class, 'register']); // User's register
Route::post('login', [AuthController::class, 'login']); // User's login
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // User's logout
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('games', [VideoGamesController::class, 'index']); // View all video games
    Route::get('games/{id}', [VideoGamesController::class, 'show']); // View a single video game
    Route::post('games', [VideoGamesController::class, 'store']); // Create a new video game
    Route::put('games/{id}', [VideoGamesController::class, 'update']); // Edit an existing video game
    Route::get('dashboardview', [VideoGamesController::class, 'indexDashView']); // User's game dashboard (return view)
    Route::get('dashboardjson', [VideoGamesController::class, 'indexDashJson']); // User's game dashboard (return json)
    Route::middleware(['admin'])->group(function () {
        Route::delete('/games/{id}', [VideoGamesController::class, 'destroy']); // Delete a video game
    });
    Route::post('games/review/{id}', [RatingController::class, 'store']); // Create a new rating and review
});
