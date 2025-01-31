<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Notification;



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
        $ticket->load('comments.user'); // 🔥 Pastikan komentar dan pengguna ikut dimuat

        return view('staff.tickets.show', [
            'ticket' => $ticket,
            'staffs' => User::where('role_id', 2)->get(), // Ambil semua staff
        ]);
    }


    public function update(Request $request, Ticket $ticket)
    {
        if (!$ticket) {
            return redirect()->route('staff.tickets.index')->with('error', 'Tiket tidak ditemukan.');
        }

        $request->validate([
            'status' => 'required|in:Open,In Progress,Resolved,Closed',
            'comment' => 'nullable|string|max:1000'
        ]);

        // 🔹 Update status tiket
        $ticket->update([
            'status' => $request->status
        ]);

        // 🔹 Pastikan komentar tersimpan
        if (!empty($request->comment)) {
            Comment::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'content' => $request->comment
            ]);
        }

        // ✅ Kirim Notifikasi ke User bahwa tiket mereka diperbarui
        Notification::send($ticket->user, new TicketNotification($ticket, "Tiket Anda telah diperbarui ke status '{$ticket->status}'"));

        return redirect()->route('staff.tickets.show', $ticket->id)
            ->with('success', 'Status tiket diperbarui dan komentar ditambahkan.');
    }


    public function assign(Ticket $ticket)
    {
        if ($ticket->assigned_to) {
            return redirect()->route('staff.tickets.show', $ticket->id)->with('error', 'Tiket sudah ditugaskan.');
        }

        $ticket->update([
            'assigned_to' => Auth::id(),
            'status' => 'In Progress'
        ]);

        // ✅ Kirim Notifikasi ke IT Staff yang mengambil tiket
        Notification::send(Auth::user(), new TicketNotification($ticket, "Anda telah ditugaskan ke tiket #{$ticket->id}"));

        return redirect()->route('staff.tickets.show', $ticket->id)->with('success', 'Tiket berhasil diambil alih.');
    }

    public function claim($id)
    {
    $ticket = Ticket::findOrFail($id);
    $ticket->assigned_to = Auth::id();
    $ticket->status = 'In Progress';
    $ticket->save();

    return redirect()->route('staff.tickets.index')->with('success', 'Tiket berhasil diambil alih!');
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $ticket = Ticket::findOrFail($id);

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'content' => $request->comment,
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function resolve($id)
    {
    $ticket = Ticket::findOrFail($id);
    $ticket->status = 'Resolved';
    $ticket->save();

    return redirect()->route('staff.tickets.index')->with('success', 'Tiket berhasil diselesaikan!');
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
        $tickets = Ticket::whereNull('deleted_at')->get();
        return view('admin.tickets.index', compact('tickets'));

    }
}
