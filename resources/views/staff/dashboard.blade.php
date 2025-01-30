@extends('layouts.staff')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard IT Staff</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Tiket -->
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Tiket</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['total_tickets'] ?? 0 }}</p>
        </div>

        <!-- Tiket Open -->
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Tiket Open</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['open_tickets'] ?? 0 }}</p>
        </div>

        <!-- Tiket In Progress -->
        <div class="bg-orange-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Tiket In Progress</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['in_progress_tickets'] ?? 0 }}</p>
        </div>

        <!-- Tiket Resolved -->
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Tiket Resolved</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['resolved_tickets'] ?? 0 }}</p>
        </div>

        <!-- Tiket Closed -->
        <div class="bg-gray-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Tiket Closed</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['closed_tickets'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Button untuk melihat semua tiket -->
    <div class="mt-6">
        <a href="{{ route('staff.tickets.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Lihat Semua Tiket
            </a>
    </div>
</div>
@endsection
