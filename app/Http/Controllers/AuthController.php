<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;


class AuthController extends Controller
{
    // Show login page
    public function loginPage()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            // Fetch the authenticated user explicitly from the Staff model
            $staff = Staff::find(Auth::id()); // Fetch the authenticated staff by their ID

            // Check if the staff record was found
            if ($staff) {
                // Update the staff status to 'active'
                $staff->status = 'active';
                $staff->save();  // Save the updated status to the database

                // If the user is an admin, redirect to the admin's home page
                if ($staff->is_admin == 1) {
                    return redirect()->route('admin.adminHome');
                } else {
                    return redirect()->route('staff.home');
                }
            }
        }

        // If the login attempt fails, return back with an error message
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Show register page
    public function registerPage()
    {
        return view('auth.register');
    }

    // Handle register request
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $staffID = 'A' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $staff = Staff::create([
            'staffID' => $staffID,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_admin' => true, // Default to admin; adjust as needed
        ]);

        Auth::login($staff);

        return view('auth.login');
    }
    // Logout the user
    public function logout(Request $request)
    {
        $staff = Staff::find(Auth::id()); // Fetch the authenticated staff by their ID
        // Check if the staff record was found
        if ($staff) {
            // Update the staff status to 'active'
            $staff->status = 'inactive';
            $staff->save();
        }

        // Log the user out
        Auth::guard('staff')->logout();

        // Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login.page');
    }

    public function getIsAdminAttribute()
    {
        return Auth::user()->is_admin == 1;
    }
}
