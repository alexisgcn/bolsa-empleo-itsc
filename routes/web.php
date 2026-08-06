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

    Route::get('empresas', [\App\Http\Controllers\Admin\EmpresaController::class, 'index'])->name('empresas.index');
    Route::patch('empresas/{empresa}/aprobar', [\App\Http\Controllers\Admin\EmpresaController::class, 'aprobar'])->name('empresas.aprobar');
    Route::patch('empresas/{empresa}/bloquear', [\App\Http\Controllers\Admin\EmpresaController::class, 'bloquear'])->name('empresas.bloquear');
    Route::patch('empresas/{empresa}/rechazar', [\App\Http\Controllers\Admin\EmpresaController::class, 'rechazar'])->name('empresas.rechazar');

    Route::get('carreras', [\App\Http\Controllers\Admin\CarreraController::class, 'index'])->name('carreras.index');
    Route::post('carreras', [\App\Http\Controllers\Admin\CarreraController::class, 'store'])->name('carreras.store');
    Route::patch('carreras/{carrera}', [\App\Http\Controllers\Admin\CarreraController::class, 'update'])->name('carreras.update');
    Route::delete('carreras/{carrera}', [\App\Http\Controllers\Admin\CarreraController::class, 'destroy'])->name('carreras.destroy');
});

Route::middleware(['auth', 'rol:empresa'])->prefix('empresa')->name('empresa.')->group(function () {
    Route::get('/dashboard', fn () => view('empresa.dashboard'))->name('dashboard');

    Route::resource('vacantes', \App\Http\Controllers\Empresa\VacanteController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::patch('vacantes/{vacante}/publicar', [\App\Http\Controllers\Empresa\VacanteController::class, 'publicar'])
    ->name('vacantes.publicar');

    Route::patch('vacantes/{vacante}/cerrar', [\App\Http\Controllers\Empresa\VacanteController::class, 'cerrar'])
    ->name('vacantes.cerrar');

    Route::get('vacantes/{vacante}/postulaciones', [\App\Http\Controllers\Empresa\PostulacionController::class, 'index'])
    ->name('vacantes.postulaciones.index');

    Route::patch('postulaciones/{postulacion}/en-revision', [\App\Http\Controllers\Empresa\PostulacionController::class, 'enRevision'])
        ->name('postulaciones.en_revision');
    Route::patch('postulaciones/{postulacion}/aceptar', [\App\Http\Controllers\Empresa\PostulacionController::class, 'aceptar'])
        ->name('postulaciones.aceptar');
    Route::patch('postulaciones/{postulacion}/rechazar', [\App\Http\Controllers\Empresa\PostulacionController::class, 'rechazar'])
        ->name('postulaciones.rechazar');
});

Route::middleware(['auth', 'rol:estudiante'])->prefix('estudiante')->name('estudiante.')->group(function () {
    Route::get('/dashboard', fn () => view('estudiante.dashboard'))->name('dashboard');
    Route::get('vacantes', [\App\Http\Controllers\Estudiante\VacanteController::class, 'index'])->name('vacantes.index');
    Route::get('vacantes/{vacante}', [\App\Http\Controllers\Estudiante\VacanteController::class, 'show'])->name('vacantes.show');
    Route::post('vacantes/{vacante}/postular', [\App\Http\Controllers\Estudiante\PostulacionController::class, 'store'])->name('vacantes.postular');
    Route::get('postulaciones', [\App\Http\Controllers\Estudiante\PostulacionController::class, 'index'])->name('postulaciones.index');

    Route::get('perfil', [\App\Http\Controllers\Estudiante\PerfilController::class, 'edit'])->name('perfil.edit');
    Route::post('perfil', [\App\Http\Controllers\Estudiante\PerfilController::class, 'update'])->name('perfil.update');
});

require __DIR__.'/auth.php';
