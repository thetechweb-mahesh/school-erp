<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\PaymentAllocation;
use Barryvdh\DomPDF\Facade\Pdf;
use Razorpay\Api\Api;
use App\Exports\FeeCollectionExport;
use Maatwebsite\Excel\Facades\Excel;

class FeePaymentController extends Controller
{
    /* =========================
        STUDENT LEDGER
    ==========================*/
    public function ledger($id)
    {
        $student = Student::with('payments')->findOrFail($id);
        return view('admin.fees.ledger', compact('student'));
    }

    /* =========================
        CREATE PAYMENT
    ==========================*/
    public function create($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.fees.create', compact('student'));
    }

    /* =========================
        STORE PAYMENT (OFFLINE)
    ==========================*/
    public function store(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_mode' => 'required'
        ]);

        $student = Student::findOrFail($id);

        $payment = FeePayment::create([
            'student_id'   => $student->id,
            'amount'       => $request->amount,
            'payment_date' => now(),
            'payment_mode' => $request->payment_mode,
            'remark'       => $request->remark,
        ]);

        $this->allocatePayment($student, $payment, $request->amount);

        return redirect()->route('fee.receipt', $payment->id);
    }

    /* =========================
        PAYMENT RECEIPT
    ==========================*/
    public function receipt($id)
    {
        $payment = FeePayment::with('student')->findOrFail($id);
        return view('admin.fees.receipt', compact('payment'));
    }

    /* =========================
        MONTHLY FEES
    ==========================*/
    public function monthly($id)
    {
        $student = Student::with('monthlyFees')->findOrFail($id);
        return view('admin.fees.monthly', compact('student'));
    }

    /* =========================
        RECEIPT PDF
    ==========================*/
    public function receiptPdf($id)
    {
        $payment = FeePayment::with('student', 'allocations.monthlyFee')->findOrFail($id);

        $pdf = Pdf::loadView('admin.fees.receipt-pdf', compact('payment'));
        return $pdf->download('receipt.pdf');
    }

    /* =========================
        RAZORPAY SUCCESS
    ==========================*/
    public function paymentSuccess(Request $request)
    {
        $student = Student::findOrFail($request->student_id);

        $payment = FeePayment::create([
            'student_id'   => $student->id,
            'amount'       => $request->amount,
            'payment_date' => now(),
            'payment_mode' => 'online',
            'remark'       => 'Razorpay: ' . $request->payment_id,
        ]);

        $this->allocatePayment($student, $payment, $request->amount);

        return redirect()->route('admin.fee.receipt', $payment->id);
    }

    /* =========================
        CREATE RAZORPAY ORDER
    ==========================*/
    public function createOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'amount' => $request->amount * 100,
            'currency' => 'INR',
            'receipt' => 'receipt_' . time()
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'amount'   => $order['amount'],
            'key'      => env('RAZORPAY_KEY')
        ]);
    }

    /* =========================
        COLLECTION (FILTER)
    ==========================*/
   public function collection(Request $request)
{
    $query = FeePayment::with('student');

    // Search by student name
    if ($request->student_name) {
        $query->whereHas('student', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->student_name . '%');
        });
    }

    // Payment mode filter
    if ($request->payment_mode) {
        $query->where('payment_mode', $request->payment_mode);
    }

    // Date filter
    if ($request->from_date) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }

    if ($request->to_date) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    $payments = $query->latest()->paginate(10);

    $todayCollection = FeePayment::whereDate('created_at', today())->sum('amount');
    $totalCollection = FeePayment::sum('amount');

    return view('admin.fees.collection', compact(
        'payments',
        'todayCollection',
        'totalCollection'
    ));
}

    /* =========================
        EXPORT EXCEL
    ==========================*/
    public function exportExcel()
    {
        return Excel::download(new FeeCollectionExport, 'fee-collection.xlsx');
    }

    /* =========================
        EXPORT PDF WITH FILTER
    ==========================*/
    public function exportPdf(Request $request)
    {
        $query = \App\Models\FeePayment::with('student');

        if ($request->student_name) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student_name . '%');
            });
        }

        $payments = $query->get();

        $pdf = Pdf::loadView('admin.fees.collection-pdf', compact('payments'));

        return $pdf->download('filtered-fee-report.pdf');
    }

    /* =========================
        🔥 COMMON PAYMENT LOGIC
    ==========================*/
    private function allocatePayment($student, $payment, $amount)
    {
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
    }
}