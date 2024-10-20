<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pageController extends Controller
{
    //
    public function home(){
        return view('Customer.departmentSelection');
    }

    public function history(){
        return view('Customer.history');
    }

    public function about(){
        return view('Customer.about');
    }
}
