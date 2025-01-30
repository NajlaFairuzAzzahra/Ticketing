<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex">
        <!-- Sidebar User -->
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h1 class="text-xl font-bold mb-6">User Panel</h1>

            <nav class="space-y-4">
                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('user.dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('user.profile') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('user.profile') ? 'bg-gray-700' : '' }}">
                    Profil
                </a>
                <a href="{{ route('user.tickets.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('user.tickets.*') ? 'bg-gray-700' : '' }}">
                    Daftar Tiket
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-white p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
