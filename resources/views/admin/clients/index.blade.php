@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Clients</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr class="border-b">
                <td class="p-3 border">{{ $client->id }}</td>
                <td class="p-3 border">{{ $client->name }}</td>
                <td class="p-3 border">{{ $client->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
