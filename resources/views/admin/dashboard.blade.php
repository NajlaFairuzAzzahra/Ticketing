@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $stats['total_tickets'] }}</h3>
                    <p>Total Tiket</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $stats['open_tickets'] }}</h3>
                    <p>Tiket Open</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $stats['in_progress_tickets'] }}</h3>
                    <p>Tiket In Progress</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $stats['closed_tickets'] }}</h3>
                    <p>Tiket Closed</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $stats['total_users'] }}</h3>
                    <p>Total Users</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
