<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {

        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {

        return view('employee.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'         => 'nullable|string|max:255',
            'last_name'          => 'nullable|string|max:255',
            'contact_no'         => 'nullable|string|max:20',
            'email'              => 'nullable|email',
            'passport_no'        => 'nullable|string|max:50',
            'issue_date'         => 'nullable|date',
            'expiry_date'        => 'nullable|date',
            'id_no'              => 'nullable|string|max:50',
            'mailing_address'    => 'nullable|string|max:500',
            'nationality'        => 'nullable|string|max:100',
            'father_name'        => 'nullable|string|max:255',
            'mother_name'        => 'nullable|string|max:255',
            'dob'                => 'nullable|date',
            'doj'                => 'nullable|date',
            'designation'        => 'nullable|string|max:100',
            'qualification'      => 'nullable|string|max:100',
            'salary'             => 'nullable|numeric',
            'bonus'             => 'nullable|numeric',
            'food_allowance'     => 'nullable|numeric',
            'transport_allowance' => 'nullable|numeric',
            'id_image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'photo'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'job_note'           => 'nullable|string|max:1000',
        ]);

        // Handle file uploads
        $idImagePath = null;
        if ($request->hasFile('id_image')) {
            $idImagePath = 'images/employees/' . time() . '_id_' . $request->file('id_image')->getClientOriginalName();
            $request->file('id_image')->move(public_path('images/employees'), $idImagePath);
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = 'images/employees/' . time() . '_photo_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('images/employees'), $photoPath);
        }

        // Create employee
        Employee::create([
            'first_name'          => $validated['first_name'],
            'last_name'           => $validated['last_name'],
            'contact_no'          => $validated['contact_no'],
            'email'               => $validated['email'],
            'passport_no'         => $validated['passport_no'],
            'issue_date'          => $validated['issue_date'],
            'expiry_date'         => $validated['expiry_date'],
            'id_no'               => $validated['id_no'],
            'mailing_address'     => $validated['mailing_address'],
            'nationality'         => $validated['nationality'],
            'father_name'         => $validated['father_name'],
            'mother_name'         => $validated['mother_name'],
            'dob'                 => $validated['dob'],
            'doj'                 => $validated['doj'],
            'designation'         => $validated['designation'],
            'qualification'       => $validated['qualification'],
            'salary'              => $validated['salary'] ?? null,
            'bonus'               => $validated['bonus'] ?? null,
            'food_allowance'      => $validated['food_allowance'] ?? null,
            'transport_allowance' => $validated['transport_allowance'] ?? null,
            'id_image'            => $idImagePath,
            'photo'               => $photoPath,
            'job_note'            => $validated['job_note'] ?? null,
        ]);

        return redirect()->route('employee.list')->with('success', 'Employee created successfully.');
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $employee = Employee::findOrFail($id);

        $data = $request->except(['id_image', 'photo']);

        if ($request->hasFile('id_image')) {
            $file = $request->file('id_image');
            $filename = time() . '_id_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/id_images'), $filename);
            $data['id_image'] = 'uploads/id_images/' . $filename;
        }

        // Handle Photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_photo_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/photos'), $filename);
            $data['photo'] = 'uploads/photos/' . $filename;
        }

        $employee->update($data);

        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->back()->with('error', 'Employee deleted successfully!');
    }

    public function toggleStatus(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->status = $request->status;
        $employee->save();

        return response()->json(['success' => true, 'new_status' => $employee->status]);
    }
}
