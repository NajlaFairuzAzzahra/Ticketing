@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Profil Pengguna</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Divisi:</strong> {{ Auth::user()->division }}</p>
    </div>
</div>
@endsection
