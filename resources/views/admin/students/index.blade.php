@extends('layouts.admin')

@section('title', 'Students')

@section('content')

<div class="space-y-6">

    <!-- Top Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">Students Management</h1>
            <p class="text-sm text-gray-500">Manage all students records here.</p>
        </div>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('students.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl shadow">
                + Add Student
            </a>

            <a href="/generate-fee"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl shadow">
                Generate Monthly Fee
            </a>

        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-5 py-4 text-left">Name</th>
                        <th class="px-5 py-4 text-left">Class</th>
                        <th class="px-5 py-4 text-left">Fee</th>
                        <th class="px-5 py-4 text-left">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @foreach($students as $student)
                    <tr class="hover:bg-gray-50">

                        <td class="px-5 py-4 font-medium text-gray-800">
                            {{ $student->name }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $student->class }}
                        </td>

                        <td class="px-5 py-4 font-semibold text-red-600">
                            ₹{{ number_format($student->balance_fee) }}
                        </td>

                        <td class="px-5 py-4">

                            <div class="flex flex-wrap gap-2">

                                <a href="{{ route('students.edit', $student->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs">
                                    Edit
                                </a>

                                <a href="{{ route('students.admit', $student->id) }}"
                                   target="_blank"
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg text-xs">
                                    Admit
                                </a>

                                <a href="{{ route('fee.create', $student->id) }}"
                                   class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs">
                                    Pay Fee
                                </a>
                                <a target="_blank"
style="background:#25D366;color:white;padding:6px 10px;border-radius:5px;text-decoration:none;"
href="https://wa.me/91{{ $student->mobile_no }}?text={{ urlencode('Dear Parent, Student '.$student->name.' ki ₹'.$student->balance_fee.' fees pending hai. Kindly pay soon.') }}">
WhatsApp
</a>

                                <a href="{{ route('students.ledger', $student->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs">
                                    Ledger
                                </a>

                                <a href="{{ route('students.monthly', $student->id) }}"
                                   class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded-lg text-xs">
                                    Monthly
                                </a>

                                <form action="{{ route('students.delete', $student->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this student?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs">
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection