<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Event;
use App\Models\Event;
use Illuminate\Support\Facades\Response;

class FullCalenderController extends Controller
{
    /**
     * Display the calendar view and handle AJAX requests for event data.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                         ->whereDate('end', '<=', $request->end)
                         ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('Staff.calendar');
    }

    /**
     * Handle AJAX requests to add, update, or delete events.
     */
    public function ajax(Request $request)
    {
        try {
            switch ($request->type) {
                case 'add':
                    $event = Event::create([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end'   => $request->end,
                    ]);

                    return response()->json(['success' => true, 'event' => $event, 'message' => 'Event added successfully']);
                
                case 'update':
                    $event = Event::find($request->id);
                    if ($event) {
                        $event->update([
                            'title' => $request->title,
                            'start' => $request->start,
                            'end'   => $request->end,
                        ]);
                        return response()->json(['success' => true, 'event' => $event, 'message' => 'Event updated successfully']);
                    }
                    return response()->json(['success' => false, 'message' => 'Event not found'], 404);

                case 'delete':
                    $event = Event::find($request->id);
                    if ($event) {
                        $event->delete();
                        return response()->json(['success' => true, 'message' => 'Event deleted successfully']);
                    }
                    return response()->json(['success' => false, 'message' => 'Event not found'], 404);

                default:
                    return response()->json(['success' => false, 'message' => 'Invalid action type'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
