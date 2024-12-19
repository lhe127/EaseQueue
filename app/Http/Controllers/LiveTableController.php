<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveTableController extends Controller
{
    public function LiveDashboard()
    {
        return view('Monitor.LiveDashboard');
    }

    public function showCustomerLiveTable()
    {
        return view('monitor.customerLiveTable'); 
    }
}
