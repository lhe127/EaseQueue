<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function adminHome()
    {
        $staff = Staff::all();
        return view('Admin.adminHome', compact('staff'));
    }

    public function index()
    {
        $departments = Department::with('counter')->get();
        return view('Admin.Setting.settingDepartment', compact('departments'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'department_id' => 'required|string',
            'new_department_name' => 'nullable|string|max:255',
            'new_department_description' => 'nullable|string|max:500',
            'counter_name' => 'required|string|max:255',
        ]);

        // Check if a new department is being added
        if ($request->department_id === 'new') {
            // Check if a department with the same name already exists
            $existingDepartment = Department::where('name', $request->new_department_name)->first();

            if ($existingDepartment) {
                return redirect()->back()->withErrors(['new_department_name' => 'A department with this name already exists.']);
            }

            // Create new department
            $department = Department::create([
                'name' => $request->new_department_name,
                'description' => $request->new_department_description,
            ]);

            // Check if the counter name already exists in the new department
            $existingCounter = Counter::where('name', $request->counter_name)
                ->where('department_id', $department->id)
                ->first();

            if ($existingCounter) {
                return redirect()->back()->withErrors(['counter_name' => 'Counter with this name already exists in the new department.']);
            }

            // Create new counter under the new department
            Counter::create([
                'name' => $request->counter_name,
                'department_id' => $department->id,
            ]);
        } else {
            // Check if the counter name already exists in the existing department
            $existingCounter = Counter::where('name', $request->counter_name)
                ->where('department_id', $request->department_id)
                ->first();

            if ($existingCounter) {
                return redirect()->back()->withErrors(['counter_name' => 'Counter with this name already exists in the selected department.']);
            }

            // Add new counter to existing department
            Counter::create([
                'name' => $request->counter_name,
                'department_id' => $request->department_id,
            ]);
        }

        return redirect()->back()->with('success', true);
    }

    public function deleteCounter($counterId)
    {
        // Find the counter by its ID and delete it
        $counter = Counter::find($counterId);

        if ($counter) {
            $counter->delete();
            return redirect()->back()->with('success', 'Counter deleted successfully.');
        }

        return redirect()->back()->with('error', 'Counter not found.');
    }

    public function deleteDepartment($departmentId)
    {
        $department = Department::find($departmentId);

        if ($department) {
            // Check if the department has any counters
            if ($department->counters->isEmpty()) {
                $department->delete();
                return redirect()->back()->with('success', 'Department deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Cannot delete department with existing counters.');
            }
        }

        return redirect()->back()->with('error', 'Department not found.');
    }

    const PREFIX = 'S';

    public function privateInfo(Request $request, $departmentId = null)
    {
        $staffID = $this->generateNewStaffID();
        $departments = Department::all();
        $departmentId = $departmentId ?? $request->input('department_id', $departments->first()?->id);

        // Fetch all counters
        $counters = Counter::all();

        return view('Admin.Setting.addStaff', compact('staffID', 'departments', 'counters'));
    }

    public function addStaff(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:staff',
        'department_id' => 'required|exists:departments,id',
        'counter_id' => 'required|exists:counters,id',
        'password' => 'required|string|min:8',
    ]);

    $staffID = $this->generateNewStaffID();

    // Save the staff details to the database
    $staff = new Staff();
    $staff->staffID = $staffID;
    $staff->name = $request->input('name');
    $staff->email = $request->input('email');
    $staff->department_id = $request->input('department_id');
    $staff->counter_id = $request->input('counter_id');
    $staff->password = Hash::make($request->input('password')); // Hash password securely
    $staff->save();

    return redirect()->route('adminSetStaff');
}

public function updateStaff(Request $request, $staffID)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:staff,email,' . $staffID . ',staffID',
        'department_id' => 'required|exists:departments,id',
        'counter_id' => 'required|exists:counters,id',
        'password' => 'nullable|string|min:8',
    ]);

    $staff = Staff::where('staffID', $staffID)->first();
    $staff->name = $request->input('name');
    $staff->email = $request->input('email');
    $staff->department_id = $request->input('department_id');
    $staff->counter_id = $request->input('counter_id');

    if ($request->filled('password')) {
        $staff->password = Hash::make($request->input('password')); // Hash password securely
    }

    $staff->save();

    return redirect()->route('adminSetStaff');
}
}
