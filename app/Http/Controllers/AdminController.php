<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Counter;
use App\Models\Department;
use App\Models\QueueNumber;
use App\Models\QueueNumberArchive;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.adminDashboard');
    }

    public function adminHome()
    {
        $staff = Staff::where('staffID', 'like', 'S%')->skip(1)->paginate(5);
        $queueNumbers = QueueNumber::whereNull('staffID')->orderBy('created_at', 'ASC')->get(); // Fetch all unserved queue numbers

        return view('Admin.adminHome', ['staff' => $staff, 'queueNumbers' => $queueNumbers]);
    }

    public function fetchItems()
    {
        $queueNumbers = QueueNumber::with('department')->whereNull('staffID')->orderBy('created_at', 'ASC')->skip(1)->paginate(5);
        return response()->json($queueNumbers); //
    }

    public function index()
    {
        $departments = Department::with('counter')->get();
        return view('Admin.Setting.settingDepartment', compact('departments'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'department_id' => 'required|string',
            'new_department_name' => 'nullable|string|max:255',
            'new_department_description' => 'nullable|string|max:500',
            'counter_name' => 'required|string|max:255',
        ]);

        // Check if a new department is being added
        if ($request->department_id === 'new') {
            // Check if a department with the same name already exists
            $existingDepartment = Department::where('name', $request->new_department_name)->first();

            if ($existingDepartment) {
                return redirect()->back()->withErrors(['new_department_name' => 'A department with this name already exists.']);
            }

            // Create new department
            $department = Department::create([
                'name' => $request->new_department_name,
                'description' => $request->new_department_description,
            ]);

            // Check if the counter name already exists in the new department
            $existingCounter = Counter::where('name', $request->counter_name)
                ->where('department_id', $department->id)
                ->first();

            if ($existingCounter) {
                return redirect()->back()->withErrors(['counter_name' => 'Counter with this name already exists in the new department.']);
            }

            // Create new counter under the new department
            Counter::create([
                'name' => $request->counter_name,
                'department_id' => $department->id,
            ]);
        } else {
            // Check if the counter name already exists in the existing department
            $existingCounter = Counter::where('name', $request->counter_name)
                ->where('department_id', $request->department_id)
                ->first();

            if ($existingCounter) {
                return redirect()->back()->withErrors(['counter_name' => 'Counter with this name already exists in the selected department.']);
            }

            // Add new counter to existing department
            Counter::create([
                'name' => $request->counter_name,
                'department_id' => $request->department_id,
            ]);
        }

        return redirect()->back()->with('success', true);
    }

    public function deleteCounter($counterId)
    {
        // Find the counter by its ID and delete it
        $counter = Counter::find($counterId);

        if ($counter) {
            $counter->delete();
            return redirect()->back()->with('success', 'Counter deleted successfully.');
        }

        return redirect()->back()->with('error', 'Counter not found.');
    }

    public function deleteDepartment($departmentId)
    {
        $department = Department::find($departmentId);

        if ($department) {
            // Check if the department has any counters
            if ($department->counter->isEmpty()) {
                $department->delete();
                return redirect()->back()->with('success', 'Department deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Cannot delete department with existing counters.');
            }
        }

        return redirect()->back()->with('error', 'Department not found.');
    }

    const PREFIX = 'S';

    public function privateInfo(Request $request, $departmentId = null)
    {
        $staffID = $this->generateNewStaffID();
        $departments = Department::all();
        $departmentId = $departmentId ?? $request->input('department_id', $departments->first()?->id);

        // Fetch all counters
        $counters = Counter::all();

        return view('Admin.Setting.addStaff', compact('staffID', 'departments', 'counters'));
    }

    public function addStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff', // Adding validation for email
            'department_id' => 'required|exists:departments,id',
            'counter_id' => 'required|exists:counters,id',
            'password' => 'required|string|min:8', // Ensuring a secure password
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staffID = $this->generateNewStaffID();

        $imageName = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Get the uploaded file
            $image = $request->file('photo');

            // Generate a unique name for the photo to avoid conflicts
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Move the photo to the staff_photos directory
            $image->move(public_path('staff_photos'), $imageName);
        }

        // Save the staff details to the database
        $staff = new Staff();
        $staff->staffID = $staffID;
        $staff->name = $request->input('name');
        $staff->email = $request->input('email'); // Save the email
        $staff->department_id = $request->input('department_id');
        $staff->counter_id = $request->input('counter_id');
        $staff->password = bcrypt($request->input('password')); // Ensure passwords are stored securely
        $staff->photo = $imageName;
        $staff->save();

        return redirect()->route('adminSetStaff');
    }

    private function generateNewStaffID()
    {
        $year = date('y');

        $maxStaffID = Staff::where('staffID', 'LIKE', self::PREFIX . $year . '%')->orderBy('staffID', 'desc')->first();

        if ($maxStaffID) {
            $currentNumber = (int) substr($maxStaffID->staffID, strlen(self::PREFIX) + 2);
            $newNumber = $currentNumber + 1;
        } else {
            $newNumber = 1;
        }
        $newStaffID = self::PREFIX . $year . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newStaffID;
    }

    public function displayStaffInfo()
    {
        $allStaff = Staff::all();
        return view('Admin.Setting.settingStaff', compact('allStaff'));
    }

    public function editStaff($staffID)
    {
        $staff = Staff::where('staffID', $staffID)->first();
        $departments = Department::all(); // Assuming you need all departments for the dropdown
        $counters = Counter::all(); // Assuming you need all counters for the dropdown
        return view('Admin.Setting.updateStaffInfo', compact('staff', 'departments', 'counters'));
    }

    public function destroy($staffID)
    {
        $staff = Staff::findOrFail($staffID);

        // Delete the staff member
        $staff->delete();

        // Redirect back with a success message
        return redirect()->route('adminSetStaff');
    }


    public function updateStaff(Request $request, $staffID)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff,email,' . $staffID . ',staffID', // Email validation
            'department_id' => 'required|exists:departments,id',
            'counter_id' => 'required|exists:counters,id',
            'password' => 'nullable|string|min:8', // Password is optional during update
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Photo validation (optional)
        ]);

        // Find the staff member by their ID
        $staff = Staff::where('staffID', $staffID)->first();

        // Update staff details
        $staff->name = $request->input('name');
        $staff->email = $request->input('email'); // Update the email
        $staff->department_id = $request->input('department_id');
        $staff->counter_id = $request->input('counter_id');

        // Update the password only if it's provided
        if ($request->filled('password')) {
            $staff->password = bcrypt($request->input('password'));
        }

        // Handle photo upload if a new photo is provided
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($staff->photo && file_exists(public_path('staff_photos/' . $staff->photo))) {
                unlink(public_path('staff_photos/' . $staff->photo));
            }

            // Store the new photo and update the photo field
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('staff_photos'), $photoName);
            $staff->photo = $photoName; // Save the new photo name
        }

        // Save the staff data
        $staff->save();

        // Redirect to the staff list page
        return redirect()->route('adminSetStaff');
    }
    // Display all requests
    public function showRequests()
    {
        $requests = Contact::with('staff')->orderBy('created_at', 'desc')->get();

        return view('Admin.adminMailbox', compact('requests'));
    }

    // Update request status
    public function updateRequestStatus($id)
    {
        // Find the request by ID
        $request = Contact::findOrFail($id);

        // Get the status from the form
        $status = request('status');

        // Validate the status
        if (!in_array($status, ['Approved', 'Rejected'])) {
            return redirect()->route('adminMailbox')->with('error', 'Invalid status provided!');
        }

        // Update the status
        $request->update(['status' => $status]);

        // Redirect with a success message
        return redirect()->route('adminMailbox')->with('message', 'Request status updated successfully!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate(['status' => 'required|string']);
        $user = Auth::user(); // Ensure $user is an instance of a model
        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return redirect()->back()->with('error', 'User not found or invalid.');
        }
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('status', 'Status updated successfully!');
    }
    public function adminReportDetail()
    {
        $currentYear = date('Y');
        $departments = Department::all();
        $departmentData = [];

        foreach ($departments as $department) {
            $query = QueueNumberArchive::where('department_id', $department->id)
                ->whereYear('created_at', $currentYear);

            $services = [];
            $passes = [];

            for ($month = 1; $month <= 12; $month++) {
                $services[] = (clone $query)->whereMonth('created_at', $month)
                    ->where('status', 'active')
                    ->count();
                $passes[] = (clone $query)->whereMonth('created_at', $month)
                    ->where('status', 'absent')
                    ->count();
            }

            $departmentData[$department->id] = [
                'name' => $department->name,
                'services' => $services,
                'passes' => $passes
            ];
        }

        return view('Admin.report.adminReportDetail', compact('departmentData'));
    }

    public function staffPerformance()
    {
        try {
            $currentYear = date('Y');
            // Get all active staff members except admin
            $staffMembers = Staff::where('staffID', 'like', 'S%')->get();
            $staffData = [];

            foreach ($staffMembers as $staff) {
                $query = QueueNumberArchive::where('staffID', $staff->staffID)
                    ->whereYear('created_at', $currentYear);

                $services = [];
                $skipped = [];

                for ($month = 1; $month <= 12; $month++) {
                    // Count completed services
                    $services[] = (clone $query)->whereMonth('created_at', $month)
                        ->where('status', 'active')
                        ->count();

                    // Count skipped/absent services
                    $skipped[] = (clone $query)->whereMonth('created_at', $month)
                        ->whereIn('status', ['skip', 'absent'])
                        ->count();
                }

                $staffData[$staff->staffID] = [
                    'name' => $staff->name,
                    'services' => $services,
                    'skipped' => $skipped,
                    'department' => $staff->department ? $staff->department->name : 'N/A'
                ];
            }

            return view('Admin.report.staffPerformance', compact('staffData'));
        } catch (\Exception $e) {
            Log::error('Staff Performance Error: ' . $e->getMessage());
            return back()->with('error', 'Unable to fetch staff performance data.');
        }
    }
}
