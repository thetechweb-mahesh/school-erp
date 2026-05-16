<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FeePayment;
use App\Models\Attendance;

class StudentPanelController extends Controller
{
    // public function dashboard()
    // {
    //     $student = auth()->user()->student;

    //     return view('admin.students.dashboard', compact('student'));
    // }
public function dashboard()
{
    $student = auth()->user()->student;

    if (!$student) {
        return "Student record not linked";
    }

    return view('admin.students.dashboard', compact('student'));
}
    public function fees()
    {
        $student = auth()->user()->student;

        $payments = FeePayment::where('student_id', $student->id)
            ->latest()
            ->get();

        return view('admin.students.fees', compact('payments'));
    }

    public function attendance()
    {
        $student = auth()->user()->student;

        $attendance = Attendance::where('student_id', $student->id)
            ->latest()
            ->get();

        return view('admin.students.attendance', compact('attendance'));
    }
}