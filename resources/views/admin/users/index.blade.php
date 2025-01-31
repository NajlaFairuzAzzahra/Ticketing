@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Manajemen Pengguna</h1>

    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
        + Tambah Pengguna
    </a>

    <div class="mt-6 bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Role</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b">
                    <td class="p-3 border">{{ $user->name }}</td>
                    <td class="p-3 border">{{ $user->email }}</td>
                    <td class="p-3 border">{{ $user->role_id == 2 ? 'IT Staff' : 'User' }}</td>
                    <td class="p-3 border flex space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">
                            Edit
                        </a>

                        <!-- 🔥 Tombol untuk membuka modal hapus -->
                        <button onclick="openDeleteModal({{ $user->id }})" class="bg-red-600 text-white px-4 py-2 rounded">
                            Hapus
                        </button>

                        <!-- 🔥 Modal Konfirmasi -->
                        <div id="deleteModal-{{ $user->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 text-center">
                                <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
                                <p>Apakah Anda yakin ingin menghapus akun ini?</p>
                                <div class="mt-6 flex justify-center space-x-4">
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Ya, Hapus</button>
                                    </form>
                                    <button onclick="closeDeleteModal({{ $user->id }})" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Batal</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- 🔥 Script untuk Modal -->
<script>
    function openDeleteModal(userId) {
        document.getElementById('deleteModal-' + userId).classList.remove('hidden');
    }

    function closeDeleteModal(userId) {
        document.getElementById('deleteModal-' + userId).classList.add('hidden');
    }
</script>
@endsection
