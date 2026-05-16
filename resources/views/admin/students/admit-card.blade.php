@extends('layouts.admin')

@section('title', 'Admit Card')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Print Button -->
    <div class="mb-6 flex justify-end print:hidden">
        <button onclick="window.print()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow font-medium">
            🖨 Print Admit Card
        </button>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-700 to-indigo-700 text-white px-8 py-6 text-center">
            <h1 class="text-3xl font-bold tracking-wide">
                BOLT INTER COLLEGE
            </h1>

            <p class="mt-2 text-blue-100 text-lg">
                Admit Card (Half Yearly Examination)
            </p>
        </div>

        <!-- Body -->
        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <!-- Left Info -->
                <div class="md:col-span-3 space-y-4">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500">Student Name</p>
                            <h3 class="font-semibold text-gray-800">{{ $student->name }}</h3>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500">Father Name</p>
                            <h3 class="font-semibold text-gray-800">{{ $student->father_name }}</h3>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500">Class</p>
                            <h3 class="font-semibold text-gray-800">{{ $student->class }}</h3>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500">Roll Number</p>
                            <h3 class="font-semibold text-gray-800">{{ $student->roll_no }}</h3>
                        </div>

                    </div>

                    <!-- Subjects -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-2">Subjects</p>

                        <p class="font-medium text-gray-800">
                            {{ implode(', ', json_decode($student->subjects, true) ?? []) }}
                        </p>
                    </div>

                    <!-- Fees -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                            <p class="text-sm text-gray-500">Total Fee</p>
                            <h3 class="font-bold text-blue-700">₹{{ number_format($student->total_fee) }}</h3>
                        </div>

                        <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                            <p class="text-sm text-gray-500">Paid Fee</p>
                            <h3 class="font-bold text-green-700">₹{{ number_format($student->paid_fee) }}</h3>
                        </div>

                        <div class="bg-red-50 rounded-xl p-4 border border-red-100">
                            <p class="text-sm text-gray-500">Balance Fee</p>
                            <h3 class="font-bold text-red-700">₹{{ number_format($student->balance_fee) }}</h3>
                        </div>

                    </div>

                </div>

                <!-- Photo -->
                <div class="flex justify-center md:justify-end">

                    <div class="w-40 h-48 border-2 border-dashed border-gray-300 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center">

                        @if($student->photo)
                            <img src="{{ asset('uploads/students/'.$student->photo) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400 text-sm">No Photo</span>
                        @endif

                    </div>

                </div>

            </div>

            <!-- Footer -->
            <div class="mt-12 flex justify-between items-end">

                <div>
                    <p class="text-sm text-gray-500">Issued Date</p>
                    <p class="font-medium">{{ now()->format('d M Y') }}</p>
                </div>

                <div class="text-center">
                    <div class="border-t border-gray-500 w-40 mx-auto mb-2"></div>
                    <p class="font-medium text-gray-700">Principal Signature</p>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection