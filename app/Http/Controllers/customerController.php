<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Department;
use App\Models\QueueNumber;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class customerController extends Controller
{
    public function displayDepartment()
    {
        $departments = Department::all();
        return view('Customer.departmentSelection', compact('departments'));
    }

    public function joinQueue(Request $request, $departmentName)
    {
        // Find the department by name
        $department = Department::where('name', $departmentName)->first();

        // Check if the department exists
        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }

        // Determine the base number for each department (e.g., 1000, 2000, 3000)
        $baseQueueNumber = 1000 * ($department->id); // This ensures each department starts from a different base (1000, 2000, 3000, etc.)

        // Generate the queue number, based on the latest queue number for the department
        $lastQueue = QueueNumber::where('department_id', $department->id)->latest()->first();
        $queueNumber = $lastQueue ? $lastQueue->queue_number + 1 : $baseQueueNumber; // Start from baseQueueNumber if no previous queue

        // Find the first available counter for the department
        $counter = Counter::where('department_id', $department->id)->first();

        if (!$counter) {
            return redirect()->back()->with('error', 'No available counters at the moment.');
        }

        // Create the queue number entry in the database
        $queue = QueueNumber::create([
            'department_id' => $department->id,
            'counter_id' => $counter->id,
            'queue_number' => $queueNumber,
            'is_served' => false, // Set as not served initially
        ]);

        // Return the queue number to the user
        return view('Customer.getNumber', compact('queue', 'department'));
    }
}
