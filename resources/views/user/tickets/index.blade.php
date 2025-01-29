@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Daftar Tiket</h1>

    <a href="{{ route('user.tickets.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
        + Buat Tiket Baru
    </a>

    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Kategori</th>
                    <th class="p-3 border">Deskripsi</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr class="border-b">
                    <td class="p-3 border">{{ $ticket->id }}</td>
                    <td class="p-3 border">{{ $ticket->sub_system }}</td>
                    <td class="p-3 border">{{ $ticket->description }}</td>
                    <td class="p-3 border">
                        <span class="px-2 py-1 rounded text-white
                        {{ $ticket->status == 'open' ? 'bg-green-500' : ($ticket->status == 'in_progress' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                    <td class="p-3 border">
                        <a href="{{ route('user.tickets.show', $ticket->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
