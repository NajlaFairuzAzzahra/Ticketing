<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tickets' => Ticket::count(),
            'open_tickets' => Ticket::where('status', 'Open')->count(),
            'in_progress_tickets' => Ticket::where('status', 'In Progress')->count(),
            'resolved_tickets' => Ticket::where('status', 'Resolved')->count(),
            'closed_tickets' => Ticket::where('status', 'Closed')->count(),
        ];

        return view('staff.dashboard', compact('stats'));
    }
}
