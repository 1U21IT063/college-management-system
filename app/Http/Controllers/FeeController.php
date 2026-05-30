<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('student')->latest()->get();

        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::all();

        return view('fees.create', compact('students'));
    }

    public function store(Request $request)
{
    $balance = $request->total_fee - $request->paid_fee;

    if($balance == 0)
    {
        $status = "Paid";
    }
    else
    {
        $status = "Pending";
    }

    Fee::create([

        'student_id' => $request->student_id,

        'total_fee' => $request->total_fee,

        'paid_fee' => $request->paid_fee,

        'balance_fee' => $balance,

        'status' => $status,

        'payment_date' => $request->payment_date

    ]);

    return redirect('/fees');
}
public function edit($id)
{
    $fee = Fee::find($id);

    $students = Student::all();

    return view('fees.edit', compact('fee', 'students'));
}

public function update(Request $request, $id)
{
    $fee = Fee::find($id);

    $balance = $request->total_fee - $request->paid_fee;

    if($balance == 0)
    {
        $status = "Paid";
    }
    else
    {
        $status = "Pending";
    }

    $fee->update([

        'student_id' => $request->student_id,

        'total_fee' => $request->total_fee,

        'paid_fee' => $request->paid_fee,

        'balance_fee' => $balance,

        'status' => $status,

        'payment_date' => $request->payment_date

    ]);

    return redirect('/fees');
}

public function delete($id)
{
    $fee = Fee::find($id);

    $fee->delete();

    return redirect('/fees');
}
public function pdf()
{
    $fees = Fee::with('student')->get();

    $pdf = Pdf::loadView('fees.pdf', compact('fees'));

    return $pdf->download('fees-report.pdf');
}
        
}