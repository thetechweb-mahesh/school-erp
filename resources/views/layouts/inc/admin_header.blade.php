<header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

    <div>
        <h2 class="text-2xl font-semibold text-gray-800">
            Dashboard
        </h2>
        <p class="text-sm text-gray-500">
            Welcome, {{ auth()->user()->name }}
        </p>
    </div>

   <!-- Right Side Header User Menu -->
<div class="flex items-center gap-4">

    <!-- Notification -->
    <button class="relative">
        <span class="text-2xl">🔔</span>

        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs 
                     w-5 h-5 rounded-full flex items-center justify-center">
            3
        </span>
    </button>

    <!-- User Dropdown -->
    <div class="relative" x-data="{ open: false }">

        <!-- Profile Button -->
        <button @click="open = !open"
            class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold 
                   flex items-center justify-center shadow hover:bg-blue-700">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </button>

        <!-- Dropdown -->
        <div x-show="open"
             @click.away="open = false"
             x-transition
             class="absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-xl border z-50">

            <div class="px-4 py-3 border-b">
                <p class="font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </p>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">
                My Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-b-xl">
                    Logout
                </button>
            </form>

        </div>

    </div>

</div>

</header>