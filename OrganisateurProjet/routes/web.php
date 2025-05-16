<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmplacementController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\InteretController;
use App\Http\Controllers\PaiementController;
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
    return view('welcome');
});

Route::resource('evenements', EvenementController::class);
Route::resource('categories', CategorieController::class);
Route::resource('emplacements', EmplacementController::class);
 // Routes personnalisées (web)
Route::get('evenements/{evenement}/paiements', [PaiementController::class, 'index'])->name('evenements.paiements');
Route::get('evenements/{evenement}/interets', [InteretController::class, 'index'])->name('evenements.interets');
Route::get('evenements/{id}/clients', [EvenementController::class, 'clients'])->name('evenements.clients');

Route::post('paiements', [PaiementController::class, 'store'])->name('paiements.store');
Route::post('interets', [InteretController::class, 'store'])->name('interets.store');