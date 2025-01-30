@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Manajemen Tiket</h1>

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
                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                        <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
