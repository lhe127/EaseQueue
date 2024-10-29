<?php

namespace App\Http\Controllers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function home(){
        return view('Staff.home');
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
}
