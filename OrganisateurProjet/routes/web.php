<?php



use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmplacementController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\OrganisateurController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

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

    // Routes Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        // Autres routes admin...
    });

    // Routes Organisateur
    Route::middleware('role:organisateur')->prefix('organisateur')->name('organisateur.')->group(function () {
        Route::get('/', [OrganisateurController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // Routes pour les ressources
        Route::resource('evenements', EvenementController::class)->names([
            'index' => 'evenements.index',
            'create' => 'evenements.create',
            'store' => 'evenements.store',
            'show' => 'evenements.show',
            'edit' => 'evenements.edit',
            'update' => 'evenements.update',
            'destroy' => 'evenements.destroy'
        ]);

        Route::resource('categories', CategorieController::class)->except(['show']);
        Route::resource('emplacements', EmplacementController::class)->except(['show']);
        Route::resource('paiements', PaiementController::class)->only(['index', 'destroy']);
// routes/web.php

     Route::prefix('organisateur')->name('organisateur.')->group(function() {
     Route::resource('emplacements', EmplacementController::class);
});
Route::prefix('organisateur')->name('organisateur.')->group(function() {
    Route::resource('emplacements', EmplacementController::class);
});
Route::get('/paiements', [PaiementController::class, 'index'])
     ->name('paiements.index');
        // Routes imbriquées
        Route::prefix('evenements/{evenement}')->group(function () {
            Route::get('clients', [EvenementController::class, 'clients'])
                 ->name('evenements.clients');
            Route::get('paiements', [PaiementController::class, 'index'])
                 ->name('evenements.paiements');
        });
    });

    // Routes Utilisateur
    Route::middleware('role:utilisateur')->prefix('utilisateur')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');

        // Routes événements (au singulier)
        Route::get('evenement', [EvenementController::class, 'userIndex'])->name('evenement.index');
        Route::get('evenement/{evenement}', [EvenementController::class, 'userShow'])->name('evenement.show');

        // Routes profil utilisateur
        Route::prefix('profil')->group(function () {
            Route::get('/', [UserController::class, 'edit'])->name('profile.edit');
            Route::put('/', [UserController::class, 'update'])->name('profile.update');
        });
    });
});

