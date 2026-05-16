@extends('layouts.admin')

@section('title', 'Add Student')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5">
            <h2 class="text-2xl font-bold text-white">Add Student</h2>
            <p class="text-blue-100 text-sm mt-1">
                Fill all required student information below.
            </p>
        </div>

        <!-- Form -->
        <div class="p-6">

            <form method="POST"
                  action="{{ route('students.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf

                <!-- Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Student Name
                        </label>

                        <input type="text"
                               name="name"
                               placeholder="Enter student name"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Father Name
                        </label>

                        <input type="text"
                               name="father_name"
                               placeholder="Enter father name"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Mobile Number
                        </label>

                        <input type="text"
                               name="mobile"
                               placeholder="Enter mobile number"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Class
                        </label>

                        <input type="text"
                               name="class"
                               placeholder="Example: 11 A"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                </div>

                <!-- Row 3 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Roll Number
                        </label>

                        <input type="number"
                               name="roll_no"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Student Photo
                        </label>

                        <input type="file"
                               name="photo"
                               class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white">
                    </div>

                </div>

                <!-- Subjects -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Subjects
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <input type="text"
                               name="subjects[]"
                               placeholder="Subject 1"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        <input type="text"
                               name="subjects[]"
                               placeholder="Subject 2"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    </div>
                </div>

                <!-- Fees -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Total Fee
                        </label>

                        <input type="number"
                               name="total_fee"
                               placeholder="Enter total fee"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Paid Fee
                        </label>

                        <input type="number"
                               name="paid_fee"
                               placeholder="Enter paid fee"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow">
                        Save Student
                    </button>

                    <a href="{{ route('students.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold text-center">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection