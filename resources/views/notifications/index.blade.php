@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">🔔 Notifikasi</h1>

    <div class="mb-4">
        <form method="POST" action="{{ route('notifications.readAll') }}">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tandai Semua sebagai Terbaca
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        @if ($notifications->isEmpty())
            <p class="text-gray-500">Belum ada notifikasi.</p>
        @else
            @foreach ($notifications as $notification)
                <div class="p-4 border-b">
                    <p>{{ $notification->data['message'] }}</p>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>

                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:underline">Tandai sebagai Terbaca</button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
