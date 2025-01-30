@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['total_tickets'] }}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Assigned Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['assigned_tickets'] }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Unassigned Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['unassigned_tickets'] }}</p>
        </div>
        <div class="bg-gray-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Resolved Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['resolved_tickets'] }}</p>
        </div>
        <div class="bg-red-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Closed Tickets</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['closed_tickets'] }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Grafik Status Tiket -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-3">Grafik Status Tiket</h2>
        <canvas id="ticketStatusChart"></canvas>
    </div>

    <!-- Grafik Tiket Per Bulan -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-3">Grafik Tiket Per Bulan</h2>
        <canvas id="ticketsPerMonthChart"></canvas>
    </div>
</div>

<!-- Grafik Klien -->
<div class="bg-white p-6 rounded-lg shadow mt-6">
    <h2 class="text-lg font-semibold mb-3">Jumlah User yang Mengajukan Tiket</h2>
    <p class="text-4xl font-bold text-center">{{ $totalClients }}</p>
</div>

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total IT Staff</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['total_it_staff'] }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Total Clients</h2>
            <p class="text-4xl font-bold mt-2">{{ $stats['total_clients'] }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow mt-6">
        <h2 class="text-lg font-semibold mb-3">Tiket Terbaru</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">User</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Tanggal</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestTickets as $ticket)
                <tr class="border-b">
                    <td class="p-3 border">{{ $ticket->id }}</td>
                    <td class="p-3 border">{{ $ticket->user->name }}</td>
                    <td class="p-3 border">{{ $ticket->status }}</td>
                    <td class="p-3 border">{{ $ticket->created_at->format('d M Y') }}</td>
                    <td class="p-3 border">
                        <a href="{{ route('admin.tickets') }}" class="text-blue-600 hover:underline">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Data Status Tiket
    const ticketStatusData = {
        labels: @json(array_keys($ticketStatusCounts)),
        datasets: [{
            label: 'Jumlah Tiket',
            data: @json(array_values($ticketStatusCounts)),
            backgroundColor: ['#4F46E5', '#22C55E', '#FACC15', '#F43F5E', '#6B7280']
        }]
    };

    // Data Tiket Per Bulan
    const ticketsPerMonthData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Tiket Per Bulan',
            data: @json(array_values($ticketsPerMonth)),
            backgroundColor: '#3B82F6'
        }]
    };

    // Konfigurasi Chart.js
    new Chart(document.getElementById('ticketStatusChart'), { type: 'doughnut', data: ticketStatusData });
    new Chart(document.getElementById('ticketsPerMonthChart'), { type: 'bar', data: ticketsPerMonthData });
</script>

@endsection
