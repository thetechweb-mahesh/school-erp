@extends('layouts.admin')

@section('title', 'Monthly Fees')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="mb-6">

        <h2 class="text-3xl font-bold text-gray-800">
            Monthly Fees
        </h2>

        <p class="text-gray-500 mt-1">
            Student monthly fee status and payment tracking.
        </p>

    </div>

    <!-- Student Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

        <p class="text-sm text-gray-500">Student Name</p>

        <h3 class="text-2xl font-bold text-gray-800">
            {{ $student->name }}
        </h3>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">
                Fee Breakdown
            </h3>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Month</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Paid</th>
                        <th class="px-6 py-4">Balance</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($student->monthlyFees as $fee)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $fee->month }}
                        </td>

                        <td class="px-6 py-4 text-blue-700 font-semibold">
                            ₹{{ number_format($fee->amount) }}
                        </td>

                        <td class="px-6 py-4 text-green-700 font-semibold">
                            ₹{{ number_format($fee->paid) }}
                        </td>

                        <td class="px-6 py-4 text-red-600 font-semibold">
                            ₹{{ number_format($fee->balance) }}
                        </td>

                        <td class="px-6 py-4">

                            @if($fee->balance == 0)

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    Paid
                                </span>

                            @elseif($fee->paid > 0)

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                    Partial
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    Due
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No monthly fee records found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection