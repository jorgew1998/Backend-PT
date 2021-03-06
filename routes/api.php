<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AchievementDetailController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentDetailController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemeDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

//Rutas de autenticacion
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);

//Rutas publicas de temas
Route::get('/themes', [ThemeController::class, 'index']);
Route::get('/themes/{theme}', [ThemeController::class, 'show']);

//Rutas publicas de contenidos
Route::get('/contents', [ContentController::class, 'index']);
Route::get('/contents/{content}', [ContentController::class, 'show']);

//Rutas publicas de logros
Route::get('/achievements', [AchievementController::class, 'index']);
Route::get('/achievements/{achievement}', [AchievementController::class, 'show']);
Route::get('/achievements/{achievement}/image',[AchievementController::class, 'image']);

//Rutas para recuperacion de contraseña
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? response()->json(['status' => __($status)], 200)
        : response()->json(['status' => __($status)], 400);
})->middleware('guest')->name('password.email');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
        ? response()->json(['status' => __($status)], 200)
        : response()->json(['status' => __($status)], 400);
});



Route::group(['middleware' => ['jwt.verify']], function() {

    //Rutas para usuarios
    Route::get('/user', [UserController::class, 'getAuthenticatedUser']);
    Route::get('/allUsers', [UserController::class, 'allUsers']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'delete']);

    //Rutas para los temas
    Route::post('/themes', [ThemeController::class, 'store']);
    Route::put('/themes/{theme}', [ThemeController::class, 'update']);
    Route::delete('/themes/{theme}', [ThemeController::class, 'delete']);

    //Rutas para contenidos
    Route::post('/contents', [ContentController::class, 'store']);
    Route::put('/contents/{content}', [ContentController::class, 'update']);
    Route::delete('/contents/{content}', [ContentController::class, 'delete']);
    Route::get('/themes/{theme}/contents', [ContentController::class, 'contents']);

    //Rutas para logros
    Route::post('/achievements', [AchievementController::class, 'store']);
    Route::put('/achievements/{achievement}', [AchievementController::class, 'update']);
    Route::delete('/achievements/{achievement}', [AchievementController::class, 'delete']);

    //Rutas para detalle de logros
    Route::get('/achievementsDetails', [AchievementDetailController::class, 'index']);
    Route::get('/achievementsDetails/{achievement}', [AchievementDetailController::class, 'show']);
    Route::post('/achievementsDetails', [AchievementDetailController::class, 'store']);
    Route::put('/achievementsDetails/{achievement}', [AchievementDetailController::class, 'update']);
    Route::delete('/achievementsDetails/{achievement}', [AchievementController::class, 'delete']);

    //Rutas para detalle de contenidos
    Route::get('/contentsDetails', [ContentDetailController::class, 'index']);
    Route::get('/contentsDetails/{content}', [ContentDetailController::class, 'show']);
    Route::post('/contentsDetails', [ContentDetailController::class, 'store']);
    Route::put('/contentsDetails/{content}', [ContentDetailController::class, 'update']);
    Route::delete('/achievements/{content}', [ContentDetailController::class, 'delete']);

    //Rutas para detalle de contenidos
    Route::get('/themesDetails', [ThemeDetailController::class, 'index']);
    Route::get('/themesDetails/{theme}', [ThemeDetailController::class, 'show']);
    Route::post('/themesDetails', [ThemeDetailController::class, 'store']);
    Route::put('/themesDetails/{theme}', [ThemeDetailController::class, 'update']);
    Route::delete('/themes/{theme}', [ThemeDetailController::class, 'delete']);
});








