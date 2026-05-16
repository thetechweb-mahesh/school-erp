<!-- resources/views/inc/sidebar.blade.php -->

<aside class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-white flex flex-col shadow-xl">

    <!-- Logo -->
    <div class="px-6 py-5 border-b border-gray-800">
        <h1 class="text-2xl font-bold text-blue-400">School ERP</h1>
        <p class="text-xs text-gray-400 mt-1">Administration Panel</p>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-blue-400' : 'hover:bg-gray-800' }}">

            <!-- icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 10h11M9 21V3m0 0L3 9m6-6l6 6" />
            </svg>

            <span class="text-sm font-medium">Dashboard</span>
        </a>

        <!-- Students -->
        <a href="{{ route('students.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('students.*') ? 'bg-gray-800 text-blue-400' : 'hover:bg-gray-800' }}">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l6.16-3.422a12.083 12.083 0 010 6.844L12 14z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14L5.84 10.578a12.083 12.083 0 000 6.844L12 14z" />
            </svg>

            <span class="text-sm font-medium">Students</span>
        </a>

        <!-- Fee Collection -->
        <a href="{{ route('fee.collection') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-18v3m0 12v3" />
            </svg>

            <span class="text-sm font-medium">Fee Collection</span>
        </a>

        <!-- Teachers -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A9 9 0 1118.879 6.196a9 9 0 01-13.758 11.608z" />
            </svg>

            <span class="text-sm font-medium">Teachers</span>
        </a>

        <!-- Reports -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17v-6m4 6V7m4 10V3" />
            </svg>

            <span class="text-sm font-medium">Reports</span>
        </a>

        <!-- Pending Dues -->
        <a href="{{ route('students.pending') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('students.pending') ? 'bg-gray-800 text-red-400' : 'hover:bg-gray-800' }}">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <span class="text-sm font-medium">Pending Dues</span>
        </a>

        <!-- Settings -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition mt-4 border-t border-gray-800 pt-4">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.591 1.06c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.06 2.591c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.06 2.591c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.591 1.06c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.591-1.06c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.06-2.591c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.06-2.591c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.591-1.06z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>

            <span class="text-sm font-medium">Settings</span>
        </a>

    </nav>
</aside>