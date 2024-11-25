@extends('Admin.adminDashboard')
@section('content')

<div class="container max-w-screen-lg mx-auto">
    <div>
        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                <div class="text-gray-600">
                    <p class="font-medium text-lg">Staff Details</p>
                    <p>Please fill out all the fields.</p>
                </div>

                <div class="lg:col-span-2">
                    <form method="POST" action="{{ route('addStaff') }}">
                        @csrf
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                            <div class="md:col-span-5">
                                <label for="staffID">Staff ID</label>
                                <input type="text" name="staffID" id="staffID"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" value="{{ $staffID }}" readonly
                                    disabled required />
                            </div>

                            <!-- Name Field -->
                            <div class="md:col-span-5">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" value="{{ old('name') }}"
                                    required />
                            </div>

                            {{-- Email --}}
                            <div class="md:col-span-5">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" value="{{ old('email') }}"
                                    required />
                            </div>

                            <!-- Password Field -->
                            <div class="md:col-span-5">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" value="{{ old('password') }}"
                                    required />
                            </div>

                            <!-- Department Name Field -->
                            <div class="md:col-span-5">
                                <label for="department_id">Department</label>
                                <select name="department_id" id="department_id"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" required>
                                    <option disabled>Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ $department->id == old('department_id') ?
                                        'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Counter Name Field -->
                            <div class="md:col-span-5">
                                <label for="counter_id">Counter</label>
                                <select name="counter_id" id="counter_id"
                                    class="h-10 border rounded px-4 w-full bg-gray-50" required>
                                    <option disabled>Select Counter</option>
                                    @foreach($counters as $counter)
                                    <option data-department="{{ $counter->department_id }}" value="{{ $counter->id }}"
                                        {{ $counter->id == old('counter_id') ? 'selected' : '' }}>
                                        {{ $counter->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="md:col-span-5 text-right">
                                <div class="inline-flex items-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-600 whitespace-nowrap">
                                        Add
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const departmentSelect = document.getElementById('department_id');
        const counterSelect = document.getElementById('counter_id');
        
        // Reset the department and counter selection on page load
        departmentSelect.selectedIndex = 0;  // Set department to the default "Select Department"
        counterSelect.selectedIndex = 0;  // Set counter to the default "Select Counter"
        
        // Show or hide counters based on the selected department
        departmentSelect.addEventListener('change', function () {
            const departmentId = this.value;

            // Reset counter selection to default
            counterSelect.selectedIndex = 0;

            // Reset the counter select to the default option first
            const options = counterSelect.querySelectorAll('option[data-department]');
            options.forEach(option => {
                if (option.getAttribute('data-department') != departmentId) {
                    option.style.display = 'none';  // Hide non-matching options
                } else {
                    option.style.display = '';  // Show matching options
                }
            });
        });
    });
</script>

@endsection