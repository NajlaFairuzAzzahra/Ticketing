@extends('layouts.staff')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Detail Tiket #{{ $ticket->id }}</h1>

    <!-- 🔹 Informasi Tiket -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Tiket</h2>
        <p><strong>User:</strong> {{ optional($ticket->user)->name ?? 'Unknown User' }}</p>
        <p><strong>Status:</strong> <span class="px-2 py-1 rounded bg-gray-200">{{ $ticket->status }}</span></p>
        <p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>
        <p><strong>Dibuat pada:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>

        @if($ticket->assigned_to)
            <p><strong>Assigned To:</strong> {{ optional($ticket->assignedStaff)->name ?? 'Unknown Staff' }}</p>
        @else
            <p><strong>Assigned To:</strong> <span class="text-red-500">Belum ditugaskan</span></p>
        @endif

        @if ($ticket->attachment)
        <p><strong>Lampiran:</strong>
            <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank" class="text-blue-600 underline">
                Download Attachment
            </a>
        </p>
    @else
        <p><strong>Lampiran:</strong> Tidak ada</p>
    @endif

    @if ($ticket->link)
        <p><strong>Link Referensi:</strong>
            <a href="{{ $ticket->link }}" target="_blank" class="text-blue-600 underline">
                {{ $ticket->link }}
            </a>
        </p>
    @endif

    </div>



    <!-- 🔥 Tombol Ambil Alih Jika Belum Ditugaskan -->
    @if(is_null($ticket->assigned_to))
        <form method="POST" action="{{ route('staff.tickets.claim', $ticket->id) }}" class="mb-6">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                Ambil Alih
            </button>
        </form>
    @endif

    <!-- 🔥 Form Komentar & Update Status dalam Satu Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h2 class="text-lg font-semibold mb-4">Update Tiket dan Tambahkan Komentar</h2>

        <form method="POST" action="{{ route('staff.tickets.update', $ticket->id) }}">
            @csrf
            @method('PUT')

            <!-- Status Update -->
            <label class="block mb-4">
                <span class="text-gray-700">Status</span>
                <select name="status" class="w-full p-2 border rounded-lg">
                    <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </label>



            <!-- Komentar -->
            <label class="block mb-4">
                <span class="text-gray-700">Komentar</span>
                <textarea name="comment" class="w-full p-2 border rounded-lg" placeholder="Tambahkan komentar..."></textarea>
            </label>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update dan Kirim Komentar
            </button>
        </form>
    </div>

    <!-- 🔥 List Komentar -->
    <h2 class="text-xl font-bold mt-6">Komentar</h2>

    @if($ticket->comments->isEmpty())
        <p class="text-gray-500">Belum ada komentar.</p>
    @else
        @foreach($ticket->comments as $comment)
        <div class="p-4 border rounded-lg bg-gray-100 mt-2">
            <p class="font-semibold">{{ optional($comment->user)->name ?? 'User Tidak Diketahui' }}:</p>
            <p>{{ $comment->content }}</p>
            <p class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</p>
        </div>
        @endforeach
    @endif

    <!-- 🔙 Tombol Kembali -->
    <a href="{{ route('staff.tickets.index') }}" class="block w-full text-center bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-800">
        Kembali ke Daftar Tiket
    </a>
</div>
@endsection
