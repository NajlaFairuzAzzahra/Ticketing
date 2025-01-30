@extends('layouts.staff')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Tiket #{{ $ticket->id }}</h1>

    <form method="POST" action="{{ route('staff.tickets.update', $ticket->id) }}" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf @method('PUT')

        <!-- User -->
        <label class="block mb-4">
            <span class="text-gray-700">User</span>
            <input type="text" value="{{ optional($ticket->user)->name ?? 'Unknown User' }}" readonly class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100">
        </label>

        <!-- Status -->
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
            Update Tiket
        </button>
    </form>
</div>
@endsection
