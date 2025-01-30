@extends('layouts.staff')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard IT Staff</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Assigned Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['total_assigned'] }}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Open Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['open_tickets'] }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">In Progress</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['in_progress_tickets'] }}</p>
        </div>
        <div class="bg-gray-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Closed Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['closed_tickets'] }}</p>
        </div>
    </div>

    <h2 class="text-xl font-bold mt-8 mb-4">Assigned Tickets</h2>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">User</th>
                    <th class="p-3 border">Deskripsi</th>
                    <th class="p-3 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignedTickets as $ticket)
                <tr class="border-b">
                    <td class="p-3 border">{{ $ticket->id }}</td>
                    <td class="p-3 border">{{ optional($ticket->user)->name ?? 'Unknown' }}</td>
                    <td class="p-3 border">{{ $ticket->description }}</td>
                    <td class="p-3 border">
                        <span class="px-2 py-1 rounded text-white
                        {{ $ticket->status == 'Open' ? 'bg-green-500' : ($ticket->status == 'In Progress' ? 'bg-yellow-500' : ($ticket->status == 'Resolved' ? 'bg-blue-500' : 'bg-gray-500')) }}">
                            {{ $ticket->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
