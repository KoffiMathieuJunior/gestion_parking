<?php

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\API\CapteurController;
use App\Http\Controllers\API\GatewayController;
use App\Http\Controllers\API\Parametres\NiveauxController;
use App\Http\Controllers\API\Parametres\PaysController;
use App\Http\Controllers\API\Parametres\StatutController;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\Parametres\TypeUserController;
use App\Http\Controllers\API\Parametres\TypeVehiculeController;
use App\Http\Controllers\API\Parametres\VillesController;
use App\Http\Controllers\API\ParkingController;
use App\Http\Controllers\API\PlaceStationnementController;

// use App\Models\Type_user;

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
Route::fallback(function(){
    return response()->json(['message' => 'Service introuvable'], 404);
});
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Route::group('users', function(){
        // dd('check');
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/users', [UserController::class, 'getUsers']);
        Route::post('/users', [UserController::class, 'createUser']);
        Route::put('/users/{id}', [UserController::class, 'updateUser']);
        Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
    // });

    // Route::get('/users', [UserController::class, 'getUsers']);
    // Abonnement
    Route::prefix('abonnement')->group(function(){
        Route::post('/get', [AbonnementController::class, 'getAbonnement']);
        Route::post('/create', [AbonnementController::class, 'createAbonnement']);
        Route::post('/update', [AbonnementController::class, 'update']);
    });
    // Type user
    Route::prefix('type-user')->group(function(){
        Route::post('/get', [TypeUserController::class, 'index']);
        Route::post('/create', [TypeUserController::class, 'store']);
        Route::post('/update', [TypeUserController::class, 'update']);
        Route::post('/delete', [TypeUserController::class, 'destroy']);
    });
    // Type vehicule
    Route::prefix('type-vehicule')->group(function(){
        Route::post('/get', [TypeVehiculeController::class, 'index']);
        Route::post('/create', [TypeVehiculeController::class, 'store']);
        Route::post('/update', [TypeVehiculeController::class, 'update']);
        Route::post('/delete', [TypeVehiculeController::class, 'destroy']);
    });
    // Statut
    Route::prefix('statut')->group(function(){
        Route::post('/get', [StatutController::class, 'index']);
        Route::post('/create', [StatutController::class, 'store']);
        Route::post('/update', [StatutController::class, 'update']);
        Route::post('/delete', [StatutController::class, 'destroy']);
    });
    // Niveaux
    Route::prefix('niveaux')->group(function(){
        Route::post('/get', [NiveauxController::class, 'index']);
        Route::post('/create', [NiveauxController::class, 'store']);
        Route::post('/update', [NiveauxController::class, 'update']);
        Route::post('/delete', [NiveauxController::class, 'destroy']);
    });
    // Pays
    Route::prefix('pays')->group(function(){
        Route::post('/get', [PaysController::class, 'index']);
        Route::post('/create', [PaysController::class, 'store']);
        Route::post('/update', [PaysController::class, 'update']);
        Route::post('/delete', [PaysController::class, 'destroy']);
    });
    // Villes
    Route::prefix('villes')->group(function(){
        Route::post('/get', [VillesController::class, 'index']);
        Route::post('/create', [VillesController::class, 'store']);
        Route::post('/update', [VillesController::class, 'update']);
        Route::post('/delete', [VillesController::class, 'destroy']);
    });
    // Parking
    Route::prefix('parkings')->group(function(){
        Route::post('/get', [ParkingController::class, 'index']);
        Route::post('/create', [ParkingController::class, 'store']);
        Route::post('/update', [ParkingController::class, 'update']);
        Route::post('/delete', [ParkingController::class, 'destroy']);
    });
    // Parking
    Route::prefix('place_stationnement')->group(function(){
        Route::post('/get', [PlaceStationnementController::class, 'index']);
        Route::post('/create', [PlaceStationnementController::class, 'store']);
        Route::post('/update', [PlaceStationnementController::class, 'update']);
        Route::post('/delete', [PlaceStationnementController::class, 'destroy']);
    });
    // Gateway
    Route::prefix('gateway')->group(function(){
        Route::post('/get', [GatewayController::class, 'index']);
        Route::post('/create', [GatewayController::class, 'store']);
        Route::post('/update', [GatewayController::class, 'update']);
        Route::post('/delete', [GatewayController::class, 'destroy']);
    });
    // Capteur
    Route::prefix('capteur')->group(function(){
        Route::post('/get', [CapteurController::class, 'index']);
        Route::post('/create', [CapteurController::class, 'store']);
        Route::post('/update', [CapteurController::class, 'update']);
        Route::post('/delete', [CapteurController::class, 'destroy']);
    });


});

