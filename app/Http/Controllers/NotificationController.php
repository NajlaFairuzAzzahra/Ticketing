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

        $notifications = Auth::user()->unreadNotifications;

        return view('notifications.index', compact('notifications'));
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
}
