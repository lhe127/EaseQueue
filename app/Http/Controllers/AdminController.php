<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminHome()
    {
        return view('Admin.adminHome');
    }

    public function index()
    {
        $departments = Department::with('counters')->get();
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

    public function showStaff(){
        
    }
}
