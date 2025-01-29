<?php

namespace App\Http\Controllers\ITStaff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('status', '!=', 'closed')->get();
        return view('itstaff.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('itstaff.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate(['status' => 'required|in:open,in_progress,closed']);
        $ticket->update(['status' => $request->status]);

        return redirect()->route('it.tickets.index')->with('success', 'Status tiket berhasil diupdate.');
    }
}
