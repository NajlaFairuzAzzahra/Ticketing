<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Department;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_it_staff' => User::where('role_id', 2)->count(),
            'total_clients' => User::where('role_id', 3)->count(),
            'total_tickets' => Ticket::count(),
            'assigned_tickets' => Ticket::whereNotNull('assigned_to')->count(),
            'unassigned_tickets' => Ticket::whereNull('assigned_to')->count(),
            'resolved_tickets' => Ticket::where('status', 'Resolved')->count(),
            'closed_tickets' => Ticket::where('status', 'Closed')->count(),
        ];

        // ✅ Hitung jumlah tiket berdasarkan status untuk grafik
        $ticketStatusCounts = Ticket::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // ✅ Hitung jumlah tiket per bulan untuk grafik
        $ticketsPerMonth = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // ✅ Pastikan query ini dijalankan untuk mendapatkan jumlah klien
        $totalClients = User::whereHas('tickets')->count();

         // ✅ Ambil 5 tiket terbaru
         $latestTickets = Ticket::latest()->take(5)->get();

        // ✅ Kirim semua data ke view
        return view('admin.dashboard', compact('stats', 'totalClients', 'ticketStatusCounts', 'ticketsPerMonth', 'latestTickets'));
    }
}
