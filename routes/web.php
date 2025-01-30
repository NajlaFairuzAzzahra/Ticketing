<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('/login'); // Jika belum login
    }

    return Auth::user()->role_id == 1
        ? redirect()->route('admin.dashboard') // Jika admin
        : redirect()->route('user.dashboard'); // Jika user/staff
})->name('home');


// Rute Autentikasi Laravel Breeze
require __DIR__.'/auth.php';

// ✅ Rute Admin
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // ✅ Rute Manajemen Pengguna
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store'); // <-- PENTING
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // ✅ Pastikan tidak ada duplikat di bawah sini
    Route::get('/departments', [AdminDepartmentController::class, 'index'])->name('departments');
    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients');
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets');
    Route::get('/notifications', function () { return view('admin.notifications'); })->name('notifications');
});


// ✅ Rute User
Route::middleware(['auth', 'role:User'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', function () {
        return view('user.tickets.create');
    })->name('tickets.create');
    Route::get('/tickets/software', [TicketController::class, 'createSoftware'])->name('tickets.software');
    Route::get('/tickets/hardware', [TicketController::class, 'createHardware'])->name('tickets.hardware');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');
});
