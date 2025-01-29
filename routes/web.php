<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminClientController;


// Redirect ke halaman login
Route::get('/', function () {
    return redirect('/login');
})->name('home');

// Rute Autentikasi Laravel Breeze
require __DIR__.'/auth.php';

// ✅ Rute Admin
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users'); // 🔥 Tambahkan ini
    Route::get('/departments', [AdminDepartmentController::class, 'index'])->name('departments');
    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients');
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets');
    Route::get('/notifications', function () { return view('admin.notifications'); })->name('notifications');
    // Route::get('/canned-responses', function () { return view('admin.canned-responses'); })->name('canned-responses');
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
