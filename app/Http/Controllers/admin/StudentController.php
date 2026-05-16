<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
   public function index()
{
    $students = Student::latest()->get();
    return view('admin.students.index', compact('students'));
}

public function create()
{
    return view('admin.students.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'class' => 'required',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data['father_name'] = $request->father_name;
    $data['mobile'] = $request->mobile;
    $data['roll_no'] = $request->roll_no;
    $data['subjects'] = json_encode($request->subjects);

    $data['total_fee'] = $request->total_fee ?? 0;
    $data['paid_fee'] = $request->paid_fee ?? 0;
    $data['balance_fee'] = $data['total_fee'] - $data['paid_fee'];
     

        // ✅ PHOTO UPLOAD
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/students'), $filename);

        $data['photo'] = $filename;
    }
    Student::create($data);

    return redirect('/students')->with('success', 'Student Added Successfully');
}


// 🔥 EDIT
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    // 🔥 UPDATE
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'class' => 'required',
        ]);

        $data['father_name'] = $request->father_name;
        $data['mobile'] = $request->mobile;
        $data['roll_no'] = $request->roll_no;
        $data['subjects'] = json_encode($request->subjects);

        $data['total_fee'] = $request->total_fee ?? 0;
        $data['paid_fee'] = $request->paid_fee ?? 0;
        $data['balance_fee'] = $data['total_fee'] - $data['paid_fee'];
         
         // ✅ PHOTO UPDATE LOGIC
    // if ($request->hasFile('photo')) {

    //     // old photo delete
    //     if ($student->photo && file_exists(public_path('uploads/students/'.$student->photo))) {
    //         unlink(public_path('uploads/students/'.$student->photo));
    //     }

    //     $file = $request->file('photo');
    //     $filename = time().'.'.$file->getClientOriginalExtension();
    //     $file->move(public_path('uploads/students'), $filename);

    //     $data['photo'] = $filename;
    // }

    
        // ✅ PHOTO UPLOAD
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/students'), $filename);

        $data['photo'] = $filename;
    }
        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student Updated');
    }

    // 🔥 DELETE
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return back()->with('success', 'Student Deleted');
    }

    // admin card

    public function admitCard($id)
{
    $student = Student::findOrFail($id);
    return view('admin.students.admit-card', compact('student'));
}


//admitCardPdf
public function admitCardPdf($id)
{
    $student = Student::findOrFail($id);

    $pdf = Pdf::loadView('students.admit-card', compact('student'));

    return $pdf->download('admit-card.pdf');
}

public function pendingDues()
{
    $students = Student::where('balance_fee', '>', 0)
        ->orderBy('balance_fee', 'desc')
        ->paginate(10);

    $totalDue = Student::where('balance_fee', '>', 0)->sum('balance_fee');

    return view('admin.students.pending-dues', compact('students', 'totalDue'));
}
}

