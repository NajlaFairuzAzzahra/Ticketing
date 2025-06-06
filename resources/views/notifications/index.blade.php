@extends('layouts.' . $layout)

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Notifikasi</h1>

    @if($notifications->isEmpty())
        <p class="text-gray-500">Tidak ada notifikasi.</p>
    @else
    <ul class="bg-white p-6 rounded-lg shadow-lg">
        @foreach($notifications as $notification)
            @php
                $isUnread = is_null($notification->read_at);
            @endphp
            <li class="border-b p-4 flex justify-between items-center {{ $isUnread ? 'bg-white font-semibold' : 'bg-gray-100 text-gray-500' }}">
                <div>
                    <div class="text-base">
                        {{ $notification->data['title'] ?? 'Notifikasi' }}
                    </div>
                    <div class="text-sm">
                        {{ $notification->data['message'] ?? '-' }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                        {{ $notification->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="flex gap-3">
                    @if($isUnread)
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:underline text-sm">Tandai Dibaca</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('notifications.unread', $notification->id) }}">
                            @csrf
                            <button type="submit" class="text-yellow-600 hover:underline text-sm">Tandai Belum Dibaca</button>
                        </form>
                    @endif

                    <button onclick="openModal('{{ $notification->id }}')" class="text-red-600 hover:underline text-sm">
                        Hapus
                    </button>
                </div>
            </li>

            <!-- 🔥 Modal Konfirmasi Hapus -->
            <div id="modal-{{ $notification->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
                    <h2 class="text-lg font-bold mb-4">Hapus Notifikasi</h2>
                    <p>Apakah Anda yakin ingin menghapus notifikasi ini secara permanen?</p>
                    <div class="mt-6 flex justify-center gap-4">
                        <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                Ya, Hapus
                            </button>
                        </form>
                        <button onclick="closeModal('{{ $notification->id }}')" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>

    <div class="mt-4 flex justify-between items-center">
        <!-- Tombol Tandai Semua -->
        <form method="POST" action="{{ route('notifications.readAll') }}">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Tandai Semua Dibaca
            </button>
        </form>

        <!-- Tombol Hapus Semua (buka modal) -->
        <button onclick="openModal('all')" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            Hapus Semua
        </button>
    </div>

    <!-- 🔄 Pagination -->
    <div class="mt-4">
        {{ $notifications->links() }}
    </div>

    <!-- 🔥 Modal Konfirmasi Hapus Semua -->
    <div id="modal-all" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <h2 class="text-lg font-bold mb-4">Hapus Semua Notifikasi</h2>
            <p>Apakah Anda yakin ingin menghapus <strong>seluruh</strong> notifikasi secara permanen?</p>
            <div class="mt-6 flex justify-center gap-4">
                <form method="POST" action="{{ route('notifications.destroyAll') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Ya, Hapus Semua
                    </button>
                </form>
                <button onclick="closeModal('all')" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                    Batal
                </button>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
        document.getElementById('modal-' + id).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
        document.getElementById('modal-' + id).classList.remove('flex');
    }
</script>
@endsection
