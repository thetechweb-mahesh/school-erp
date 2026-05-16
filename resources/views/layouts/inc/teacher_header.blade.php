
<!-- Navbar -->
<header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Left: Welcome -->
            <div class="flex items-center space-x-2">
                <div class="w-9 h-9 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <p class="text-sm text-gray-500">Welcome</p>
                    <p class="font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>
                </div>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center space-x-4">

                <!-- Optional Notification Icon -->
                <button class="text-gray-500 hover:text-gray-700">
                    🔔
                </button>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </div>
</header>
