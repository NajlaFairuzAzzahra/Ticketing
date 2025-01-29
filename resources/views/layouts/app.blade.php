<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    </head>
    <body class="bg-gray-100 font-sans">
        <!-- Layout Grid -->
        <div class="min-h-screen grid grid-cols-12">
            <!-- Sidebar -->
            <aside class="col-span-3 bg-gray-800 text-white p-6">
                <h1 class="text-xl font-bold mb-6">Helpdesk</h1>
                <nav class="space-y-4">
                    <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('user.dashboard') ? 'bg-gray-700' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('user.tickets.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('user.tickets.*') ? 'bg-gray-700' : '' }}">
                        Daftar Tiket
                    </a>
                    <a href="{{ route('user.profile') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('user.profile') ? 'bg-gray-700' : '' }}">
                        Profil
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
            <main class="col-span-9 bg-white p-6">
                @yield('content')
            </main>
        </div>
    </body>
</html>
