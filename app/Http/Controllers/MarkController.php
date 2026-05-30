<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mark;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class MarkController extends Controller
{
    public function index()
    {
        $marks = Mark::with('student')->get();

        return view('marks.index', compact('marks'));
    }

    public function create()
    {
        $students = Student::all();

        return view('marks.create', compact('students'));
    }

    public function store(Request $request)
    {
        $total = $request->internal_mark + $request->external_mark;

        if ($total >= 90) {
            $grade = 'A+';
        } elseif ($total >= 75) {
            $grade = 'A';
        } elseif ($total >= 60) {
            $grade = 'B';
        } elseif ($total >= 50) {
            $grade = 'C';
        } else {
            $grade = 'F';
        }

        Mark::create([
            'student_id' => $request->student_id,
            'subject' => $request->subject,
            'internal_mark' => $request->internal_mark,
            'external_mark' => $request->external_mark,
            'total_mark' => $total,
            'grade' => $grade,
        ]);

        return redirect('/marks');
    }
    public function edit($id)
{
    $mark = Mark::find($id);

    $students = Student::all();

    return view('marks.edit', compact('mark','students'));
}

public function update(Request $request, $id)
{
    $mark = Mark::find($id);

    $total = $request->internal_mark + $request->external_mark;

    if ($total >= 90) {
        $grade = 'A+';
    } elseif ($total >= 75) {
        $grade = 'A';
    } elseif ($total >= 60) {
        $grade = 'B';
    } elseif ($total >= 50) {
        $grade = 'C';
    } else {
        $grade = 'F';
    }

    $mark->update([
        'student_id' => $request->student_id,
        'subject' => $request->subject,
        'internal_mark' => $request->internal_mark,
        'external_mark' => $request->external_mark,
        'total_mark' => $total,
        'grade' => $grade,
    ]);

    return redirect('/marks');
}

public function delete($id)
{
    Mark::find($id)->delete();

    return redirect('/marks');
}
public function pdf()
{
    $marks = Mark::with('student')->get();

    $pdf = Pdf::loadView('marks.pdf', compact('marks'));

    return $pdf->download('marks-report.pdf');
}
}