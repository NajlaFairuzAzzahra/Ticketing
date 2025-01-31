@extends('layouts.' . $layout)

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Notifikasi</h1>

    @if($notifications->isEmpty())
        <p class="text-gray-500">Tidak ada notifikasi baru.</p>
    @else
        <ul class="bg-white p-6 rounded-lg shadow-lg">
            @foreach($notifications as $notification)
                <li class="border-b p-4 flex justify-between">
                    <span>{{ $notification->data['message'] ?? 'Notifikasi tanpa pesan' }}</span>
                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:underline">Tandai Dibaca</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('notifications.readAll') }}" class="mt-4">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Tandai Semua Dibaca
            </button>
        </form>
    @endif
</div>
@endsection
