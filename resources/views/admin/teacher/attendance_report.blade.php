@extends('layouts.teacher')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Attendance Report</h2>
        <p class="text-gray-500">Smart analytics with performance insights</p>
    </div>

    <!-- 📊 QUICK STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded-2xl shadow-sm">
            <p class="text-gray-500 text-sm">Total Students</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ count($report) }}</h3>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm">
            <p class="text-gray-500 text-sm">Avg Attendance</p>
            <h3 class="text-2xl font-bold text-blue-600">
                {{ round(collect($report)->avg('percentage')) }}%
            </h3>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm">
            <p class="text-gray-500 text-sm">🟢 Good</p>
            <h3 class="text-2xl font-bold text-green-600">
                {{ collect($report)->where('percentage','>=',75)->count() }}
            </h3>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm">
            <p class="text-gray-500 text-sm">🔴 Critical</p>
            <h3 class="text-2xl font-bold text-red-600">
                {{ collect($report)->where('percentage','<',50)->count() }}
            </h3>
        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6">

        <form method="GET" class="flex flex-wrap gap-4 items-end">

            <!-- Month -->
            <div>
                <label class="text-sm text-gray-600">Month</label>
                <select name="month" class="mt-1 border rounded-lg px-3 py-2 w-40">

                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0,0,0,$m,1)) }}
                        </option>
                    @endfor

                </select>
            </div>

            <!-- Year -->
            <div>
                <label class="text-sm text-gray-600">Year</label>
                <select name="year" class="mt-1 border rounded-lg px-3 py-2 w-32">

                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor

                </select>
            </div>

            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Filter
            </button>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <table class="min-w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left">Student</th>
                    <th class="px-6 py-3 text-center">Total</th>
                    <th class="px-6 py-3 text-center">Present</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Attendance</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y">

                @php
                    // SORT: Lowest attendance first
                    $sorted = collect($report)->sortBy('percentage');
                @endphp

                @foreach($sorted as $row)

                @php
                    $p = $row['percentage'];

                    if ($p >= 75) {
                        $status = '🟢 Good';
                        $color = 'text-green-600';
                        $bar = 'bg-green-500';
                    } elseif ($p >= 50) {
                        $status = '🟡 Warning';
                        $color = 'text-yellow-600';
                        $bar = 'bg-yellow-500';
                    } else {
                        $status = '🔴 Critical';
                        $color = 'text-red-600';
                        $bar = 'bg-red-500';
                    }
                @endphp

                <tr class="hover:bg-gray-50">

                    <!-- NAME -->
                    <td class="px-6 py-4 font-medium">
                        {{ $row['student']->name }}
                    </td>

                    <!-- TOTAL -->
                    <td class="px-6 py-4 text-center">
                        {{ $row['total'] }}
                    </td>

                    <!-- PRESENT -->
                    <td class="px-6 py-4 text-center">
                        {{ $row['present'] }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4 text-center font-semibold {{ $color }}">
                        {{ $status }}
                    </td>

                    <!-- PROGRESS BAR -->
                    <td class="px-6 py-4">

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div class="{{ $bar }} h-3 rounded-full"
                                 style="width: {{ $p }}%"></div>

                        </div>

                        <p class="text-center text-xs mt-1 text-gray-600">
                            {{ $p }}%
                        </p>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection