@extends('layouts.staff')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Detail Tiket #{{ $ticket->id }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p><strong>User:</strong> {{ optional($ticket->user)->name ?? 'Unknown User' }}</p>
        <p><strong>Status:</strong> {{ $ticket->status }}</p>
        <p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>
        <p><strong>Dibuat pada:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>

        @if($ticket->assigned_to)
            <p><strong>Assigned To:</strong> {{ optional($ticket->assignedStaff)->name ?? 'Unknown Staff' }}</p>
        @else
            <p><strong>Assigned To:</strong> <span class="text-red-500">Belum ditugaskan</span></p>
        @endif
    </div>

    <!-- 🔥 Tampilkan tombol "Ambil Alih" jika tiket belum ditugaskan -->
    @if(!$ticket->assigned_to)
    <div class="mt-6">
        <form method="POST" action="{{ route('staff.tickets.assign', $ticket->id) }}">
            @csrf @method('PUT')
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Ambil Alih Tiket
            </button>
        </form>
    </div>
    @endif

    <!-- 🔥 Update Status Tiket -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-bold mb-4">Update Status Tiket</h2>
        <form method="POST" action="{{ route('staff.tickets.update', $ticket->id) }}">
            @csrf @method('PUT')

            <label class="block mb-4">
                <span class="text-gray-700">Status</span>
                <select name="status" class="w-full p-2 border rounded-lg">
                    <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </label>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Status
            </button>
        </form>
    </div>

    <a href="{{ route('staff.tickets.index') }}" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-800">
        Kembali ke Daftar Tiket
    </a>
</div>
@endsection
