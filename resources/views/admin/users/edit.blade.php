@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Role</label>
            <select name="role_id" class="w-full p-2 border border-gray-300 rounded-lg">
                <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Staff</option>
                <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
