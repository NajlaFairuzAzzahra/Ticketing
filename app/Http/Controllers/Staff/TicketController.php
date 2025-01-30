<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TicketController extends Controller
{
    // ✅ Menampilkan daftar tiket IT Staff
    public function index()
    {
        $tickets = Ticket::whereNotNull('assigned_to')->get();
        return view('staff.tickets.index', compact('tickets'));
    }

        // Edit tiket (ambil alih atau ubah status)
        public function edit(Ticket $ticket)
        {
            if (!$ticket->assigned_to) {
                // Jika tiket belum ditugaskan, biarkan IT Staff mengambil alih
                $ticket->update(['assigned_to' => Auth::id()]);
            }

            return view('staff.tickets.edit', compact('ticket'));
        }


    // ✅ Menampilkan detail tiket
    public function show(Ticket $ticket)
    {
        return view('staff.tickets.show', [
            'ticket' => $ticket,
            'staffs' => User::where('role_id', 2)->get(), // Ambil semua staff
        ]);
    }


    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()->route('staff.tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function assign(Ticket $ticket)
    {
        if ($ticket->assigned_to) {
            return redirect()->route('staff.tickets.show', $ticket->id)->with('error', 'Tiket sudah ditugaskan.');
        }

        $ticket->update([
            'assigned_to' => Auth::id(),
            'status' => 'In Progress' // Secara otomatis ubah status menjadi "In Progress"
        ]);

        return redirect()->route('staff.tickets.show', $ticket->id)->with('success', 'Tiket berhasil diambil alih.');
    }



    // ✅ Mengupdate status tiket
    // public function updateStatus(Request $request, Ticket $ticket)
    // {
    //     $request->validate(['status' => 'required|in:Open,In Progress,Resolved,Closed']);
    //     $ticket->update(['status' => $request->status]);

    //     return redirect()->route('staff.tickets.index')->with('success', 'Status tiket berhasil diperbarui.');
    // }

    // ✅ IT Staff mengambil alih tiket
    // public function assignToSelf(Ticket $ticket)
    // {
    //     $ticket->update(['assigned_to' => Auth::id()]);

    //     return redirect()->route('staff.tickets.index')->with('success', 'Tiket berhasil diambil alih.');
    // }

    // ✅ Menambahkan komentar pada tiket
    public function addComment(Request $request, Ticket $ticket)
    {
        $request->validate(['comment' => 'required|string']);
        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('staff.tickets.show', $ticket->id)->with('success', 'Komentar ditambahkan.');
    }

    // ✅ Menghapus tiket
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('staff.tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
