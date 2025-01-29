<nav x-data="{ open: false }" class="bg-gray-900 text-white w-64 min-h-screen fixed">
    <div class="p-4 text-lg font-bold border-b border-gray-700">
        Admin Panel
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">
            Dashboard
        </a>
        <a href="{{ route('admin.tickets') }}" class="block px-4 py-2 hover:bg-gray-700">
            Tickets
        </a>
        <a href="{{ route('admin.canned-responses') }}" class="block px-4 py-2 hover:bg-gray-700">
            Canned Responses
        </a>
        <a href="{{ route('admin.notifications') }}" class="block px-4 py-2 hover:bg-gray-700">
            Notifications
        </a>
        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-gray-700">
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
