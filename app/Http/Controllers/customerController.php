<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Department;
use App\Models\QueueNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

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

        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }

        // Check if the customer already has an active queue number
        $existingQueue = QueueNumber::where('customer_id', $customerId)
            ->where('is_served', false)
            ->first();

        if ($existingQueue) {
            return redirect()->route('showQueueStatus', ['queueId' => $existingQueue->id]);
        }

        // Generate a new queue number
        $baseQueueNumber = 1000 * $department->id;
        $maxQueueNumber = $baseQueueNumber + 999;

        $nextQueueNumber = QueueNumber::where('queue_number', '>=', $baseQueueNumber)
            ->where('queue_number', '<=', $maxQueueNumber)
            ->orderBy('queue_number', 'asc')
            ->pluck('queue_number')
            ->toArray();

        $queueNumber = $baseQueueNumber;
        foreach ($nextQueueNumber as $usedNumber) {
            if ($queueNumber == $usedNumber) {
                $queueNumber++;
            } else {
                break;
            }
        }

        if ($queueNumber > $maxQueueNumber) {
            return redirect()->back()->with('error', 'Queue limit reached for this department.');
        }

        // Find an available counter
        $counter = Counter::where('department_id', $department->id)->first();

        if (!$counter) {
            return redirect()->back()->with('error', 'No available counters at the moment.');
        }

        // Create the queue entry
        $queue = QueueNumber::create([
            'department_id' => $department->id,
            'counter_id' => $counter->id,
            'queue_number' => $queueNumber,
            'customer_id' => $customerId,
            'is_served' => false,
        ]);

        $estimatedWaitTime = $this->getEstimatedWaitTime($department->id, $queueNumber);
        $nowServing = $this->getNowServing($department->id);

        $counter = Counter::find($queue->counter_id);

        $isYourTurn = $queue->queue_number == $nowServing;

        $customerPhone = Auth::guard('customer')->user()->phone;

        if ($customerPhone == '+01155036823') {
            // Send a message only to this number
            $message = "Queue Number: {$queueNumber} \nDepartment: {$department->name} \nEstimated wait time: {$estimatedWaitTime} \nNow serving: {$nowServing}";
            $this->sendMessage($message);
        }

        return view('Customer.getNumber', compact('queue', 'department', 'nowServing', 'estimatedWaitTime', 'counter','isYourTurn'));
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

        $counter = Counter::find($queue->counter_id);

        $isYourTurn = $queue->queue_number == $nowServing;

        // Return the view with queue, department, and now serving data
        return view('Customer.getNumber', compact('queue', 'department', 'nowServing', 'estimatedWaitTime', 'counter','isYourTurn'));
    }

    private function getNowServing($departmentId)
    {
        // Get the first customer that is being served in the department
        $nowServing = QueueNumber::where('department_id', $departmentId)
            ->whereNotNull('staffID')
            ->where('is_served', false)
            ->orderBy('queue_number')
            ->first();

        // If no customer is being served yet, get the first in line
        if (!$nowServing) {
            $firstInLine = QueueNumber::where('department_id', $departmentId)
                ->where('is_served', false)
                ->orderBy('queue_number')
                ->first();

            return $firstInLine ? $firstInLine->queue_number : null;
        }

        return $nowServing->queue_number; // Return the queue number of the customer currently being served
    }

    private function getEstimatedWaitTime($departmentId, $queueNumber)
    {
        // Fetch the customer's queue entry
        $queue = QueueNumber::where('department_id', $departmentId)
            ->where('queue_number', $queueNumber)
            ->first();

        if (!$queue) {
            return null; // Return null if the queue entry doesn't exist
        }

        // Check if the customer is next in line
        $nextCustomer = QueueNumber::where('department_id', $departmentId)
            ->where('is_served', 0)
            ->orderBy('created_at') // Sort by created time to ensure fairness
            ->first();

        if ($nextCustomer && $nextCustomer->queue_number == $queue->queue_number) {
            return "Your Turn"; // Customer at the front of the queue
        }

        // Count customers ahead in the queue (based on created time)
        $aheadInQueue = QueueNumber::where('department_id', $departmentId)
            ->where('is_served', 0)
            ->where('created_at', '<', $queue->created_at) // Include transfer-in customers
            ->count();

        // Fetch last 5 served customers for average service time calculation
        $recentCustomers = QueueNumber::where('department_id', $departmentId)
            ->whereNotNull('service_start_time')
            ->whereNotNull('service_end_time')
            ->orderBy('service_end_time', 'desc')
            ->take(5)
            ->get();

        // Calculate average service time (default to 5 minutes if no recent data)
        $averageServiceTime = $recentCustomers->isEmpty()
            ? 5
            : $recentCustomers->avg(function ($customer) {
                $start = Carbon::parse($customer->service_start_time);
                $end = Carbon::parse($customer->service_end_time);
                return $end->diffInMinutes($start);
            });

        // Calculate total estimated wait time
        $estimatedWaitTime = $aheadInQueue * $averageServiceTime;

        // Adjust for elapsed time since the customer joined the queue
        $currentTime = Carbon::now();
        $joinedAt = Carbon::parse($queue->created_at);
        $elapsedTime = $currentTime->diffInMinutes($joinedAt);

        // Calculate dynamic wait time
        $dynamicWaitTime = max($estimatedWaitTime - $elapsedTime, 0);

        // Ensure a minimum wait time of 5 minutes if not yet served
        if ($dynamicWaitTime === 0 && !$queue->is_served) {
            $dynamicWaitTime = 5;
        }

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

    public function sendMessage($messageBody)
    {
        $sid = 'ACf67a8e06f8237213ecfefbdd2b7a1981';
        $token = 'bcd652d306dbac8aa20f4bc35d1026e2';
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:+601155036823", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => $messageBody
                )
            );
    }
    /* sms cost USD0.25
      $message = $twilio->messages
      ->create("+60197409931", // to
        array(
          "from" => "+13613093734",
          "body" => "Ease Queue:12"
        )
      );*/
    // print($message->sid);

}
