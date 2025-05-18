<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\OrganisateurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
require __DIR__.'/auth.php';

// Routes protégées
Route::middleware('auth')->group(function () {
    // Route dashboard (redirection)
    Route::get('/dashboard', function () {
        return match(auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'organisateur' => redirect()->route('organisateur.dashboard'),
            default => redirect()->route('user.dashboard')
        };
    })->name('dashboard');

    // Routes profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    // Routes organisateur
    Route::middleware('role:organisateur')->group(function () {
        Route::get('/organisateur', [OrganisateurController::class, 'dashboard'])->name('organisateur.dashboard');
    });

    // Routes utilisateur
    Route::middleware('role:utilisateur')->group(function () {
        Route::get('/utilisateur', [UserController::class, 'dashboard'])->name('user.dashboard');
    });

       // Routes pour les événements
    Route::get('/evenements', [EvenementController::class, 'index'])->name('evenements.index');
    Route::get('/evenements/{evenement}', [EvenementController::class, 'show'])->name('evenements.show');

    // Routes pour les catégories
    Route::resource('categories', CategorieController::class);
});
