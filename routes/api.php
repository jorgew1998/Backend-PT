<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AchievementDetailController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentDetailController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});


//Rutas de autenticacion
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);


Route::group(['middleware' => ['jwt.verify']], function() {

    //Rutas para usuarios
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('allUsers', [UserController::class, 'allUsers']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    //Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'delete']);

    //Rutas para los temas
    Route::get('/themes', [ThemeController::class, 'index']);
    Route::get('/themes/{theme}', [ThemeController::class, 'show']);
    Route::post('/themes', [ThemeController::class, 'store']);
    Route::put('/themes/{theme}', [ThemeController::class, 'update']);
    Route::delete('/themes/{theme}', [ThemeController::class, 'delete']);
    Route::post('/firstThemes', [ThemeController::class, 'initialThemes']);
    Route::get('/themesId',[ThemeController::class, 'themesId'] );


    //Rutas para contenidos
    Route::get('/contents', [ContentController::class, 'index']);
    Route::get('/contents/{content}', [ContentController::class, 'show']);
    Route::post('/contents', [ContentController::class, 'store']);
    Route::put('/contents/{content}', [ContentController::class, 'update']);
    Route::delete('/contents/{content}', [ContentController::class, 'delete']);
    //Route::post('/firstContents', [ContentController::class, 'initialContents']);

    //Obtener los contenidos de un tema
    Route::get('/themes/{theme}/contents', [ContentController::class, 'contents']);

    //Rutas para logros
    Route::get('/achievements', [AchievementController::class, 'index']);
    Route::get('/achievements/{achievement}', [AchievementController::class, 'show']);
    Route::post('/achievements', [AchievementController::class, 'store']);
    Route::put('/achievements/{achievement}', [AchievementController::class, 'update']);
    //Route::delete('/achievements/{achievement}', [AchievementController::class, 'delete']);
    //Route::post('/firstAchievements', [AchievementController::class, 'initialAchievements']);

    //rutas para detalle de logros
    Route::get('/achievementsDetails', [AchievementDetailController::class, 'index']);
    Route::get('/achievementsDetails/{achievement}', [AchievementDetailController::class, 'show']);
    Route::post('/achievementsDetails', [AchievementDetailController::class, 'store']);
    Route::put('/achievementsDetails/{achievement}', [AchievementDetailController::class, 'update']);
    Route::delete('/achievementsDetails/{achievement}', [AchievementController::class, 'delete']);

    //rutas para detalle de contenidos
    Route::get('/contentsDetails', [ContentDetailController::class, 'index']);
    Route::get('/contentsDetails/{content}', [ContentDetailController::class, 'show']);
    Route::post('/contentsDetails', [ContentDetailController::class, 'store']);
    Route::put('/contentsDetails/{content}', [ContentDetailController::class, 'update']);
    Route::delete('/achievements/{content}', [ContentDetailController::class, 'delete']);
});








