<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\FeePayment;
use App\Models\MonthlyFee;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    // public function index()
    // {
    //     $totalStudents = Student::count();

    //     $totalCollection = FeePayment::sum('amount');

    //     $todayCollection = FeePayment::whereDate('created_at', today())->sum('amount');

    //     $pendingDues = Student::where('balance_fee', '>', 0)->sum('balance_fee');

    //     $monthlyData = FeePayment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->get();

    //     return view('admin.dashboard', compact(
    //         'totalStudents',
    //         'totalCollection',
    //         'todayCollection',
    //         'pendingDues',
    //         'monthlyData'
    //     ));
    // }

    public function index()
{
    $totalStudents   = Student::count();

    $totalCollection = FeePayment::sum('amount');

    $todayCollection = FeePayment::whereDate('created_at', today())
                        ->sum('amount');

    $pendingDues     = MonthlyFee::sum('balance');

    $monthlyData = FeePayment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

    return view('admin.dashboard', compact(
        'totalStudents',
        'totalCollection',
        'todayCollection',
        'pendingDues',
        'monthlyData'
    ));
}
}