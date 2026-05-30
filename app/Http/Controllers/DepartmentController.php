<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $departments = Department::where('department_name', 'LIKE', "%$search%")
                        ->paginate(5);

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        Department::create([

            'department_name' => $request->department_name,
            'hod' => $request->hod

        ]);

        return redirect('/departments');
    }

    public function edit($id)
    {
        $department = Department::find($id);

        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        $department->update([

            'department_name' => $request->department_name,
            'hod' => $request->hod

        ]);

        return redirect('/departments');
    }

    public function delete($id)
    {
        $department = Department::find($id);

        $department->delete();

        return redirect('/departments');
    }
}