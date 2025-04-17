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
use App\Http\Controllers\NotificationController;




Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->role_id == 1) {
        return redirect()->route('admin.dashboard'); // Admin
    } elseif (Auth::user()->role_id == 2) {
        return redirect()->route('staff.dashboard'); // IT Staff
    } else {
        return redirect()->route('user.dashboard'); // User
    }
})->name('home');


// Rute Autentikasi Laravel Breeze
require __DIR__.'/auth.php';

// ✅ Rute Admin
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // ✅ Rute Manajemen Pengguna
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // ✅ Rute Manajemen Tiket
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [AdminTicketController::class, 'create'])->name('tickets.create'); // Tambahkan jika perlu
    Route::post('/tickets', [AdminTicketController::class, 'store'])->name('tickets.store'); // Tambahkan jika perlu
    Route::get('/tickets/{ticket}/edit', [AdminTicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [AdminTicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [AdminTicketController::class, 'destroy'])->name('tickets.destroy');
    Route::get('/tickets/trashed', [AdminTicketController::class, 'trashed'])->name('tickets.trashed');
    Route::put('/tickets/{id}/restore', [AdminTicketController::class, 'restore'])->name('tickets.restore');
    Route::delete('/tickets/{id}/force-delete', [AdminTicketController::class, 'forceDelete'])->name('tickets.forceDelete');


    // ✅ Rute Lainnya
    Route::get('/departments', [AdminDepartmentController::class, 'index'])->name('departments');
    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients');
    Route::get('/notifications', function () { return view('admin.notifications'); })->name('notifications');

        // ✅ **Tambahkan Route Canned Responses**
        Route::get('/canned-responses', function () {
            return view('admin.canned-responses');
        })->name('canned-responses');

        Route::get('/profile', function () {
            return view('admin.profile'); // Pastikan ada file 'admin/profile.blade.php'
        })->name('profile');


});


// ✅ Rute User
Route::middleware(['auth', 'role:User'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // ✅ Tambahkan route profile
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', function () {
        return view('user.tickets.create');
    })->name('tickets.create');
    Route::get('/tickets/software', [TicketController::class, 'createSoftware'])->name('tickets.software');
    Route::get('/tickets/hardware', [TicketController::class, 'createHardware'])->name('tickets.hardware');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/comment', [TicketController::class, 'addComment'])->name('tickets.comment');

});


// ✅ Rute IT Staff
Route::middleware(['auth', 'role:Staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('dashboard');

    // ✅ CRUD Tiket untuk IT Staff
    Route::get('/tickets', [\App\Http\Controllers\Staff\TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [\App\Http\Controllers\Staff\TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', [\App\Http\Controllers\Staff\TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [\App\Http\Controllers\Staff\TicketController::class, 'update'])->name('tickets.update'); // ✅ Rute Update Tiket

    // ✅ Rute Tambahan untuk Staff
    Route::delete('/tickets/{ticket}', [\App\Http\Controllers\Staff\TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::put('/tickets/{ticket}/assign', [\App\Http\Controllers\Staff\TicketController::class, 'assign'])->name('tickets.assign');
    Route::post('/tickets/{ticket}/comment', [\App\Http\Controllers\Staff\TicketController::class, 'comment'])->name('tickets.comment');
    Route::put('/tickets/{ticket}/resolve', [\App\Http\Controllers\Staff\TicketController::class, 'resolve'])->name('tickets.resolve');
    
});

// ✅ Notifikasi berdasarkan role
    Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}/destroy', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::post('/notifications/{id}/unread', [NotificationController::class, 'markAsUnread'])->name('notifications.unread');
    Route::delete('/notifications/destroyAll', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');

});
