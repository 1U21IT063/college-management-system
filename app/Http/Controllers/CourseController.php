<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $courses = Course::where('course_name', 'LIKE', "%$search%")
                    ->paginate(5);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        Course::create([

            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'duration' => $request->duration

        ]);

        return redirect('/courses');
    }

    public function edit($id)
    {
        $course = Course::find($id);

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        $course->update([

            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'duration' => $request->duration

        ]);

        return redirect('/courses');
    }

    public function delete($id)
    {
        $course = Course::find($id);

        $course->delete();

        return redirect('/courses');
    }
}