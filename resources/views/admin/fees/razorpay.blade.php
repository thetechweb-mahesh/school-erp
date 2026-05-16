<h3>Pay Fee - {{ $student->name }}</h3>

<button id="payBtn">Pay ₹{{ $amount }}</button>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ $key }}",
    "amount": "{{ $amount * 100 }}",
    "currency": "INR",
    "name": "School ERP",
    "description": "Fee Payment",
    "order_id": "{{ $order_id }}",

    "handler": function (response){
        // success ke baad backend hit karenge
        window.location.href = "/payment-success?payment_id=" + response.razorpay_payment_id;
    }
};

var rzp = new Razorpay(options);

document.getElementById('payBtn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>