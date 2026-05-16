@extends('layouts.admin')

@section('title', 'Student Ledger')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Student Ledger
            </h2>

            <p class="text-gray-500 mt-1">
                Payment history and fee summary.
            </p>
        </div>

        <button onclick="window.print()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow font-medium print:hidden">
            🖨 Print Ledger
        </button>

    </div>

    <!-- Student Info -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-gray-500">Student Name</p>
                <h3 class="text-xl font-bold text-gray-800">
                    {{ $student->name }}
                </h3>
            </div>

            <div>
                <p class="text-sm text-gray-500">Class</p>
                <h3 class="text-xl font-bold text-gray-800">
                    {{ $student->class }}
                </h3>
            </div>

        </div>

    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Total Fee</p>
            <h3 class="text-2xl font-bold text-blue-700">
                ₹{{ number_format($student->total_fee) }}
            </h3>
        </div>

        <div class="bg-green-50 border border-green-100 rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Paid Amount</p>
            <h3 class="text-2xl font-bold text-green-700">
                ₹{{ number_format($student->paid_fee) }}
            </h3>
        </div>

        <div class="bg-red-50 border border-red-100 rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Balance</p>
            <h3 class="text-2xl font-bold text-red-700">
                ₹{{ number_format($student->balance_fee) }}
            </h3>
        </div>

    </div>

    <!-- Ledger Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">
                Payment Transactions
            </h3>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Mode</th>
                        <th class="px-6 py-4">Remark</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($student->payments as $pay)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 text-gray-700">
                            {{ $pay->payment_date }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-green-600">
                            ₹{{ number_format($pay->amount) }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                {{ $pay->payment_mode == 'cash' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($pay->payment_mode) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $pay->remark ?: '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            No payment records found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection