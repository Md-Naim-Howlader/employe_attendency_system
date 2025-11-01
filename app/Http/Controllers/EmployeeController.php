<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view("employe.index", compact("employees"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("employe.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'gender' => 'required',
            'blood_group' => 'required|string|max:5',
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);
        $employe_data = [
            'name' => $request->name,
            'employee_id' => uniqid(),
            'department' => $request->department,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'join_date' =>  now(),
        ];


        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/employees'), $photoName);
            $employe_data['photo'] = 'uploads/employees/' . $photoName;
        }

        $register_info = Employee::create($employe_data);
        if ($register_info) {
            return redirect()->back()->with('success', 'Employee added successfully!');
        } else {
            return redirect()->back()->with('error', 'Employee not inserted!');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);

        return view("employe.edit", compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'gender' => 'required',
            'blood_group' => 'required|string|max:5',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $employe_data = [
            'name' => $request->name,
            'department' => $request->department,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
        ];


        if ($request->hasFile('photo')) {
            // delete old image
            if ($employee->photo && file_exists(public_path($employee->photo))) {
                unlink(public_path($employee->photo));
            }

            // new image upload
            $photo = $request->file('photo');
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/employees'), $photoName);
            $employe_data['photo'] = 'uploads/employees/' . $photoName;
        }

        // update database
        $updated = $employee->update($employe_data);

        if ($updated) {
            return redirect()->back()->with('success', 'Employee updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Employee update failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            if ($employee->photo && file_exists(public_path($employee->photo))) {
                unlink(public_path($employee->photo));
            }
            $employee->delete();

            return redirect()->back()->with('success', 'Employee deleted successfully!');
        }
    }
}
