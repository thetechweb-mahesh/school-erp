@extends('layouts.teacher')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Students List</h2>
        <p class="text-gray-500">All assigned students under your class</p>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">

                <!-- Head -->
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-600">ID</th>
                        <th class="px-6 py-3 font-semibold text-gray-600">Name</th>
                        <th class="px-6 py-3 font-semibold text-gray-600">Class</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="divide-y">

                    @foreach($students as $student)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-gray-700">
                            #{{ $student->id }}
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $student->name }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-full">
                                {{ $student->class }}
                            </span>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $students->links() }}
    </div>

</div>

@endsection