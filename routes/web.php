<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChauffeurController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContratController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PayementController;
use App\Http\Controllers\Admin\PermisController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehiculeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'accueil']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/accueil', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/home/vehicules', [HomeController::class, 'vehicules'])->name('home.vehicules');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('vehicules', VehiculeController::class);
    Route::resource('chauffeurs', ChauffeurController::class);
    Route::resource('payements', PayementController::class)->except('show');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');


    /* Debut des routes pour le contrat d'un chauffeur */
    Route::get('/contrats/{chauffeur}', [ContratController::class, 'show'])->name('contrats.show');
    Route::post('/contrats/store', [ContratController::class, 'store'])->name('contrats.store');
    Route::get('/contrats/{chauffeur}/create', [ContratController::class, 'create'])->name('contrats.create');
    Route::put('/contrats/{contrat}/update', [ContratController::class, 'update'])->name('contrats.update');
    Route::delete('/contrats/{contrat}/destroy', [ContratController::class, 'destroy'])->name('contrats.destroy');
    Route::get('/contrats/{chauffeur}/edit', [ContratController::class, 'edit'])->name('contrats.edit');
    /* fin des routes pour le contrat d'un chauffeur */

    /* Debut des routes pour les permis de conduire */
    Route::get('/permis/{chauffeur}/create', [PermisController::class, 'create'])-> name('permis.create');
    Route::post('/permis/{chauffeur}/store', [PermisController::class, 'store'])-> name('permis.store');
    Route::put('/permis/{permis}/update', [PermisController::class, 'update'])-> name('permis.update');
    Route::delete('/permis/{permis}/destroy', [PermisController::class, 'destroy'])-> name('permis.destroy');
    Route::get('/permis/{chauffeur}/edit', [PermisController::class, 'edit'])-> name('permis.edit');
    /* fin des routes pour les permis de conduire */

    /* La route pour l'attribution de vehicule à un chauffeur */
    Route::get('/vehicules/{chauffeur}/assign', [VehiculeController::class, 'assign'])
        ->name('vehicules.assign');

    /* La route pour retirer un vehicule à un chauffeur */
    Route::get('/vehicules/{chauffeur}/unassign', [VehiculeController::class, 'unassign'])
        ->name('vehicules.unassign');

});

Route::middleware('auth')->group(function () {
    Route::post('/location', [LocationController::class, 'location'])->name('location');
    Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');

    Route::get('/locations/{client}/all', [LocationController::class, 'clientLocationsAll'])
        ->name('location.client.all');
    Route::get('/locations/{client}/last', [LocationController::class, 'clientLocationLast'])
        ->name('location.client.last');

    Route::get('/locations/chauffeur/{chauffeur}/all', [LocationController::class, 'chauffeurLocationsAll'])
        ->name('location.chauffeur.all');
    Route::get('/locations/chauffeur/{chauffeur}/last', [LocationController::class, 'chauffeurLocationLast'])
        ->name('location.chauffeur.last');

    Route::delete('/locations/{location}/destroy', [LocationController::class, 'destroy'])
        ->name('location.destroy');
});

