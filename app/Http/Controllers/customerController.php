<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Department;
use App\Models\QueueNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class customerController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('customer.departmentSelection', compact('departments'));
    }

    public function displayDepartment()
    {
        $departments = Department::all();
        return view('Customer.departmentSelection', compact('departments'));
    }

    public function joinQueue(Request $request, $departmentName)
    {
        $customerId = Auth::guard('customer')->id();
        // dd($customerId); // Get the logged-in customer

        // Find the department by name
        $department = Department::where('name', $departmentName)->first();

        // Check if the department exists
        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }

        // Check if the customer already has an active queue number
        $existingQueue = QueueNumber::where('customer_id', $customerId)
            ->where('is_served', false) // The current queue is not served yet
            ->first();

        if ($existingQueue) {
            return redirect()->back()->with('error', 'You already have an active queue number: ' . $existingQueue->queue_number);   
        }

        // Determine the base number for each department (e.g., 1000, 2000, 3000)
        $baseQueueNumber = 1000 * ($department->id); // This ensures each department starts from a different base (1000, 2000, 3000, etc.)

        // Generate the queue number, based on the latest queue number for the department
        $lastQueue = QueueNumber::where('department_id', $department->id)->latest()->first();
        $queueNumber = $lastQueue ? $lastQueue->queue_number + 1 : $baseQueueNumber;

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
            'customer_id' => $customerId,
            'is_served' => false, // Set as not served initially
        ]);

        // Return the queue number to the user
        return view('Customer.getNumber', compact('queue', 'department'));
    }
}
