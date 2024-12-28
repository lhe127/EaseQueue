@extends('Admin.adminDashboard')

@section('content')

<div class="container max-w-screen-lg mx-auto">
    <div>
        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                <div class="text-gray-600">
                    <p class="font-medium text-lg">Staff Details</p>
                </div>
                <div class="lg:col-span-2">
                    <form method="POST" action="{{ route('updateStaff', $staff->staffID) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <!-- Staff ID Field (Read-Only) -->
                            <div class="md:col-span-5">
                                <label for="staffID">Staff ID</label>
                                <input type="text" name="staffID" id="staffID"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" value="{{ $staff->staffID }}"
                                    readonly disabled required />
                            </div>

                            <!-- Name Field -->
                            <div class="md:col-span-5">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                    class="h-10 border rounded px-4 w-full bg-gray-50"
                                    value="{{ old('name', $staff->name) }}" required />
                            </div>

                            <!-- Email Field -->
                            <div class="md:col-span-5">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="h-10 border rounded px-4 w-full bg-gray-50"
                                    value="{{ old('email', $staff->email) }}" required />
                            </div>

                            <!-- Password Field -->
                            <div class="md:col-span-5">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" value="{{ old('password') }}" />
                            </div>

                            <div class="md:col-span-5">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo"
                                    class="w-full border border-gray-300 rounded p-2" accept="image/*" />
                            </div>

                            <!-- Department Dropdown -->
                            <div class="md:col-span-5">
                                <label for="department_id">Department</label>
                                <select name="department_id" id="department_id"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" required>
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $staff->department_id)
                                        == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Counter Dropdown -->
                            <div class="md:col-span-5">
                                <label for="counter_id">Counter</label>
                                <select name="counter_id" id="counter_id"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" required>
                                    <option value="">Select Counter</option>
                                    @foreach($counters as $counter)
                                    <option data-department="{{ $counter->department_id }}" value="{{ $counter->id }}"
                                        {{ old('counter_id', $staff->counter_id) == $counter->id ? 'selected' : '' }}>
                                        {{ $counter->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-5 flex justify-end space-x-1">
                                <!-- Update Button (Inside Update Form) -->
                                <form method="POST" action="{{ route('updateStaff', $staff->staffID) }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                                        Update
                                    </button>
                                </form>

                                <!-- Delete Button (Separate Form) -->
                                <form action="{{ route('deleteStaff', $staff->staffID) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const departmentSelect = document.getElementById('department_id');
        const counterSelect = document.getElementById('counter_id');

        // Function to filter counters based on the selected department
        const filterCounters = () => {
            const departmentId = departmentSelect.value;
            const options = counterSelect.querySelectorAll('option[data-department]');

            // Show/Hide options based on department selection
            options.forEach(option => {
                if (option.getAttribute('data-department') != departmentId) {
                    option.style.display = 'none';  // Hide non-matching options
                } else {
                    option.style.display = '';  // Show matching options
                }
            });

            // Reset counter selection if it's no longer visible
            if (counterSelect.value && counterSelect.querySelector(`option[value="${counterSelect.value}"]`).style.display === 'none') {
                counterSelect.value = '';
            }
        };

        // Event listener for department selection change
        departmentSelect.addEventListener('change', filterCounters);

        // Apply filtering on page load
        filterCounters();
    });
    </script>

    @endsection