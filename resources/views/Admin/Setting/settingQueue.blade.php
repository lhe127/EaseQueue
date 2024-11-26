@extends('Admin.adminDashboard')

@section('content')
<div class="w-full max-w-2xl p-8 bg-white rounded-lg shadow-lg mx-auto">
    <h2 class="text-2xl font-bold text-center text-black mb-8">Queue Setting</h2>
    
    <form method="POST" action="{{ route('updateQueueSettings') }}">
        @csrf
        <!-- Limit and Limit of Call -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
            <div>
                <label class="block text-sm font-medium text-black mb-2">Queue Limit:</label>
                <input type="number" id="queue_limit" name="queue_limit" class="w-full p-3 border border-gray-300 rounded-md text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" step="50" min="0" value="{{ old('queue_limit', $queueSetting->queue_limit ?? '') }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-black mb-2">Limit of Call:</label>
                <select name="limit_of_call" class="w-full p-3 border border-gray-300 rounded-md text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="5" {{ old('limit_of_call', $queueSetting->limit_of_call ?? '') == 1 ? 'selected' : '' }}>1</option>
                    <option value="10" {{ old('limit_of_call', $queueSetting->limit_of_call ?? '') == 2 ? 'selected' : '' }}>2</option>
                    <option value="15" {{ old('limit_of_call', $queueSetting->limit_of_call ?? '') == 3 ? 'selected' : '' }}>3</option>
                </select>
            </div>
        </div>

        <!-- Notification Time -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-black mb-2">Notification Time:</label>
            <div class="flex items-center space-x-2">
                <select name="notification_hour" class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ $i }}" {{ old('notification_hour', explode(':', $queueSetting->notification_time ?? '00:00')[0]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
                <span class="text-black">:</span>
                <select name="notification_minute" class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @for ($i = 0; $i < 60; $i += 5)
                        <option value="{{ $i }}" {{ old('notification_minute', explode(':', $queueSetting->notification_time ?? '00:00')[1]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Open Hours -->
        <h3 class="text-xl font-semibold text-black mb-4">Open Hours</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
            <div>
                <label class="block text-sm font-medium text-black mb-2">From:</label>
                <div class="flex items-center space-x-2">
                    <select name="open_hour_from" class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 24; $i++)
                            <option value="{{ $i }}" {{ old('open_hour_from', explode(':', $queueSetting->open_time_from ?? '00:00')[0]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                    <span class="text-black">:</span>
                    <select name="open_minute_from" class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 60; $i += 5)
                            <option value="{{ $i }}" {{ old('open_minute_from', explode(':', $queueSetting->open_time_from ?? '00:00')[1]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-black mb-2">To:</label>
                <div class="flex items-center space-x-2">
                    <select name="open_hour_to" class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 24; $i++)
                            <option value="{{ $i }}" {{ old('open_hour_to', explode(':', $queueSetting->open_time_to ?? '00:00')[0]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                    <span class="text-black">:</span>
                    <select name="open_minute_to" class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 60; $i += 5)
                            <option value="{{ $i }}" {{ old('open_minute_to', explode(':', $queueSetting->open_time_to ?? '00:00')[1]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <!-- Update Button -->
        <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">Update</button>
    </form>
</div>

<!-- Modal -->
{{-- @if(session('queue_closed'))
    <div id="queueClosedModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Queue is Closed</h3>
            <p class="text-sm text-gray-500 mb-4">The queue system is currently closed. Please try again during operational hours.</p>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition" onclick="document.getElementById('queueClosedModal').style.display='none'">OK</button>
        </div>
    </div>
@endif --}}

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

        // Show modal if queue is closed
        // if ("{{ session('queue_closed') }}") {
        //     document.getElementById('queueClosedModal').style.display = 'flex';
        // }
    });
</script>
@endsection
