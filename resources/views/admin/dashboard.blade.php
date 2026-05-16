@extends('layouts.admin')

@section('title', 'Dashboard')

<!-- @section('header', 'Dashboard') -->

@section('content')

<div class="space-y-6">

    <!-- Welcome -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold">
            Welcome Back, {{ auth()->user()->name }} 👋
        </h2>
        <p class="mt-2 text-sm text-blue-100">
            Manage your School ERP system easily from this dashboard.
        </p>
    </div>

    <!-- Main Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Total Students</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ \App\Models\Student::count() }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Total Teachers</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ \App\Models\User::where('role','teacher')->count() }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Fee Collection</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                ₹{{ number_format(\App\Models\FeePayment::sum('amount')) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Pending Fees</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                ₹{{ number_format(\App\Models\MonthlyFee::sum('balance')) }}
            </h3>
        </div>

    </div>

    <!-- Extra Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-2xl shadow p-5">
            <p class="text-sm opacity-90">Total Students</p>
            <h3 class="text-3xl font-bold mt-2">{{ $totalStudents }}</h3>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow p-5">
            <p class="text-sm opacity-90">Total Collection</p>
            <h3 class="text-3xl font-bold mt-2">₹{{ number_format($totalCollection) }}</h3>
        </div>

        <div class="bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-2xl shadow p-5">
            <p class="text-sm opacity-90">Today Collection</p>
            <h3 class="text-3xl font-bold mt-2">₹{{ number_format($todayCollection) }}</h3>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-2xl shadow p-5">
            <p class="text-sm opacity-90">Pending Dues</p>
            <h3 class="text-3xl font-bold mt-2">₹{{ number_format($pendingDues) }}</h3>
        </div>

    </div>

    <!-- Chart -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Monthly Fee Collection
        </h3>

        <canvas id="feeChart" height="100"></canvas>
    </div>

    <!-- Middle Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Payments -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Recent Payments
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left text-gray-500">
                            <th class="pb-3">Student</th>
                            <th class="pb-3">Amount</th>
                            <th class="pb-3">Mode</th>
                            <th class="pb-3">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach(\App\Models\FeePayment::latest()->take(5)->get() as $payment)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">{{ $payment->student->name ?? 'N/A' }}</td>
                            <td class="py-3 font-medium text-green-600">
                                ₹{{ $payment->amount }}
                            </td>
                            <td class="py-3 capitalize">
                                {{ $payment->payment_mode }}
                            </td>
                            <td class="py-3">
                                {{ $payment->created_at->format('d M Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Quick Actions
            </h3>

            <div class="space-y-3">

                <a href="{{ route('students.create') }}"
                   class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl text-center font-medium">
                    + Add Student
                </a>

                <a href="{{ route('students.index') }}"
                   class="block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-xl text-center font-medium">
                    View Students
                </a>

                <a href="#"
                   class="block bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-xl text-center font-medium">
                    Fee Collection
                </a>

                <a href="#"
                   class="block bg-gray-800 hover:bg-gray-900 text-white px-4 py-3 rounded-xl text-center font-medium">
                    Reports
                </a>

            </div>
        </div>

    </div>

</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('feeChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($monthlyData as $row)
                "{{ date('M', mktime(0,0,0,$row->month,1)) }}",
            @endforeach
        ],
        datasets: [{
            label: 'Monthly Collection',
            data: [
                @foreach($monthlyData as $row)
                    {{ $row->total }},
                @endforeach
            ],
            borderRadius: 8,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        }
    }
});
</script>

@endsection