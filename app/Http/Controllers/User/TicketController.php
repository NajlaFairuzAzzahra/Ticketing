<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Notification;



class TicketController extends Controller
{
    // ✅ Menampilkan semua tiket milik user
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('user.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('user.tickets.create');
    }

    // ✅ Menyimpan tiket baru
    public function store(Request $request)
    {
        Log::info('📥 Data Tiket Diterima:', $request->all());

    $admin = User::where('role_id', 1)->first();
    $staffUsers = User::where('role_id', 2)->get();


        // ✅ Cek apakah tiket yang dikirim adalah hardware atau software
        if ($request->ticket_type === 'hardware') {
            $validated = $request->validate([
                'infrastructure' => 'required|string',
                'hardware' => 'required|string',
                'wo_type' => 'required|string',
                'description' => 'required|string',
                'request_date' => 'required|date',
                'organization' => 'required|string',
                'requester' => 'required|string',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
                'link' => 'nullable|url'
            ]);

            // ✅ Handle file upload
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                Log::info('📂 File terdeteksi:', ['filename' => $request->file('attachment')->getClientOriginalName()]);
                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
                Log::info('📂 File berhasil disimpan:', ['path' => $attachmentPath]);
            }

            $ticket = Ticket::create([
                'user_id' => Auth::id(),
                'system' => $validated['infrastructure'],
                'sub_system' => $validated['hardware'],
                'wo_type' => $validated['wo_type'],
                'scope' => null,
                'description' => $validated['description'],
                'request_date' => $validated['request_date'],
                'organization' => $validated['organization'],
                'requester' => $validated['requester'],
                'status' => 'Open',
                'attachment' => $attachmentPath,
                'link' => $validated['link'] ?? null
            ]);

            // ✅ Kirim Notifikasi ke Admin & IT Staff
            $admin = User::where('role_id', 1)->first();
            $staffUsers = User::where('role_id', 2)->get();

            if ($admin) {
                Notification::send($admin, new TicketNotification($ticket, "Tiket baru telah dibuat oleh {$ticket->requester}"));
            }

            if ($staffUsers->count()) {
                Notification::send($staffUsers, new TicketNotification($ticket, "Tiket baru telah dibuat oleh {$ticket->requester}"));
            }

            return redirect()->route('user.tickets.index')->with('success', 'Tiket Hardware berhasil dibuat.');
        }

        // ✅ Jika bukan hardware, anggap software
        $validated = $request->validate([
            'system' => 'required|string',
            'sub_system' => 'required|string',
            'wo_type' => 'required|string',
            'scope' => 'nullable|string',
            'description' => 'required|string',
            'request_date' => 'required|date',
            'organization' => 'required|string',
            'requester' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
            'link' => 'nullable|url'
        ]);

        // ✅ Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'system' => $validated['system'],
            'sub_system' => $validated['sub_system'],
            'wo_type' => $validated['wo_type'],
            'scope' => $validated['scope'],
            'description' => $validated['description'],
            'request_date' => $validated['request_date'],
            'organization' => $validated['organization'],
            'requester' => $validated['requester'],
            'status' => 'Open',
            'attachment' => $attachmentPath,
            'link' => $validated['link'] ?? null
        ]);

        // ✅ Kirim Notifikasi ke Admin & IT Staff
        if ($admin) {
            Notification::send($admin, new TicketNotification($ticket, "Tiket baru telah dibuat oleh {$ticket->requester}"));
        }

        if ($staffUsers->count()) {
            Notification::send($staffUsers, new TicketNotification($ticket, "Tiket baru menunggu untuk diambil alih."));
        }

        return redirect()->route('user.tickets.index')->with('success', 'Tiket Software berhasil dibuat.');
    }
        // ✅ Menampilkan detail tiket
    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'assignedStaff', 'comments.user']);
        return view('user.tickets.show', compact('ticket'));
    }

    // ✅ Menambahkan komentar pada tiket
    public function addComment(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->route('user.tickets.index')->with('error', 'Anda tidak memiliki akses ke tiket ini.');
        }

        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->comment,
        ]);

        return redirect()->route('user.tickets.show', $ticket->id)->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function createSoftware()
    {
        return view('user.tickets.create_software');
    }

    public function createHardware()
    {
        return view('user.tickets.create_hardware');
    }
}
