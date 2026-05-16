@extends('layouts.admin')

@section('title', 'Fee Receipt')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Fee Receipt
            </h2>

            <p class="text-gray-500 mt-1">
                Payment receipt details and month-wise fee allocation.
            </p>
        </div>

        <a href="{{ route('fee.receipt.pdf', $payment->id) }}"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow font-medium text-center">
            Download PDF
        </a>

    </div>

    <!-- Receipt Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <!-- Top Banner -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-8 py-6 text-white">

            <h3 class="text-2xl font-bold">
                School ERP
            </h3>

            <p class="text-blue-100 mt-1">
                Fee Payment Receipt
            </p>

        </div>

        <!-- Content -->
        <div class="p-8">

            <!-- Student Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-sm text-gray-500">Student Name</p>
                    <h4 class="text-lg font-semibold text-gray-800">
                        {{ $payment->student->name }}
                    </h4>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-sm text-gray-500">Class</p>
                    <h4 class="text-lg font-semibold text-gray-800">
                        {{ $payment->student->class }}
                    </h4>
                </div>

            </div>

            <!-- Fee Table -->
            <div class="overflow-x-auto mb-8">

                <table class="w-full text-sm text-left">

                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">Month</th>
                            <th class="px-6 py-4">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach($payment->allocations as $alloc)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $alloc->monthlyFee->month }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-green-600">
                                ₹{{ number_format($alloc->amount) }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Total Paid -->
            <div class="flex justify-end">

                <div class="bg-green-50 border border-green-100 rounded-xl px-6 py-4 min-w-[240px]">

                    <p class="text-sm text-gray-500">
                        Total Paid
                    </p>

                    <h3 class="text-2xl font-bold text-green-700 mt-1">
                        ₹{{ number_format($payment->amount) }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection