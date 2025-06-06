<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Notification;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tickets = $query->latest()->paginate(6)->withQueryString();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function edit(Ticket $ticket)
    {
        $staffs = User::where('role_id', 2)->get(); // Ambil user dengan role IT Staff
        return view('admin.tickets.edit', compact('ticket', 'staffs'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        $ticket->update([
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

        // ✅ Kirim Notifikasi jika tiket di-assign ke staff
        if ($request->assigned_to) {
            $staff = User::find($request->assigned_to);

            if ($staff) {
                Notification::send(
                    $staff,
                    new TicketNotification(
                        $ticket,
                        "Tiket #{$ticket->id} telah ditugaskan kepada Anda oleh Admin.",
                        "Tiket Telah Ditugaskan"
                    )
                );
            }
        }

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete(); // Soft delete
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }

        public function trashed()
    {
        $tickets = Ticket::onlyTrashed()->with('user')->paginate(10);
        return view('admin.tickets.trashed', compact('tickets'));
    }

    public function restore($id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);
        $ticket->restore();

        return redirect()->route('admin.tickets.trashed')->with('success', 'Tiket berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);
        $ticket->forceDelete();

        return redirect()->route('admin.tickets.trashed')->with('success', 'Tiket berhasil dihapus permanen.');
    }

}
