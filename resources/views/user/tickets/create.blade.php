@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center">Pilih Jenis Tiket</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Tombol untuk Software Ticket -->
        <a href="{{ route('user.tickets.software') }}" class="block bg-blue-600 text-white text-center py-6 rounded-lg hover:bg-blue-700 shadow-lg">
            <h2 class="text-xl font-semibold">Buat Tiket Software</h2>
            <p class="text-sm">Gunakan ini untuk masalah aplikasi atau sistem</p>
        </a>

        <!-- Tombol untuk Hardware Ticket -->
        <a href="{{ route('user.tickets.hardware') }}" class="block bg-green-600 text-white text-center py-6 rounded-lg hover:bg-green-700 shadow-lg">
            <h2 class="text-xl font-semibold">Buat Tiket Hardware</h2>
            <p class="text-sm">Gunakan ini untuk masalah perangkat keras dan jaringan</p>
        </a>
    </div>
</div>
@endsection
