@extends('layouts.admin')

@section('title', 'Pay Fee')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-5">
            <h2 class="text-2xl font-bold text-white">
                Pay Fee - {{ $student->name }}
            </h2>

            <p class="text-green-100 text-sm mt-1">
                Submit student fee using cash or online payment.
            </p>
        </div>

        <!-- Body -->
        <div class="p-6">

            <form method="POST"
                  action="{{ route('fee.store', $student->id) }}"
                  id="paymentForm"
                  class="space-y-6">

                @csrf

                <!-- Student Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500">Student Name</p>
                        <h3 class="font-semibold text-gray-800">
                            {{ $student->name }}
                        </h3>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500">Class</p>
                        <h3 class="font-semibold text-gray-800">
                            {{ $student->class }}
                        </h3>
                    </div>

                </div>

                <!-- Amount -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Amount
                    </label>

                    <input type="number"
                           name="amount"
                           id="amount"
                           placeholder="Enter amount"
                           required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- Payment Mode -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Payment Mode
                    </label>

                    <select name="payment_mode"
                            id="payment_mode"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                        <option value="cash">Cash</option>
                        <option value="online">Online</option>

                    </select>
                </div>

                <!-- Remark -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Remark
                    </label>

                    <input type="text"
                           name="remark"
                           placeholder="Optional remark"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">

                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold shadow">
                        Pay Now
                    </button>

                    <a href="{{ route('students.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl text-center font-semibold">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.getElementById('paymentForm').addEventListener('submit', function(e){

    let mode = document.getElementById('payment_mode').value;
    let amount = document.getElementById('amount').value;

    if(mode === 'online'){

        e.preventDefault();

        fetch("{{ route('razorpay.order') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                amount: amount
            })
        })
        .then(res => res.json())
        .then(data => {

            var options = {
                key: data.key,
                amount: data.amount,
                currency: "INR",
                name: "School ERP",
                description: "Fee Payment",
                order_id: data.order_id,

                handler: function (response) {

                    window.location.href =
                        "{{ route('razorpay.success') }}?payment_id="
                        + response.razorpay_payment_id
                        + "&amount=" + amount
                        + "&student_id={{ $student->id }}";
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();

        });

    }

});
</script>

@endsection