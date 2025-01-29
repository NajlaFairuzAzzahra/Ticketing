<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\TicketController;

// Redirect ke halaman login
Route::get('/', function () {
    return redirect('/login');
})->name('home');

// Rute Autentikasi Laravel Breeze
require __DIR__.'/auth.php';

// Rute dengan Middleware Auth
Route::middleware('auth')->group(function () {
    // Rute Admin
    Route::middleware('role:Admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });

    // Rute User
    Route::middleware('role:User')->prefix('user')->name('user.')->group(function () {
        // Dashboard User
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Tiket
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
        Route::get('/tickets/software', [TicketController::class, 'createSoftware'])->name('tickets.software');

        // Profil User
        Route::get('/profile', function () {
            return view('user.profile');
        })->name('profile');
    });
});
