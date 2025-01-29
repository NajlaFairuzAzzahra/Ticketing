<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Admin') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans">

    <!-- Layout Grid -->
    <div class="min-h-screen flex">

        <!-- Sidebar Admin -->
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h1 class="text-xl font-bold mb-6">Admin Panel</h1>

            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.users') ? 'bg-gray-700' : '' }}">
                    User Management
                </a>
                <a href="{{ route('admin.departments') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.departments') ? 'bg-gray-700' : '' }}">
                    Departments
                </a>
                <a href="{{ route('admin.clients') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.clients') ? 'bg-gray-700' : '' }}">
                    Clients
                </a>
                <a href="{{ route('admin.tickets') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.tickets') ? 'bg-gray-700' : '' }}">
                    Tickets
                </a>
                <a href="{{ route('admin.notifications') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.notifications') ? 'bg-gray-700' : '' }}">
                    Notifications
                </a>
            </nav>

            <!-- Logout -->
            <div class="mt-auto p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-white p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
