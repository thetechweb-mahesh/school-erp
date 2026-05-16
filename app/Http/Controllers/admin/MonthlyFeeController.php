<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\MonthlyFee;

class MonthlyFeeController extends Controller
{
   public function generate()
{
    $month = date('F Y'); // April 2026

    $students = Student::all();

    foreach ($students as $student) {

        // Check duplicate
        $exists = MonthlyFee::where('student_id', $student->id)
            ->where('month', $month)
            ->exists();

        if (!$exists) {
            MonthlyFee::create([
                'student_id' => $student->id,
                'month' => $month,
                'amount' => 1000, // default fee (later dynamic karenge)
                'paid' => 0,
                'balance' => 1000,
            ]);
        }
    }

    return "Monthly Fee Generated for " . $month;
}
}
