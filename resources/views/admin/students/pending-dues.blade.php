@extends('layouts.admin')

@section('title', 'Pending Dues')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Pending Dues
            </h2>

            <p class="text-gray-500 mt-1">
                Track unpaid student fees and send reminders quickly.
            </p>
        </div>

    </div>

    <!-- Summary Card -->
    <div class="mb-8">

        <div class="bg-gradient-to-r from-red-500 to-rose-600 rounded-2xl shadow-xl p-6 text-white max-w-sm">

            <p class="text-sm uppercase tracking-wide text-red-100">
                Total Pending Amount
            </p>

            <h3 class="text-4xl font-bold mt-2">
                ₹{{ number_format($totalDue) }}
            </h3>

            <p class="text-red-100 mt-2 text-sm">
                Outstanding fees from all students
            </p>

        </div>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">
                Student Due List
            </h3>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Student Name</th>
                        <th class="px-6 py-4">Class</th>
                        <th class="px-6 py-4">Pending Fee</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($students as $student)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium text-gray-700">
                            #{{ $student->id }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $student->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $student->class }}
                        </td>

                        <td class="px-6 py-4 font-bold text-red-600">
                            ₹{{ number_format($student->balance_fee) }}
                        </td>

                        <td class="px-6 py-4">

                            <div class="flex flex-wrap gap-2 justify-center">

                                <a href="{{ route('fee.create', $student->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-medium">
                                    Pay Fee
                                </a>

                                <a target="_blank"
                                   href="https://wa.me/91{{ $student->mobile_no }}?text={{ urlencode('Dear Parent, Student '.$student->name.' ki ₹'.$student->balance_fee.' fees pending hai. Kindly pay soon.') }}"
                                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-xs font-medium">
                                    WhatsApp
                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No pending dues found.
                        </td>
                    </tr>

                    @endforelse

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