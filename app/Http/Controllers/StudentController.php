<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Mark;
use App\Models\Attendance;

class StudentController extends Controller
{
    public function create()
    {
        return view('students.create');
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::where('name', 'LIKE', "%$search%")
                    ->paginate(5);

        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        Student::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'year' => $request->year

        ]);

        return redirect('/dashboard');
    }

    public function edit($id)
    {
        $student = Student::find($id);

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $student->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'year' => $request->year

        ]);

        return redirect('/students');
    }

    public function delete($id)
    {
        $student = Student::find($id);

        $student->delete();

        return redirect('/students');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        $fees = Fee::where('student_id', $id)->get();

        $marks = Mark::where('student_id', $id)->get();

        $attendance = Attendance::where('student_id', $id)->get();

        return view('students.show', compact(
            'student',
            'fees',
            'marks',
            'attendance'
        ));
    }
    public function pdf()
{
    $students = Student::all();

    $pdf = Pdf::loadView('students.pdf', compact('students'));

    return $pdf->download('students-report.pdf');
}
}