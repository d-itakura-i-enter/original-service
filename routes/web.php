<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\FavoritesController;
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

Route::get('/', [BoardsController::class, 'index']);

Route::get('/dashboard', [BoardsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('boards', BoardsController::class, ['only' => ['store', 'destroy']]);
    
    Route::prefix('boards/{id}')->group(function() {
        Route::post('favorites', [FavoritesController::class, 'store'])->name('favorites.favorite');
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite');
    });
});

require __DIR__.'/auth.php';
