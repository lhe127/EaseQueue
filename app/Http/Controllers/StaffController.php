<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\Department;
use App\Models\QueueNumber;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('Staff.dashboard');
    }


    public function history()
    {
        return view('Staff.history');
    }
    public function schedule()
    {
        return view('Staff.schedule');
    }
    public function report()
    {
        return view('Staff.report');
    }
    public function contact()
    {
        return view('Staff.contact');
    }

    public function postContact()
    {
        if (request()->file('MCimage') != null) {
            $image = request()->file('MCimage');
            $image->move('images', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = null; // Default value if no file is uploaded
        }

        $validate = request()->validate([
            'Fdate' => 'required',
            'Tdate' => 'required',
            'Type' => 'required',
            'Reason' => 'required',
        ]);

        contact::create([
            'staffID' => auth()->id(),
            'requestType' => $validate['Type'],
            'image' => $imageName, // This will either be the uploaded image name or null
            'Fdate' => $validate['Fdate'],
            'Tdate' => $validate['Tdate'],
            'reason' => $validate['Reason'],
        ]);

        return redirect()->route('staff.home');
    }


    public function home()
    {
        return $this->showQueueNumbers();
    }

    public function nextNumber()
    {
        // Separate all queues into department by department
        $separate = QueueNumber::where('department_id', auth()->user()->department_id);


        // check if the number have a staffID to avoid conflict between two staff
        $lock = $separate->where('staffID' , auth()->id())->where('is_served', false)->first();
        $number = $separate->where('staffID', null)->first();
        if($lock){
            $currentNum = $lock;
        }
        else{
            $currentNum = $number;
        }
    
        //Take number based on the separated group
        if ($currentNum) {
            // Update the status to 'true'
            $currentNum->is_served = true;
            $currentNum->service_end_time = Carbon::now("Asia/Kuala_Lumpur");
            $currentNum->save();
        }

        return redirect("staff/home");
    }


    // public function nextNumber() {
    //     // Separate all queues into department by department
    //     $separate = QueueNumber::where('department_id', auth()->user()->department_id);

    //     // Take number based on the separated group
    //     $number = $separate->where('is_served', false)->first();

    //     if ($number) {
    //         // Store the ID of the number
    //         $numberID = $number->id;

    //         // Retrieve the record by its ID
    //         $numberToUpdate = QueueNumber::find($numberID);

    //         if ($numberToUpdate) {
    //             // Update the status to 'true'
    //             $numberToUpdate->is_served = true;
    //             $numberToUpdate->counter_id = auth()->user()->counter->id;
    //             $numberToUpdate->service_end_time = Carbon::now("Asia/Kuala_Lumpur");
    //             $numberToUpdate->save();
    //         }
    //     }

    //     return redirect("staff/home");
    // }
    public function queueNum(){
        // Get the updated list of unserved queue numbers
        $newQueueList = QueueNumber::whereNull('staffID')
                         ->where('department_id', auth()->user()->department_id)
                         ->orderBy('created_at', 'ASC')
                         ->skip(1)
                         ->paginate(5);

        
        return response()->json($newQueueList);
    }

    private function showQueueNumbers()
    {
        $departments = Department::all();

        // Separate all queues into department by department
        $separate = QueueNumber::where('department_id', auth()->user()->department_id);
        
        // check if the number have a staffID to avoid conflict between two staff
        $lock = $separate->where('staffID' , auth()->id())->where('is_served', false)->first();
        $number = QueueNumber::where('department_id', auth()->user()->department_id)
                     ->whereNull('staffID')
                     ->first();
        if($lock){
            $currentNum = $lock;
        }
        else{
            $currentNum = $number;
        }
        
        if ($currentNum) {
                    $currentNum->staffID = auth()->id();
                    $currentNum->counter_id = auth()->user()->counter->id;
                    $currentNum->service_start_time = Carbon::now("Asia/Kuala_Lumpur");
                    $currentNum->save();
                }
        // Get the updated list of unserved queue numbers
        $newQueueList = QueueNumber::whereNull('staffID')
                         ->where('department_id', auth()->user()->department_id)
                         ->orderBy('created_at', 'ASC')
                         ->skip(1)
                         ->paginate(5);

        

        return view('Staff.home', [
            'queueLists' => $newQueueList,
            'departments' => $departments,
            'number' => $currentNum,
        ]);
    }

    public function transfer(Request $request, $id)
    {
        $departmentId = $request->input('department_id');
        $number = QueueNumber::find($id);

        if ($number && $departmentId) {
            $number->department_id = $departmentId;
            $number->is_served = false;
            $number->staffID = null;
            $number->save();
        }

        return redirect('staff/home');
    }
}