@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Manajemen Tiket</h1>
    <form method="GET" action="{{ route('admin.tickets.index') }}" class="mb-6 flex flex-wrap items-center gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
            class="border rounded px-4 py-2 w-64" placeholder="Cari ID atau Deskripsi">

        <select name="status" class="border rounded px-3 py-2">
            <option value="">Semua Status</option>
            <option value="Open" {{ request('status') === 'Open' ? 'selected' : '' }}>Open</option>
            <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Resolved" {{ request('status') === 'Resolved' ? 'selected' : '' }}>Resolved</option>
            <option value="Closed" {{ request('status') === 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Filter
        </button>
    </form>

    <a href="{{ route('admin.tickets.trashed') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 mb-4 inline-block">
        Arsip Tiket
    </a>


    <div class="mt-6 bg-white shadow-md rounded-lg">
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
                @foreach($tickets as $ticket)
                <tr class="border-b">
                    <td class="p-3 border">{{ $ticket->id }}</td>
                    <td class="p-3 border">{{ optional($ticket->user)->name ?? 'Unknown User' }}</td>
                    <td class="p-3 border">{{ $ticket->description }}</td>
                    <td class="p-3 border">
                        <span class="px-2 py-1 rounded text-white
                        {{ $ticket->status == 'Open' ? 'bg-green-500' : ($ticket->status == 'In Progress' ? 'bg-yellow-500' : ($ticket->status == 'Resolved' ? 'bg-blue-500' : 'bg-gray-500')) }}">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    <td class="p-3 border flex space-x-2">
                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                            Edit
                        </a>

                        <!-- 🔥 Tombol untuk membuka modal hapus -->
                        <button onclick="openModal({{ $ticket->id }})" class="bg-red-600 text-white px-4 py-2 rounded">
                            Hapus
                        </button>

                        <!-- 🔥 Modal Konfirmasi -->
                        <div id="confirmModal-{{ $ticket->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 text-center">
                                <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
                                <p>Apakah Anda yakin ingin menghapus tiket ini?</p>
                                <div class="mt-6 flex justify-center space-x-4">
                                    <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Ya, Hapus</button>
                                    </form>
                                    <button onclick="closeModal({{ $ticket->id }})" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Batal</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">
    {{ $tickets->links() }}
</div>

<!-- 🔥 Script untuk Modal -->
<script>
    function openModal(ticketId) {
        document.getElementById('confirmModal-' + ticketId).classList.remove('hidden');
    }

    function closeModal(ticketId) {
        document.getElementById('confirmModal-' + ticketId).classList.add('hidden');
    }
</script>
@endsection
