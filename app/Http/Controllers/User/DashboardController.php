<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah tiket milik user yang sedang login berdasarkan status
        $stats = [
            'open_tickets' => Ticket::where('user_id', Auth::id())->where('status', 'Open')->count(),
            'in_progress_tickets' => Ticket::where('user_id', Auth::id())->where('status', 'In Progress')->count(),
            'closed_tickets' => Ticket::where('user_id', Auth::id())->where('status', 'Closed')->count(),
        ];

        return view('user.dashboard', compact('stats'));
    }
}
