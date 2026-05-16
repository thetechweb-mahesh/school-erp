<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\PaymentAllocation;
use Barryvdh\DomPDF\Facade\Pdf;
use Razorpay\Api\Api;
use Carbon\Carbon;

class FeePaymentController extends Controller
{

public function ledger($id)
{
    $student = Student::with('payments')->findOrFail($id);

    return view('admin.fees.ledger', compact('student'));
}

   public function create($id)
{
    $student = Student::findOrFail($id);
    return view('admin.fees.create', compact('student'));
}

// new

public function store(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $amount = $request->amount;

    // Payment record save
    $payment = FeePayment::create([
        'student_id' => $student->id,
        'amount' => $amount,
        'payment_date' => now(),
        'payment_mode' => $request->payment_mode,
        'remark' => $request->remark,
    ]);

    // 🔥 Smart Adjustment Start
    $fees = $student->monthlyFees()
        ->where('balance', '>', 0)
        ->orderBy('id', 'asc')
        ->get();

   foreach ($fees as $fee) {

    if ($amount <= 0) break;

    if ($amount >= $fee->balance) {

        $paidAmount = $fee->balance;

        $amount -= $fee->balance;

        $fee->paid += $fee->balance;
        $fee->balance = 0;

    } else {

        $paidAmount = $amount;

        $fee->paid += $amount;
        $fee->balance -= $amount;

        $amount = 0;
    }

    $fee->save();

    // 🔥 Allocation Save
    PaymentAllocation::create([
        'fee_payment_id' => $payment->id,
        'monthly_fee_id' => $fee->id,
        'amount' => $paidAmount
    ]);
}
    return redirect()->route('fee.receipt', $payment->id);
}
//end new

//old 

// public function store(Request $request, $id)
// {
//     $student = Student::findOrFail($id);

//     $data = $request->validate([
//         'amount' => 'required|numeric'
//     ]);

//     $payment = FeePayment::create([
//         'student_id' => $student->id,
//         'amount' => $request->amount,
//         'payment_date' => now(),
//         'payment_mode' => $request->payment_mode,
//         'remark' => $request->remark,
//     ]);

//     // 🔥 IMPORTANT: Update student fee
//     $student->paid_fee += $request->amount;
//     $student->balance_fee = $student->total_fee - $student->paid_fee;
//     $student->save();

//     return redirect()->route('fee.receipt', $payment->id);
// }

//end old

public function receipt($id)
{
    $payment = FeePayment::with('student')->findOrFail($id);
    return view('admin.fees.receipt', compact('payment'));
}

  //monthlyfee
  public function monthly($id)
{
    $student = Student::with('monthlyFees')->findOrFail($id);
    return view('admin.fees.monthly', compact('student'));
}


// ReceiptPdf

public function receiptPdf($id)
{
    $payment = FeePayment::with('student', 'allocations.monthlyFee')->findOrFail($id);

    $pdf = Pdf::loadView('admin.fees.receipt-pdf', compact('payment'));

    return $pdf->download('receipt.pdf');
}


//Order by Razorpay


public function paymentSuccess(Request $request)
{
    $paymentId = $request->payment_id;
    $amount = $request->amount;
    $student_id = $request->student_id;

    $student = Student::findOrFail($student_id);

    // 🔥 1. Save Payment
    $payment = FeePayment::create([
        'student_id' => $student->id,
        'amount' => $amount,
        'payment_date' => now(),
        'payment_mode' => 'online',
        'remark' => 'Razorpay: ' . $paymentId,
    ]);

    // 🔥 2. Smart Allocation (same logic reuse)
    $fees = $student->monthlyFees()
        ->where('balance', '>', 0)
        ->orderBy('id', 'asc')
        ->get();

    foreach ($fees as $fee) {

        if ($amount <= 0) break;

        if ($amount >= $fee->balance) {

            $paidAmount = $fee->balance;
            $amount -= $fee->balance;

            $fee->paid += $fee->balance;
            $fee->balance = 0;

        } else {

            $paidAmount = $amount;

            $fee->paid += $amount;
            $fee->balance -= $amount;

            $amount = 0;
        }

        $fee->save();

        PaymentAllocation::create([
            'fee_payment_id' => $payment->id,
            'monthly_fee_id' => $fee->id,
            'amount' => $paidAmount
        ]);
    }

    return redirect()->route('admin.fee.receipt', $payment->id);
}





public function createOrder(Request $request)
{
    $amount = $request->amount;

    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $order = $api->order->create([
        'amount' => $amount * 100,
        'currency' => 'INR',
        'receipt' => 'receipt_' . time()
    ]);

    return response()->json([
        'order_id' => $order['id'],
        'amount' => $order['amount'],
        'key' => env('RAZORPAY_KEY')
    ]);
}


public function collection()
{
    $todayCollection = FeePayment::whereDate('created_at', today())->sum('amount');

    $totalCollection = FeePayment::sum('amount');

    $payments = FeePayment::with('student')
        ->latest()
        ->paginate(10);

    return view('admin.fees.collection', compact(
        'todayCollection',
        'totalCollection',
        'payments'
    ));
}

// public function paymentSuccess(Request $request)
// {
//     $paymentId = $request->payment_id;

//     // 🔥 Yaha tum:
//     // 1. Verify payment (important)
//     // 2. FeePayment create karo
//     // 3. Smart allocation logic run karo

//     return "Payment Success: " . $paymentId;
// }

// public function createOrder($student_id)
// {
//     $student = Student::findOrFail($student_id);

//     $amount = 1000; // dynamic karenge later

//     $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

//     $order = $api->order->create([
//         'amount' => $amount * 100, // ₹1000 = 100000 paise
//         'currency' => 'INR',
//         'receipt' => 'receipt_' . time()
//     ]);

//     return view('admin.fees.razorpay', [
//         'order_id' => $order['id'],
//         'amount' => $amount,
//         'student' => $student,
//         'key' => env('RAZORPAY_KEY')
//     ]);
// }


// public function createOrderonlie(Request $request)
// {
//     $amount = $request->amount;

//     $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

//     $order = $api->order->create([
//         'amount' => $amount * 100,
//         'currency' => 'INR',
//         'receipt' => 'receipt_' . time()
//     ]);

//     return response()->json([
//         'order_id' => $order['id'],
//         'amount' => $order['amount'],
//         'key' => env('RAZORPAY_KEY')
//     ]);
// }

// public function onlinepaymentSuccess(Request $request)
// {
//     $amount = $request->amount;

//     // 🔥 yaha tum same logic use karoge jo cash me use kiya
//     // FeePayment create + Smart Allocation

//     return "Payment Success";
// }


}
