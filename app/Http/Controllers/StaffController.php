<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\Department;
use App\Models\QueueNumber;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('Staff.dashboard');
    }

    
    public function history(){
        return view('Staff.history');
    }
    public function schedule(){
        return view('Staff.schedule');
    }
    public function report(){
        return view('Staff.report');
    }
    public function contact(){
        return view('Staff.contact');
    }
    
    public function postContact(){
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

    
    public function home() {
        return $this->handleQueueNumbers();
    }
    
    public function nextNumber() {
        return $this->handleQueueNumbers();
    }
    
    private function handleQueueNumbers() {
        $departments = Department::all();
        
        // Separate all queues into department by department
        $separate = QueueNumber::where('department_id', auth()->user()->department_id);
        
        // Take number based on the separated group
        $number = $separate->where('is_served', false)->first();
        
        if ($number) {
            // Update the status to 'true'
            $number->is_served = true;
            $number->save();
        }
        
        // Get the updated list of unserved queue numbers
        $newQueueList = $separate->where('is_served', false)
                                 ->orderBy('created_at', 'ASC')
                                 ->paginate(5);
        
        return view('Staff.home', [
            'queueLists' => $newQueueList,
            'number' => $number,
            'departments' => $departments
        ]);
    }
    
    public function transfer(Request $request, $id) {
        $departmentId = $request->input('department_id');
        $number = QueueNumber::find($id);
    
        if ($number && $departmentId) {
            $number->department_id = $departmentId;
            $number->is_served = false;
            $number->save();
        }
    
        return redirect()->route('staff.home');
    }
}
