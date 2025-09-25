<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\Usuario\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/registro', function () {
    return view('Registro');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->resource('usuarios', \App\Http\Controllers\UsuariosController::class)->names('Usuario');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');;
    Route::get('/carnet/{usuario}', [DashboardController::class, 'showCarnet'])->name('dashboard.carnet');
    Route::get('/jornadas/data', [JornadaController::class, 'getData'])->name('jornadas.data');

    Route::resource('fichas', \App\Http\Controllers\FichaController::class)->names('fichas');
    Route::resource('sedes', \App\Http\Controllers\SedeController::class)->names('sedes');
    Route::resource('carnets', \App\Http\Controllers\CarnetController::class)->names('carnets');
    Route::resource('registros_acceso', \App\Http\Controllers\RegistroAccesoController::class)->names('registros_acceso');
    Route::resource('jornadas', JornadaController::class);
});