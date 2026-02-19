<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('inventory', InventoryController::class);
        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::delete('/reservations/{reserva}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
        Route::patch('/reservations/{reserva}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
        Route::patch('/reservations/{reserva}/assign-dj', [ReservationController::class, 'assignDj'])->name('reservations.assignDj');
        Route::patch('/reservations/{reserva}/finalize', [ReservationController::class, 'finalize'])->name('reservations.finalize');
        Route::get('/stats', [StatsController::class, 'index'])->name('stats');
    });

    // DJ
    Route::middleware('role:dj')->prefix('dj')->name('dj.')->group(function () {
        Route::get('/events', [ReservationController::class, 'myEvents'])->name('events');
    });

    // Client
    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::resource('reservations', ReservationController::class)->only(['create', 'store', 'index', 'show']);
    });
});

require __DIR__.'/auth.php';
