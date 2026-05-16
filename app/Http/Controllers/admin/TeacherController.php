<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
class TeacherController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count();

        return view('admin.teacher.dashboard', compact('totalStudents'));
    }

    public function students()
    {
        $students = Student::latest()->paginate(10);

        return view('admin.teacher.students', compact('students'));
    }

    
    
    //attendance function

    public function attendance()
{
    $students = Student::latest()->get();

    return view('admin.teacher.attendance', compact('students'));
}

// Attendance store function

public function storeAttendance(Request $request)
{
    $date = Carbon::today();

    foreach ($request->attendance as $student_id => $status) {

        Attendance::updateOrCreate(
            [
                'student_id' => $student_id,
                'date' => $date
            ],
            [
                'status' => $status
            ]
        );
    }

    return back()->with('success', 'Attendance saved successfully');
}



public function attendanceReport(Request $request)
{
    $month = $request->month ?? date('m');
    $year = $request->year ?? date('Y');

    $students = Student::all();

    $report = [];

    foreach ($students as $student) {

        $totalDays = Attendance::where('student_id', $student->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();

        $presentDays = Attendance::where('student_id', $student->id)
            ->where('status', 'present')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();

        $percentage = $totalDays > 0
            ? round(($presentDays / $totalDays) * 100, 2)
            : 0;

        $report[] = [
            'student' => $student,
            'total' => $totalDays,
            'present' => $presentDays,
            'percentage' => $percentage
        ];
    }

    return view('admin.teacher.attendance_report', compact('report', 'month', 'year'));
}

}