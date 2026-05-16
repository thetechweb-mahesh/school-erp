<!-- resources/views/inc/sidebar.blade.php -->

<aside class="fixed top-0 left-0 w-64 h-screen bg-gray-900 text-white">

    <!-- Logo -->
    <div class="px-6 py-5 border-b border-gray-800">
        <h1 class="text-2xl font-bold text-blue-400">School ERP</h1>
        <p class="text-xs text-gray-400 mt-1">Admin Panel</p>
    </div>

    <!-- Menu -->
    <nav class="mt-5 px-4 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-800 transition">
            📊 <span class="ml-3">Dashboard</span>
        </a>

        <a href="{{ route('students.index') }}"
           class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-800 transition">
            🎓 <span class="ml-3">Students</span>
        </a>

        <a href="{{ route('fee.collection') }}"
           class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-800 transition">
            💰 <span class="ml-3">Fee Collection</span>
        </a>

        <a href="#"
           class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-800 transition">
            👨‍🏫 <span class="ml-3">Teachers</span>
        </a>

        <a href="#"
           class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-800 transition">
            📄 <span class="ml-3">Reports</span>
        </a>
<a href="{{ route('students.pending') }}" class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-800 transition">📌
    <span class="ml-3"> Pending Dues</span>
</a>
       
<a href="#"
           class="flex items-center px-4 py-3 rounded-xl hover:bg-gray-800 transition">
            ⚙️ <span class="ml-3">Settings</span>
        </a>

    </nav>

</aside>