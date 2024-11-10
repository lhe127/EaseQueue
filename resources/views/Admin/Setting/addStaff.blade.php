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
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                        <div class="md:col-span-5">
                            <label for="name">Staff ID</label>
                            <input type="text" name="staffID" id="staffID" class="h-10 border rounded px-4 w-full bg-gray-50"
                                value="" readonly disabled required/>
                        </div>

                        <!-- Name Field -->
                        <div class="md:col-span-5">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="h-10 border rounded px-4 w-full bg-gray-50"
                                value="" required />
                        </div>

                        <!-- Password Field -->
                        <div class="md:col-span-5">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="h-10 border rounded px-4 w-full bg-gray-50" value="" required />
                        </div>

                        <!-- Department Name Field -->
                        <div class="md:col-span-5">
                            <label for="department_name">Department Name</label>
                            <input type="text" name="department_name" id="department_name"
                                class="h-10 border rounded px-4 w-full bg-gray-50" value="" required />
                        </div>

                        <!-- Counter Name Field -->
                        <div class="md:col-span-5">
                            <label for="counter_name">Counter Name</label>
                            <input type="text" name="counter_name" id="counter_name"
                                class="h-10 border rounded px-4 w-full bg-gray-50" value="" required />
                        </div>

                        <!-- Submit Button -->
                        <div class="md:col-span-5 text-right">
                            <div class="inline-flex items-end">
                                <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-600 whitespace-nowrap">
                                    Add
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection