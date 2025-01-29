<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Menampilkan semua tiket milik user
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('user.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('user.tickets.create');
    }

    // Menyimpan tiket baru
    public function store(Request $request)
    {
        // \Log::info('Data Tiket Diterima:', $request->all()); // Cek apakah data form terkirim dengan benar

        // ✅ Pastikan validasi sesuai dengan kolom di database
        $validated = $request->validate([
            'system' => 'required|string',
            'sub_system' => 'required|string',
            'wo_type' => 'required|string',
            'scope' => 'nullable|string',
            'description' => 'required|string',
            'request_date' => 'required|date',
            'organization' => 'required|string',
            'requester' => 'required|string',
        ]);

        // ✅ Simpan tiket ke database
        Ticket::create([
            'user_id' => Auth::id(),
            'system' => $validated['system'],
            'sub_system' => $validated['sub_system'],
            'wo_type' => $validated['wo_type'],
            'scope' => $validated['scope'],
            'description' => $validated['description'],
            'request_date' => $validated['request_date'],
            'organization' => $validated['organization'],
            'requester' => $validated['requester'],
            'status' => 'Open', // Default status
        ]);

        return redirect()->route('user.tickets.index')->with('success', 'Tiket berhasil dibuat.');
    }

    // Menampilkan detail tiket
    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->route('user.tickets.index')->with('error', 'Unauthorized access!');
        }

        return view('user.tickets.show', compact('ticket'));
    }

    public function createSoftware()
    {
    return view('user.tickets.create_software');
    }

}
