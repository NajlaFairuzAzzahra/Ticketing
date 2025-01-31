@extends('layouts.user')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Detail Tiket #{{ $ticket->id }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Tiket</h2>
        <p><strong>User:</strong> {{ optional($ticket->user)->name ?? 'Unknown User' }}</p>
        <p><strong>Status:</strong> <span class="px-2 py-1 rounded bg-gray-200">{{ $ticket->status }}</span></p>
        <p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>
        <p><strong>Dibuat pada:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>
    </div>


    <h2 class="text-xl font-bold mt-6">Komentar</h2>

    @if($ticket->comments->isEmpty())
        <p class="text-gray-500">Belum ada komentar.</p>
    @else
        @foreach($ticket->comments as $comment)
            <div class="p-4 border rounded-lg bg-gray-100 mt-2">
                <p class="font-semibold">{{ optional($comment->user)->name ?? 'Pengguna Tidak Diketahui' }}:</p>
                <p>{{ $comment->content }}</p>
                <p class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</p>
            </div>
        @endforeach
    @endif

    <!-- Form untuk menambahkan komentar -->
    <form method="POST" action="{{ route('user.tickets.comment', $ticket->id) }}" class="mt-4">
        @csrf
        <textarea name="comment" class="w-full p-2 border rounded-lg" placeholder="Tambahkan komentar..."></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">
            Kirim Komentar
        </button>
    </form>

    <!-- 🔙 Tombol Kembali -->
    <a href="{{ route('user.tickets.index') }}" class="block w-full text-center bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-800 mt-4">
        Kembali ke Daftar Tiket
    </a>
</div>

<!-- 🔥 Script untuk mengisi parent_id saat membalas komentar -->
<script>
    function replyToComment(commentId) {
        document.getElementById('parent_id').value = commentId;
        document.querySelector('textarea[name="comment"]').focus();
    }
</script>
@endsection
