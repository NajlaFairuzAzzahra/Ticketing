@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Pengguna</h1>

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4 bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <label class="block">
            Nama
            <input type="text" name="name" class="w-full p-2 border rounded-lg">
        </label>

        <label class="block">
            Email
            <input type="email" name="email" class="w-full p-2 border rounded-lg">
        </label>

        <label class="block">
            Password
            <input type="password" name="password" class="w-full p-2 border rounded-lg">
        </label>

        <label class="block">
            Role
            <select name="role_id" class="w-full p-2 border rounded-lg">
                <option value="1">Admin</option>
                <option value="2">Staff</option>
                <option value="3">User</option>
            </select>
        </label>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection
