<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Usuario\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/registro', function () {
    return view('Registro');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->resource('Usuario',UsuarioController::class)
->names('Usuario');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');;
    Route::get('/carnet/{usuario}', [DashboardController::class, 'showCarnet'])->name('dashboard.carnet');
});
