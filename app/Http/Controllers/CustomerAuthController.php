<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.customerLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
        ]);

        $customer = Customer::where('phone', $request->phone)->first();

        if ($customer) {
            Auth::guard('customer')->login($customer);
            return redirect()->route('customerHome');
        }

        return back()->withErrors(['phone' => 'Customer not found.']);
    }

    public function showRegisterForm()
    {
        return view('auth.customerRegister');
    }

    public function register(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:customers,phone|numeric',
        ]);

        $customer = Customer::create([
            'phone' => $request->phone,
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('customerHome');
    }
}