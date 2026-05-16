@extends('layouts.admin')

@section('title', 'Edit Student')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-5">
            <h2 class="text-2xl font-bold text-white">Edit Student</h2>
            <p class="text-blue-100 text-sm mt-1">
                Update student details and information.
            </p>
        </div>

        <!-- Form -->
        <div class="p-6">

            <form method="POST"
                  action="{{ route('students.update', $student->id) }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf
                @method('PUT')

                <!-- Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Student Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ $student->name }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Father Name
                        </label>

                        <input type="text"
                               name="father_name"
                               value="{{ $student->father_name }}"
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
                               value="{{ $student->mobile }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Class
                        </label>

                        <input type="text"
                               name="class"
                               value="{{ $student->class }}"
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
                               value="{{ $student->roll_no }}"
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

                <!-- Old Photo -->
                @if($student->photo)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Current Photo
                    </label>

                    <img src="{{ asset('uploads/students/'.$student->photo) }}"
                         class="w-28 h-28 rounded-xl object-cover border shadow">
                </div>
                @endif

                <!-- Fees -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Total Fee
                        </label>

                        <input type="number"
                               name="total_fee"
                               value="{{ $student->total_fee }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Paid Fee
                        </label>

                        <input type="number"
                               name="paid_fee"
                               value="{{ $student->paid_fee }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow">
                        Update Student
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