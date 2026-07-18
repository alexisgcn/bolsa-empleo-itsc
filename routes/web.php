<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return match (auth()->user()->rol) {
        'admin' => redirect()->route('admin.dashboard'),
        'empresa' => redirect()->route('empresa.dashboard'),
        default => redirect()->route('estudiante.dashboard'),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'rol:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
});

Route::middleware(['auth', 'rol:empresa'])->prefix('empresa')->name('empresa.')->group(function () {
    Route::get('/dashboard', fn () => view('empresa.dashboard'))->name('dashboard');
});

Route::middleware(['auth', 'rol:estudiante'])->prefix('estudiante')->name('estudiante.')->group(function () {
    Route::get('/dashboard', fn () => view('estudiante.dashboard'))->name('dashboard');
});

require __DIR__.'/auth.php';
