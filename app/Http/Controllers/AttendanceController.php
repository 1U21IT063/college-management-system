<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('attendance.index', compact('students'));
    }

    public function store(Request $request)
    {
        foreach($request->status as $student_id => $status)
        {
            Attendance::create([

                'student_id' => $student_id,
                'date' => now(),
                'status' => $status

            ]);
        }

        return redirect('/attendance');
    }
}