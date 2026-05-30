<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $staff = Staff::where('name', 'LIKE', "%$search%")
                    ->paginate(5);

        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        Staff::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'role' => $request->role

        ]);

        return redirect('/staff');
    }

    public function edit($id)
    {
        $staff = Staff::find($id);

        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::find($id);

        $staff->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'role' => $request->role

        ]);

        return redirect('/staff');
    }

    public function delete($id)
    {
        $staff = Staff::find($id);

        $staff->delete();

        return redirect('/staff');
    }
}