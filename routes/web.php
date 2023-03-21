<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatutController;
use App\Http\Controllers\Type_VehiculeController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\CapteurController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\FormuleController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\Mode_PaiementController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\Place_StationnementController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Role_ActionController;
use App\Http\Controllers\Type_ProprietaireController;
use App\Http\Controllers\Type_UserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/registers', function () {
    return view('registers');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::resource('vehicule', VehiculeController::class);
Route::resource('compagnie', CompagnieController::class);
Route::resource('type_vehicule', Type_VehiculeController::class);
Route::resource('Abonnement', AbonnementController::class);
Route::resource('client', ClientController::class);
Route::resource('gateway', GatewayController::class);
Route::resource('parking', ParkingController::class);
Route::resource('statut', StatutController::class);
Route::resource('place_stationnement', Place_StationnementController::class);
Route::resource('Mode_Paiement', Mode_PaiementController::class);
Route::resource('role', RoleController::class);
Route::resource('type_proprietaire', Type_ProprietaireController::class);

Route::controller(ClientController::class)->group(function () {

    Route::get('/client', 'index');
    Route::get('/client/create', 'create');
    Route::get('/client/{id}', 'show');
    Route::get('/client/{id}/edit', 'edit');


    Route::post('/client', 'store');
    Route::patch('/client/{id}', 'update');
    Route::delete('/client/{id}', 'destroy');
    Route::post('/client/create', 'create');

});

Route::controller(StatutController::class)->group(function () {

    Route::get('/statut', 'index');
    Route::get('/statut/create', 'create');
    Route::get('/statut/{id}', 'show');
    Route::get('/statut/{id}/edit', 'edit');


    Route::post('/statut', 'store');
    Route::patch('/statut/{id}', 'update');
    Route::delete('/statut/{id}', 'destroy');
    Route::post('/statut/create', 'create');
});

Route::controller(Type_VehiculeController::class)->group(function () {

    Route::get('/type_vehicule', 'index');
    Route::get('/type_vehicule/create', 'create');
    Route::get('/type_vehicule/{id}', 'show');
    Route::get('/type_vehicule/{id}/edit', 'edit');


    Route::post('/type_vehicule', 'store');
    Route::patch('/type_vehicule/{id}', 'update');
    Route::delete('/type_vehicule/{id}', 'destroy');
    Route::post('/type_vehicule/create', 'create');
});


Route::controller(AbonnementController::class)->group(function () {

    Route::get('/abonnement', 'index');
    Route::get('/abonnement/create', 'create');
    Route::get('/abonnement/{id}', 'show');
    Route::get('/abonnement/{id}/edit', 'edit');


    Route::post('/abonnement', 'store');
    Route::patch('/abonnement/{id}', 'update');
    Route::delete('/abonnement/{id}', 'destroy');
    Route::post('/abonnement/create', 'create');
});

Route::controller(ActionController::class)->group(function () {

    Route::get('/action', 'index');
    Route::get('/action/create', 'create');
    Route::get('/action/{id}', 'show');
    Route::get('/action/{id}/edit', 'edit');


    Route::post('/action', 'store');
    Route::patch('/action/{id}', 'update');
    Route::delete('/action/{id}', 'destroy');
    Route::post('/action/create', 'create');
});


Route::controller(CapteurController::class)->group(function () {

    Route::get('/capteur', 'index');
    Route::get('/capteur/create', 'create');
    Route::get('/capteur/{id}', 'show');
    Route::get('/capteur/{id}/edit', 'edit');


    Route::post('/capteur', 'store');
    Route::patch('/capteur/{id}', 'update');
    Route::delete('/capteur/{id}', 'destroy');
    Route::post('/capteur/create', 'create');
});


Route::controller(CompagnieController::class)->group(function () {

    Route::get('/compagnie', 'index');
    Route::get('/compagnie/create', 'create');
    Route::get('/compagnie/{id}', 'show');
    Route::get('/compagnie/{id}/edit', 'edit');


    Route::post('/compagnie', 'store');
    Route::patch('/compagnie/{id}', 'update');
    Route::delete('/compagnie/{id}', 'destroy');
    Route::post('/compagnie/create', 'create');
});

Route::controller(FormuleController::class)->group(function () {

    Route::get('/formule', 'index');
    Route::get('/formule/create', 'create');
    Route::get('/formule/{id}', 'show');
    Route::get('/formule/{id}/edit', 'edit');


    Route::post('/formule', 'store');
    Route::patch('/formule/{id}', 'update');
    Route::delete('/formule/{id}', 'destroy');
    Route::post('/formule/create', 'create');
});

Route::controller(GatewayController::class)->group(function () {

    Route::get('/gateway', 'index');
    Route::get('/gateway/create', 'create');
    Route::get('/gateway/{id}', 'show');
    Route::get('/gateway/{id}/edit', 'edit');


    Route::post('/gateway', 'store');
    Route::patch('/gateway/{id}', 'update');
    Route::delete('/gateway/{id}', 'destroy');
    Route::post('/gateway/create', 'create');
});

Route::controller(Mode_PaiementController::class)->group(function () {

    Route::get('/mode_paiement', 'index');
    Route::get('/mode_paiement/create', 'create');
    Route::get('/mode_paiement/{id}', 'show');
    Route::get('/mode_paiement/{id}/edit', 'edit');


    Route::post('/mode_paiement', 'store');
    Route::patch('/mode_paiement/{id}', 'update');
    Route::delete('/mode_paiement/{id}', 'destroy');
    Route::post('/mode_paiement/create', 'create');
});


Route::controller(NiveauController::class)->group(function () {

    Route::get('/niveau', 'index');
    Route::get('/niveau/create', 'create');
    Route::get('/niveau/{id}', 'show');
    Route::get('/niveau/{id}/edit', 'edit');


    Route::post('/niveau', 'store');
    Route::patch('/niveau/{id}', 'update');
    Route::delete('/niveau/{id}', 'destroy');
    Route::post('/niveau/create', 'create');
});


Route::controller(ParkingController::class)->group(function () {

    Route::get('/parking', 'index');
    Route::get('/parking/create', 'create');
    Route::get('/parking/{id}', 'show');
    Route::get('/parking/{id}/edit', 'edit');


    Route::post('/parking', 'store');
    Route::patch('/parking/{id}', 'update');
    Route::delete('/parking/{id}', 'destroy');
    Route::post('/parking/create', 'create');
});


Route::controller(Place_StationnementController::class)->group(function () {

    Route::get('/palce_stationnement', 'index');
    Route::get('/palce_stationnement/create', 'create');
    Route::get('/palce_stationnement/{id}', 'show');
    Route::get('/palce_stationnement/{id}/edit', 'edit');


    Route::post('/palce_stationnement', 'store');
    Route::patch('/palce_stationnement/{id}', 'update');
    Route::delete('/palce_stationnement/{id}', 'destroy');
    Route::post('/palce_stationnement/create', 'create');
});



Route::controller(ProprietaireController::class)->group(function () {

    Route::get('/proprietaire', 'index');
    Route::get('/proprietaire/create', 'create');
    Route::get('/proprietaire/{id}', 'show');
    Route::get('/proprietaire/{id}/edit', 'edit');


    Route::post('/proprietaire', 'store');
    Route::patch('/proprietaire/{id}', 'update');
    Route::delete('/proprietaire/{id}', 'destroy');
    Route::post('/proprietaire/create', 'create');
});



Route::controller(ReservationController::class)->group(function () {

    Route::get('/reservation', 'index');
    Route::get('/reservation/create', 'create');
    Route::get('/reservation/{id}', 'show');
    Route::get('/reservation/{id}/edit', 'edit');


    Route::post('/reservation', 'store');
    Route::patch('/reservation/{id}', 'update');
    Route::delete('/reservation/{id}', 'destroy');
    Route::post('/reservation/create', 'create');
});


Route::controller(Role_ActionController::class)->group(function () {

    Route::get('/role_action', 'index');
    Route::get('/role_action/create', 'create');
    Route::get('/role_action/{id}', 'show');
    Route::get('/role_action/{id}/edit', 'edit');


    Route::post('/role_action', 'store');
    Route::patch('/role_action/{id}', 'update');
    Route::delete('/role_action/{id}', 'destroy');
    Route::post('/role_action/create', 'create');
});


Route::controller(Type_ProprietaireController::class)->group(function () {

    Route::get('/type_proprietaire', 'index');
    Route::get('/type_proprietaire/create', 'create');
    Route::get('/type_proprietaire/{id}', 'show');
    Route::get('/type_proprietaire/{id}/edit', 'edit');


    Route::post('/type_proprietaire', 'store');
    Route::patch('/type_proprietaire/{id}', 'update');
    Route::delete('/type_proprietaire/{id}', 'destroy');
    Route::post('/type_proprietaire/create', 'create');
});


Route::controller(VehiculeController::class)->group(function () {

    Route::get('/vehicule', 'index');
    Route::get('/vehicule/create', 'create');
    Route::get('/vehicule/{id}', 'show');
    Route::get('/vehicule/{id}/edit', 'edit');


    Route::post('/vehicule', 'store');
    Route::patch('/vehicule/{id}', 'update');
    Route::delete('/vehicule/{id}', 'destroy');
    Route::post('/vehicule/create', 'create');
});

Route::controller(RoleController::class)->group(function () {

    Route::get('/role', 'index');
    Route::get('/role/create', 'create');
    Route::get('/role/{id}', 'show');
    Route::get('/role/{id}/edit', 'edit');


    Route::post('/role', 'store');
    Route::patch('/role/{id}', 'update');
    Route::delete('/role/{id}', 'destroy');
    Route::post('/role/create', 'create');
});


Route::controller(Type_ProprietaireController::class)->group(function () {

    Route::get('/type_proprietaire', 'index');
    Route::get('/type_proprietaire/create', 'create');
    Route::get('/type_proprietaire/{id}', 'show');
    Route::get('/type_proprietaire/{id}/edit', 'edit');


    Route::post('/type_proprietaire', 'store');
    Route::patch('/type_proprietaire/{id}', 'update');
    Route::delete('/type_proprietaire/{id}', 'destroy');
    Route::post('/type_proprietaire/create', 'create');
});

Route::controller(Type_UserController::class)->group(function () {

    Route::get('/type_user', 'index');
    Route::get('/type_user/create', 'create');
    Route::get('/type_user/{id}', 'show');
    Route::get('/type_user/{id}/edit', 'edit');


    Route::post('/type_user', 'store');
    Route::patch('/type_user/{id}', 'update');
    Route::delete('/type_user/{id}', 'destroy');
    Route::post('/type_user/create', 'create');
});

Route::controller(UserController::class)->group(function () {

    Route::get('/user', 'index');
    Route::get('/user/create', 'create');
    Route::get('/user/{id}', 'show');
    Route::get('/user/{id}/edit', 'edit');


    Route::post('/user', 'store');
    Route::patch('/user/{id}', 'update');
    Route::delete('/user/{id}', 'destroy');
    Route::post('/user/create', 'create');
});