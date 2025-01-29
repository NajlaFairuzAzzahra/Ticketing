@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Departments</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Department Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
            <tr class="border-b">
                <td class="p-3 border">{{ $department->id }}</td>
                <td class="p-3 border">{{ $department->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
