<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmplacementController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\InteretController;
use App\Http\Controllers\PaiementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::apiResource('evenements', EvenementController::class);
Route::apiResource('categories', CategorieController::class);
Route::apiResource('emplacements', EmplacementController::class);

// Routes personnalisées pour voir les paiements et les intérêts liés à un événement
Route::get('evenements/{evenement}/paiements', [PaiementController::class, 'index']);
Route::get('evenements/{evenement}/interets', [InteretController::class, 'index']);
Route::get('evenements/{id}/clients', [EvenementController::class, 'clients']);
Route::post('paiements', [PaiementController::class, 'store']);


Route::post('interets', [InteretController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
