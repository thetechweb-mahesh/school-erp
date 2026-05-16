<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\FeePaymentController;
use App\Http\Controllers\admin\MonthlyFeeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\TeacherController;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Single dashboard route with name
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
// end dashboard routes


Route::middleware(['auth', 'role:teacher,admin'])
    ->prefix('teacher')
    ->group(function () {


     

    Route::get('/dashboard', [TeacherController::class, 'dashboard'])
        ->name('teacher.dashboard');

    Route::get('/students', [TeacherController::class, 'students'])
        ->name('teacher.students');

    // attendance Route
    Route::get('/attendance', [TeacherController::class, 'attendance'])
        ->name('teacher.attendance');

    Route::post('/attendance/store', [TeacherController::class, 'storeAttendance'])
        ->name('teacher.attendance.store');    
        
    Route::get('/attendance/report', [TeacherController::class, 'attendanceReport'])
        ->name('teacher.attendance.report');
});

// ✅ Auth routes
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Students CRUD
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.delete');

    Route::get('/students/{id}/admit-card', [StudentController::class, 'admitCard'])->name('students.admit');
    //admit-pdf
    
    Route::get('/students/{id}/admit-pdf', [StudentController::class, 'admitCardPdf'])->name('students.admit.pdf');
   //END admit-pdf
     //pending
    Route::get('/admin/pending-dues', [StudentController::class, 'pendingDues'])->name('students.pending');
    //pending
    
    //Razorpay
    // Route::get('/payment-success', [FeePaymentController::class, 'paymentSuccess']);
    // Route::get('/students/{id}/pay-online', [FeePaymentController::class, 'createOrder'])->name('fee.online');
    //end Razorpay
    //freepayment
    Route::get('/students/{id}/pay', [FeePaymentController::class, 'create'])->name('fee.create');
    Route::post('/students/{id}/pay', [FeePaymentController::class, 'store'])->name('fee.store');

    Route::get('/receipt/{id}', [FeePaymentController::class, 'receipt'])->name('fee.receipt');
    Route::get('/students/{id}/ledger', [FeePaymentController::class, 'ledger'])->name('students.ledger');
    
    //create-order
 // Razorpay AJAX Order
Route::post('/create-order', [FeePaymentController::class, 'createOrder'])->name('razorpay.order');


Route::get('/admin/fee-collection', [FeePaymentController::class, 'collection'])->name('fee.collection');


// Payment Success
Route::get('/payment-success', [FeePaymentController::class, 'paymentSuccess'])->name('razorpay.success');
      //end Razorpay


    //Fee receipt PDF
    Route::get('/receipt/{id}/pdf', [FeePaymentController::class, 'receiptPdf'])->name('fee.receipt.pdf');

   //monthlyfee
   Route::get('/generate-fee', [MonthlyFeeController::class, 'generate']);
   Route::get('/students/{id}/monthly-fees', [FeePaymentController::class, 'monthly'])->name('students.monthly');


    // Admin role
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return "Admin Panel";
        });
    });

});

require __DIR__.'/auth.php';