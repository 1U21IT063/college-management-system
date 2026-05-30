<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Course;
use App\Models\Department;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::count();

        $recentStudents = Student::latest()->take(5)->get();

        $staff = Staff::count();

        $courses = Course::count();

        $departments = Department::count();

        return view('dashboard', compact(
            'students',
            'staff',
            'courses',
            'departments',
            'recentStudents'
        ));
    }
}