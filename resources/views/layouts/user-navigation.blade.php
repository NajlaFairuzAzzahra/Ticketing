<nav x-data="{ open: false }" class="bg-gray-800 text-white w-64 min-h-screen fixed">
    <div class="p-4 text-lg font-bold border-b border-gray-700">
        User Panel
    </div>

    <div class="mt-4">
        <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">
            Dashboard
        </a>
        <a href="{{ route('user.tickets.index') }}" class="block px-4 py-2 hover:bg-gray-700">
            My Tickets
        </a>
        <a href="{{ route('user.profile') }}" class="block px-4 py-2 hover:bg-gray-700">
            Profile
        </a>
    </div>

    <div class="mt-auto p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-700">
                Logout
            </button>
        </form>
    </div>
</nav>
