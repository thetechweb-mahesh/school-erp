@extends('layouts.teacher')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Teacher Dashboard</h2>
        <p class="text-gray-500">Welcome back! Here’s your overview.</p>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Students -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Total Students</p>
                    <h3 class="text-3xl font-bold text-gray-800">
                        {{ $totalStudents }}
                    </h3>
                </div>

                <div class="w-14 h-14 bg-blue-500 text-white rounded-full flex items-center justify-center text-2xl">
                    🎓
                </div>

            </div>
        </div>

        <!-- Today Attendance -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Today Attendance</p>
                    <h3 class="text-3xl font-bold text-gray-800">
                        {{ $todayAttendance ?? 0 }}
                    </h3>
                </div>

                <div class="w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center text-2xl">
                    📋
                </div>

            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">Pending Attendance</p>
                    <h3 class="text-3xl font-bold text-gray-800">
                        {{ $pending ?? 0 }}
                    </h3>
                </div>

                <div class="w-14 h-14 bg-yellow-500 text-white rounded-full flex items-center justify-center text-2xl">
                    ⏳
                </div>

            </div>
        </div>

    </div>

    <!-- Quick Actions (optional next level) -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-blue-50 border border-blue-100 p-5 rounded-2xl">
            <h4 class="text-lg font-semibold text-blue-700">Quick Action</h4>
            <p class="text-gray-600 mt-1">Mark today's attendance quickly.</p>

            <a href="{{ route('teacher.attendance') }}"
               class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Mark Attendance
            </a>
        </div>

        <div class="bg-green-50 border border-green-100 p-5 rounded-2xl">
            <h4 class="text-lg font-semibold text-green-700">Students</h4>
            <p class="text-gray-600 mt-1">View all assigned students.</p>

            <a href="{{ route('teacher.students') }}"
               class="inline-block mt-3 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                View Students
            </a>
        </div>

    </div>

</div>

@endsection