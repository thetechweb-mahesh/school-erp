@extends('layouts.teacher')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Mark Attendance</h2>
        <p class="text-gray-500">Select present or absent for each student</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('teacher.attendance.store') }}">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">

                    <!-- Header -->
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                Student
                            </th>
                            <th class="px-6 py-3 text-center font-semibold text-gray-600">
                                Present
                            </th>
                            <th class="px-6 py-3 text-center font-semibold text-gray-600">
                                Absent
                            </th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y">

                        @foreach($students as $student)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- Name -->
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $student->name }}
                            </td>

                            <!-- Present -->
                            <td class="px-6 py-4 text-center">
                                <input type="radio"
                                       name="attendance[{{ $student->id }}]"
                                       value="present"
                                       class="w-5 h-5 text-green-600 focus:ring-green-500"
                                       required>
                            </td>

                            <!-- Absent -->
                            <td class="px-6 py-4 text-center">
                                <input type="radio"
                                       name="attendance[{{ $student->id }}]"
                                       value="absent"
                                       class="w-5 h-5 text-red-600 focus:ring-red-500">
                            </td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                Save Attendance
            </button>
        </div>

    </form>

</div>

@endsection