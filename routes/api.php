<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

Route::get('/planes', [PlanController::class, 'index']);
Route::get('/disponibilidad/{fecha}', [ReservaController::class, 'disponibilidad']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(ReservaController::class)->group(function () {
        Route::get('/reservas', 'listar');
        Route::post('/reservas', 'reservar');
        Route::put('/reservas/{id}/cancelar', 'cancelar');
    });
});