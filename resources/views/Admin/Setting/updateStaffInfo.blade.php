@extends('Admin.adminDashboard')

@section('content')

<div class="bg-gray-100 rounded-lg p-6 shadow-md w-full max-w-xl">
    <form action="#" method="POST" class="space-y-4">
        <div>
            <label class="flex items-center">
                <span class="w-24 text-gray-700 font-semibold">Staff ID:</span>
                <input selected="false" type="text" name="staff_id" class="flex-1 p-2 border border-gray-300 rounded-md" readonly disabled>
            </label>
            <label class="flex items-center">
                <span class="w-24 text-gray-700 font-semibold">Staff Name:</span>
                <input type="text" name="staff_name" class="flex-1 p-2 border border-gray-300 rounded-md" required>
            </label>
            <label class="flex items-center">
                <span class="w-24 text-gray-700 font-semibold">Password:</span>
                <input type="password" name="password" class="flex-1 p-2 border border-gray-300 rounded-md" required>
            </label>
            <label class="flex items-center">
                <span class="w-24 text-gray-700 font-semibold">Department:</span>
                <input type="text" name="department" class="flex-1 p-2 border border-gray-300 rounded-md" required>
            </label>
            <label class="flex items-center">
                <span class="w-24 text-gray-700 font-semibold">Counter:</span>
                <input type="text" name="counter" class="flex-1 p-2 border border-gray-300 rounded-md" required>
            </label>
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="mt-4 px-6 py-2 bg-gray-400 text-white font-semibold rounded-md shadow">Update</button>
        </div>
    </form>
</div>
@endsection