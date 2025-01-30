<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $staffId = Auth::id();

        $stats = [
            'total_assigned' => Ticket::where('assigned_to', $staffId)->count(),
            'open_tickets' => Ticket::where('assigned_to', $staffId)->where('status', 'Open')->count(),
            'in_progress_tickets' => Ticket::where('assigned_to', $staffId)->where('status', 'In Progress')->count(),
            'resolved_tickets' => Ticket::where('assigned_to', $staffId)->where('status', 'Resolved')->count(),
            'closed_tickets' => Ticket::where('assigned_to', $staffId)->where('status', 'Closed')->count(),
        ];

        $assignedTickets = Ticket::where('assigned_to', $staffId)->latest()->get();

        return view('staff.dashboard', compact('stats', 'assignedTickets'));
    }
}
