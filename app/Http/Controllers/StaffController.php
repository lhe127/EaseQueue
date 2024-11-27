<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\Department;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function home(){
        $departments = Department::all();
        return view('Staff.home' , compact("departments"));
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
    public function transfer(){
        return view('Staff.transfer');
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
            'staffID' => 'required',
            'Fdate' => 'required',
            'Tdate' => 'required',
            'Type' => 'required',
            'Reason' => 'required',
        ]);
        
        contact::create([
            'staffID' => $validate['staffID'],
            'requestType' => $validate['Type'],
            'image' => $imageName, // This will either be the uploaded image name or null
            'Fdate' => $validate['Fdate'],
            'Tdate' => $validate['Tdate'],
            'reason' => $validate['Reason'],
        ]);
        
        return redirect()->route('home');
    }
}
