@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tickets</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border">ID</th>
                <th class="p-3 border">User</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr class="border-b">
                <td class="p-3 border">{{ $ticket->id }}</td>
                <td class="p-3 border">{{ $ticket->user->name }}</td>
                <td class="p-3 border">{{ $ticket->status }}</td>
                <td class="p-3 border">{{ $ticket->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
