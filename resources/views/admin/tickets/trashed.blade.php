@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Arsip Tiket (Terhapus)</h1>

    <a href="{{ route('admin.tickets.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">
        ← Kembali ke daftar tiket
    </a>

    <div class="bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">User</th>
                    <th class="p-3 border">Deskripsi</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr class="border-b bg-gray-100 text-gray-600 italic">
                        <td class="p-3 border">{{ $ticket->id }}</td>
                        <td class="p-3 border">{{ optional($ticket->user)->name ?? 'Unknown User' }}</td>
                        <td class="p-3 border">{{ $ticket->description }}</td>
                        <td class="p-3 border">{{ $ticket->status }}</td>
                        <td class="p-3 border flex space-x-2">
                            <form method="POST" action="{{ route('admin.tickets.restore', $ticket->id) }}">
                                @csrf @method('PUT')
                                <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Pulihkan</button>
                            </form>

                            <form method="POST" action="{{ route('admin.tickets.forceDelete', $ticket->id) }}">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus Permanen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">Tidak ada tiket yang terhapus.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
