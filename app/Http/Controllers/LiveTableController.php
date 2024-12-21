<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\QueueNumber;

use App\Models\Counter;

use App\Models\Department;

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
        // 1. 获取当前 processing 的号码，并将其状态更新为 completed
        $currentQueue = QueueNumber::where('processing_status', 'processing')->first();
        if ($currentQueue) {
            $currentQueue->processing_status = 'completed';
            $currentQueue->status = 'completed'; // You can also update the status here if needed
            $currentQueue->save();
        }

        // 2. 获取下一个 pending 的号码，并将其状态更新为 processing
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

    public function showCustomerLiveTable()
    {
        return view('monitor.customerLiveTable'); 
    }
}
