<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets;
        $stats = [
            'open_tickets' => $tickets->where('status', 'open')->count(),
            'in_progress_tickets' => $tickets->where('status', 'in_progress')->count(),
            'closed_tickets' => $tickets->where('status', 'closed')->count(),
        ];

        return view('user.dashboard', compact('stats'));
    }
}
