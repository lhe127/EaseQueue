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
            $existingDepartment = Department::find($existingQueue->department_id);
            $existingDepartmentName = $existingDepartment ? $existingDepartment->name : 'Unknown Department';

            return redirect()->back()->with(
                'error',
                '<div style="text-align: justify;">' . // Add CSS for justification
                    'You already have an active queue number: ' .
                    '<strong>' . $existingQueue->queue_number . '</strong> for <strong>' . $existingDepartmentName . '</strong>.' .
                    '</div>' .
                    '<div class="mt-3 text-center">' .
                    '<a href="' . route('showQueueStatus', ['queueId' => $existingQueue->id]) . '" class="btn btn-info btn-lg text-white">' .
                    '<i class="fas fa-ticket-alt"></i> View Your Queue' .
                    '</a>' .
                    '</div>'
            );
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

        $nowServing = $this->getNowServing($department->id);

        // Return the queue number to the user
        return view('Customer.getNumber', compact('queue', 'department', 'nowServing'));
    }

    public function showQueueStatus($queueId)
    {
        // Find the queue number entry
        $queue = QueueNumber::find($queueId);

        // Check if the queue exists and the customer is the owner of the queue
        if (!$queue || $queue->customer_id != Auth::guard('customer')->id()) {
            return redirect()->route('customerHome')->with('error', 'Queue not found or unauthorized access.');
        }

        // Get the department related to the queue
        $department = Department::find($queue->department_id);

        // Get the currently serving customer in the same department
        $nowServing = $this->getNowServing($department->id);

        // Return the view with queue, department, and now serving data
        return view('Customer.getNumber', compact('queue', 'department', 'nowServing'));
    }

    private function getNowServing($departmentId)
    {
        // Get the first customer that is being served in the department
        $nowServing = QueueNumber::where('department_id', $departmentId)
            ->where('is_served', false) // Ensure not served yet
            ->orderBy('queue_number')  // Order by queue number
            ->first();

        // If a customer is being served, return their details
        if ($nowServing) {
            return $nowServing->queue_number; // Assuming the relationship is set correctly
        }

        // If no customer is being served, return null
        return null;
    }
}
