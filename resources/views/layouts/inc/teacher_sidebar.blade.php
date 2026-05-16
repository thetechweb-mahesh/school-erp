<!-- Sidebar -->
<aside class="w-64 h-screen bg-white shadow-md fixed left-0 top-0">

    <!-- Logo / Title -->
    <div class="h-16 flex items-center px-6 border-b">
        <h2 class="text-xl font-bold text-gray-800">
            🎓 Teacher Panel
        </h2>
    </div>

    <!-- Menu -->
    <nav class="mt-6 px-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('teacher.dashboard') }}"
           class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">

            <span class="mr-3">🏠</span>
            Dashboard
        </a>

        <!-- Students -->
        <a href="{{ route('teacher.students') }}"
           class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">

            <span class="mr-3">🎓</span>
            Students
        </a>

        <!-- Attendance -->
        <a href="{{ route('teacher.attendance') }}"
           class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">

            <span class="mr-3">📋</span>
            Attendance
        </a>

        <!-- Attendance -->
        <a href="{{ route('teacher.attendance.report') }}"
           class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">

            <span class="mr-3"></span>
            Attendance report
        </a>
    </nav>

</aside>