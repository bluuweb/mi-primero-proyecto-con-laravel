<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChirpController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('chirps', ChirpController::class)
//     ->only(['index', 'store', 'edit', 'update'])
//     ->middleware(['auth', 'verified']);

Route::get('/chirps', [ChirpController::class, 'index'])
    ->name('chirps.index')
    ->middleware(['auth', 'verified']);

Route::post('/chirps', [ChirpController::class, 'store'])
    ->name('chirps.store')
    ->middleware(['auth', 'verified']);

Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])
    ->name('chirps.edit')
    ->middleware(['auth', 'verified']);

Route::patch('/chirps/{chirp}', [ChirpController::class, 'update']) 
    ->name('chirps.update')
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
