<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        // 🔥 Gunakan role_id untuk menentukan layout yang benar
        $layout = ($user->role_id == 1) ? 'admin' : (($user->role_id == 2) ? 'staff' : 'user');

        return view('notifications.index', compact('notifications', 'layout'));
    }

    public function markAsRead($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $notification = DatabaseNotification::find($id);
        if ($notification && $notification->notifiable_id == Auth::id()) {
            $notification->markAsRead();
        }

        return back();
    }

    public function markAllAsRead()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Auth::user()->unreadNotifications->markAsRead();

        return back();
    }

    public function destroy($id)
    {
    $notification = DatabaseNotification::findOrFail($id);
    $notification->delete(); // Hard delete from database

    return back()->with('success', 'Notifikasi berhasil dihapus permanen.');
    }
}
