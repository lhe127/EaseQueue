<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function home(){
        return view('Staff.home');
    }
    public function history(){
        return view('Staff.history');
    }
}
