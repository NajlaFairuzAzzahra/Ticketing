@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Tiket #{{ $ticket->id }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p><strong>Kategori:</strong> {{ $ticket->category->name }}</p>
        <p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>
        <p><strong>Status:</strong>
            <span class="px-2 py-1 rounded text-white
            {{ $ticket->status == 'open' ? 'bg-green-500' : ($ticket->status == 'in_progress' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                {{ ucfirst($ticket->status) }}
            </span>
        </p>
    </div>

    <a href="{{ route('user.tickets.index') }}" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-800">
        Kembali ke Daftar Tiket
    </a>
</div>
@endsection
