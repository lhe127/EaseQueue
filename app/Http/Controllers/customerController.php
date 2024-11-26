<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function displayDepartment() {
        $departments = Department::all();
        return view('Customer.departmentSelection', compact('departments'));
    }
}
