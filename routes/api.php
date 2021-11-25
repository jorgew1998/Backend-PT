<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Rutas para los temas
Route::get('/themes', [ThemeController::class, 'index']);
Route::get('/themes/{theme}', [ThemeController::class, 'show']);
Route::post('/themes', [ThemeController::class, 'store']);
Route::put('/themes/{theme}', [ThemeController::class, 'update']);
Route::delete('/themes/{theme}', [ThemeController::class, 'delete']);

//Rutas para logros
Route::get('/achievements', [AchievementController::class, 'index']);
Route::get('/achievements/{achievement}', [AchievementController::class, 'show']);
Route::post('/achievements', [AchievementController::class, 'store']);
Route::put('/achievements/{achievement}', [AchievementController::class, 'update']);
Route::delete('/achievements/{achievement}', [AchievementController::class, 'delete']);

//Rutas para contenidos
Route::get('/contents', [ContentController::class, 'index']);
Route::get('/contents/{content}', [ContentController::class, 'show']);
Route::post('/contents', [ContentController::class, 'store']);
Route::put('/contents/{contents}', [ContentController::class, 'update']);
Route::delete('/contents/{content}', [ContentController::class, 'delete']);


//Rutas para usuarios
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'delete']);
