@extends('layouts.user')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Detail Tiket #{{ $ticket->id }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p><strong>User:</strong> {{ optional($ticket->user)->name ?? 'User Tidak Diketahui' }}</p>
        <p><strong>Status:</strong> <span class="px-2 py-1 rounded bg-gray-200">{{ $ticket->status }}</span></p>
        <p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>
        <p><strong>Dibuat pada:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>

        @if($ticket->assigned_to)
            <p><strong>Assigned To:</strong> {{ optional($ticket->assignedStaff)->name ?? 'Staff Tidak Diketahui' }}</p>
        @else
            <p><strong>Assigned To:</strong> <span class="text-red-500">Belum ditugaskan</span></p>
        @endif
    </div>

    <!-- 🔹 List Komentar -->
    <h2 class="text-xl font-bold mt-6">Komentar</h2>

    @if($ticket->comments && $ticket->comments->isNotEmpty())
        @foreach($ticket->comments as $comment)
        <div class="p-4 border rounded-lg bg-gray-100 mt-2">
            <p class="font-semibold">{{ optional($comment->user)->name ?? 'User Tidak Diketahui' }}:</p>
            <p>{{ $comment->content }}</p>
            <p class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</p>
        </div>
        @endforeach
    @else
        <p class="text-gray-500">Belum ada komentar.</p>
    @endif

    <!-- 🔙 Tombol Kembali -->
    <a href="{{ route('user.tickets.index') }}" class="block w-full text-center bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-800">
        Kembali ke Daftar Tiket
    </a>
</div>
@endsection
