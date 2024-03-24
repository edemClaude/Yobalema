<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChauffeurController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContratController;
use App\Http\Controllers\Admin\PayementController;
use App\Http\Controllers\Admin\PermisController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehiculeController;
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

Route::get('/', function () {
    return view('home.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/accueil', [App\Http\Controllers\HomeController::class, 'accueil'])->name('accueil');

Route::get('/dashboard', function (){
    return view('admin.dashboard');
})->name('admin.dashboard');

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
    Route::get('/geocoding', [\App\Http\Controllers\GeocodeController::class, 'geocode'])->name('geocoding');
    Route::get('/location', [\App\Http\Controllers\LocationController::class, 'location'])->name('location');
});

