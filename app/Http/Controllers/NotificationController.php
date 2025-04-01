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
        $notifications = $user->notifications; // ambil SEMUA notifikasi

        $layout = ($user->role_id == 1) ? 'admin' : (($user->role_id == 2) ? 'staff' : 'user');

        return view('notifications.index', compact('notifications', 'layout'));
    }

    public function markAsRead($id)
    {
        $notification = DatabaseNotification::findOrFail($id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    public function destroy($id)
    {
    $notification = DatabaseNotification::findOrFail($id);
    $notification->delete(); // Hard delete from database

    return back()->with('success', 'Notifikasi berhasil dihapus permanen.');
    }
}
