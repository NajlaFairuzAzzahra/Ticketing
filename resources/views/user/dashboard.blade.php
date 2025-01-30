@extends('layouts.user')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dashboard User</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Tiket Open -->
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Tiket Open</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['open_tickets'] }}</p>
        </div>
        <!-- Tiket In Progress -->
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Tiket In Progress</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['in_progress_tickets'] }}</p>
        </div>
        <!-- Tiket Closed -->
        <div class="bg-gray-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Tiket Closed</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['closed_tickets'] }}</p>
        </div>
    </div>
</div>
@endsection
