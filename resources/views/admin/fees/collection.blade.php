@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">

    <h2>Fee Collection</h2>

    <div>
        <a href="{{ route('fee.export.excel', request()->query()) }}"
           style="background:#27ae60;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;">
           Export Excel
        </a>

        <a href="{{ route('fee.export.pdf', request()->query()) }}"
           style="background:#e74c3c;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;margin-left:5px;">
           Export PDF
        </a>
        
    </div>

</div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-90">Today Collection</p>

            <h3 class="text-3xl font-bold mt-2">
                ₹{{ number_format($todayCollection) }}
            </h3>
        </div>

        <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-90">Total Collection</p>

            <h3 class="text-3xl font-bold mt-2">
                ₹{{ number_format($totalCollection) }}
            </h3>
        </div>

    </div>

    <!-- Filter Box -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">

        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <!-- Student Name -->
            <input type="text"
                   name="student_name"
                   value="{{ request('student_name') }}"
                   placeholder="Student Name"
                   class="border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

            <!-- Payment Mode -->
            <select name="payment_mode"
                    class="border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                <option value="">All Modes</option>

                <option value="cash"
                    {{ request('payment_mode') == 'cash' ? 'selected' : '' }}>
                    Cash
                </option>

                <option value="online"
                    {{ request('payment_mode') == 'online' ? 'selected' : '' }}>
                    Online
                </option>

            </select>

            <!-- Dates -->
            <input type="date"
                   name="from_date"
                   value="{{ request('from_date') }}"
                   class="border border-gray-300 rounded-xl px-4 py-3">

            <input type="date"
                   name="to_date"
                   value="{{ request('to_date') }}"
                   class="border border-gray-300 rounded-xl px-4 py-3">

            <!-- Buttons -->
            <div class="flex gap-3">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-medium w-full">
                    Search
                </button>

                <a href="{{ route('fee.collection') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-3 rounded-xl font-medium text-center w-full">
                    Reset
                </a>

            </div>

        </form>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">
                Payment Records
            </h3>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Student</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Mode</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Receipt</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($payments as $pay)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium text-gray-700">
                            #{{ $pay->id }}
                        </td>

                        <td class="px-6 py-4 text-gray-800">
                            {{ $pay->student->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-green-600">
                            ₹{{ number_format($pay->amount) }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $pay->payment_mode == 'cash'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-blue-100 text-blue-700' }}">

                                {{ ucfirst($pay->payment_mode) }}

                            </span>

                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $pay->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">

                            <a href="{{ route('fee.receipt', $pay->id) }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-xs font-medium">
                                Print
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No payment records found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $payments->appends(request()->query())->links() }}
    </div>

</div>

@endsection