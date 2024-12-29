<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\QueueNumber;

use App\Models\Counter;

use App\Models\Department;

use App\Events\QueueUpdated;


class LiveTableController extends Controller
{
    public function LiveDashboard()
    {
        return view('Monitor.LiveDashboard');
    }

    public function fetchLiveQueue()
    {
        $currentQueue = QueueNumber::with('department', 'counter')
            ->where(function ($query) { 
                $query->where('is_served', 1)
                      ->orWhereNotNull('staffID');
            })
            ->orderBy('updated_at', 'DESC')
            ->first();

            if ($currentQueue) {
                broadcast(new QueueUpdated(
                    $currentQueue->queue_number,
                    $currentQueue->counter->name
                ))->toOthers();
            }

        $previousQueues = QueueNumber::with('department', 'counter')
            ->where('is_served', 1)
            ->whereNotNull('staffID') 
            ->orderBy('updated_at', 'DESC')
            ->take(5)
            ->get();

        return response()->json([
            'current' => [
                'queue_number' => $currentQueue->queue_number ?? 'N/A',
                'department' => $currentQueue->department->name ?? 'N/A',
                'counter' => $currentQueue->counter->name ?? 'N/A',
            ],
            'previous' => $previousQueues->map(function ($queue) {
                return [
                    'queue_number' => $queue->queue_number ?? 'N/A',
                    'counter' => $queue->counter->name ?? 'N/A',
                ];
            }),
        ]);
    }


    public function nextQueue(Request $request)
    {
        $currentQueue = QueueNumber::where('processing_status', 'processing')->first();
        if ($currentQueue) {
            $currentQueue->processing_status = 'completed';
            $currentQueue->status = 'completed'; // You can also update the status here if needed
            $currentQueue->save();
        }

        $nextQueue = QueueNumber::where('processing_status', 'pending')
            ->orderBy('created_at', 'asc')
            ->first();
        if ($nextQueue) {
            $nextQueue->processing_status = 'processing';
            $nextQueue->status = 'active'; // You can also update the status here if needed
            $nextQueue->save();
        }

        return response()->json(['success' => true]);
    }

    public function updateQueue(Request $request)
    {
        $queueNumber = $request->input('queue_number');
        $counterNumber = $request->input('counter_number');
    
        // Update logic in your database or application here
    
        // Broadcast the update
        broadcast(new QueueUpdated($queueNumber, $counterNumber));
    
        return response()->json(['message' => 'Queue updated successfully']);
    }
    
    public function showCustomerLiveTable()
    {
        return view('Monitor.customerLiveTable'); 
    }
}
