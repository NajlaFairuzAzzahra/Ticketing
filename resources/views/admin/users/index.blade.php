@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">User Management</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Nama</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b">
                <td class="p-3 border">{{ $user->id }}</td>
                <td class="p-3 border">{{ $user->name }}</td>
                <td class="p-3 border">{{ $user->email }}</td>
                <td class="p-3 border">{{ $user->role->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
