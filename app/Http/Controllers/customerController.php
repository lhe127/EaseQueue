<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Department;
use App\Models\QueueNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class customerController extends Controller
{
    public function index()
    {
        // Retrieve all departments for the department selection view
        $departments = Department::all();
        return view('customer.departmentSelection', compact('departments'));
    }

    public function displayDepartment()
    {
        $departments = Department::all();
        $customerId = Auth::guard('customer')->id();

        // Check if the customer already has an active queue
        $existingQueue = QueueNumber::where('customer_id', $customerId)
            ->where('is_served', false) // The current queue is not served yet
            ->first();

        // Pass the queue details to the view
        return view('Customer.departmentSelection', compact('departments', 'existingQueue'));
    }

    public function joinQueue(Request $request, $departmentName)
    {
        $customerId = Auth::guard('customer')->id();

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

            return redirect()->route('showQueueStatus', ['queueId' => $existingQueue->id]);
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

        // Get the estimated wait time dynamically
        $estimatedWaitTime = $this->getEstimatedWaitTime($department->id, $queueNumber);

        $nowServing = $this->getNowServing($department->id);

        // Return the queue number and estimated wait time to the user
        return view('Customer.getNumber', compact('queue', 'department', 'nowServing', 'estimatedWaitTime'))->with('refresh');
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

        // Get the estimated wait time dynamically
        $estimatedWaitTime = $this->getEstimatedWaitTime($department->id, $queue->queue_number);

        // Return the view with queue, department, and now serving data
        return view('Customer.getNumber', compact('queue', 'department', 'nowServing', 'estimatedWaitTime'));
    }

    private function getNowServing($departmentId)
    {
        // Get the first customer that is being served in the department
        $nowServing = QueueNumber::where('department_id', $departmentId)
            ->whereNotNull('staffID')
            ->orderByDesc('queue_number')  // Order by queue number
            ->first();

        // If a customer is being served, return their details
        if (!is_null($nowServing)) {
            return $nowServing->queue_number; // Return the queue number of the served customer
        }

        // If no customer is being served, return the first customer in the queue
        $firstInLine = QueueNumber::where('department_id', $departmentId)
            ->orderBy('queue_number') // Order by queue number in ascending order
            ->first();

        return $firstInLine ? $firstInLine->queue_number : null; // Return first in line's queue number or null
    }

    private function getEstimatedWaitTime($departmentId, $queueNumber)
    {
        // Get the queue entry for the customer
        $queue = QueueNumber::where('department_id', $departmentId)
            ->where('queue_number', $queueNumber)
            ->first();

        if (!$queue) {
            return null;  // Return null if queue entry doesn't exist
        }

        // Get the first customer in line who has not been served
        $nextCustomer = QueueNumber::where('department_id', $departmentId)
            ->where('is_served', 0) // Only consider customers who have not been served
            ->orderBy('queue_number') // Order by queue number to get the first one
            ->first();

        // If the next customer is the one being served
        if ($nextCustomer && $nextCustomer->queue_number == $queue->queue_number) {
            return "Your Turn";  // Display "Your Turn" for the customer at the front of the queue
        }

        // Calculate the number of customers ahead in the queue
        $aheadInQueue = QueueNumber::where('department_id', $departmentId)
            ->where('queue_number', '<', $queueNumber)
            ->where('is_served', 0) // Only consider customers who have not been served
            ->count();

        // Get the last 5 served customers for average service time calculation
        $recentCustomers = QueueNumber::where('department_id', $departmentId)
            ->whereNotNull('service_start_time')  // Only consider customers with recorded service start time
            ->whereNotNull('service_end_time')    // Only consider customers with recorded service end time
            ->orderBy('service_end_time', 'desc') // Get the most recently served customers
            ->take(5)                             // Limit to the last 5 customers
            ->get();

        // Calculate the average service time for the last 5 served customers
        $averageServiceTime = $recentCustomers->avg(function ($queue) {
            // Calculate service time for each customer
            $serviceStart = Carbon::parse($queue->service_start_time);
            $serviceEnd = Carbon::parse($queue->service_end_time);

            // Return the difference in minutes
            return $serviceEnd->diffInMinutes($serviceStart);
        });

        // Default service time if no data is available
        if (!$averageServiceTime) {
            $averageServiceTime = 5;  // Default to 5 minutes if no data
        }

        // Calculate the estimated wait time in minutes (before adjusting for elapsed time)
        $estimatedWaitTime = $aheadInQueue * $averageServiceTime;

        // Get the current time and the time the customer joined the queue
        $currentTime = Carbon::now();
        $joinedAt = Carbon::parse($queue->created_at);  // Assuming 'created_at' tracks when they joined the queue

        // Calculate how much time has passed since the customer joined the queue
        $elapsedTime = $currentTime->diffInMinutes($joinedAt);

        // Reduce the estimated wait time based on elapsed time
        $dynamicWaitTime = max($estimatedWaitTime - $elapsedTime, 0);  // Ensure it doesn't go negative

        // Add 5 minutes if wait time becomes 0 and the customer has not been served
        if ($dynamicWaitTime === 0 && !$queue->is_served) {
            $dynamicWaitTime = 5;  // Add 5 minutes if not served
        }

        // Return the dynamic estimated wait time
        return ceil($dynamicWaitTime) . " minutes";
    }

    public function checkQueueStatus($queueId)
    {
        // Find the queue record
        $queue = QueueNumber::find($queueId);

        if (!$queue) {
            return response()->json(['error' => 'Queue not found'], 404);
        }

        // Fetch the department ID
        $departmentId = $queue->department_id;

        // Get the currently serving queue number
        $nowServing = $this->getNowServing($departmentId);

        // Calculate the estimated wait time
        $estimatedWaitTime = $this->getEstimatedWaitTime($departmentId, $queue->queue_number);

        // Prepare the response data
        $response = [
            'nowServing' => $nowServing ?? 'No one is being served',
            'estimatedTime' => $estimatedWaitTime,
            'staffID' => $queue->staffID,
        ];

        return response()->json($response);
    }
}
