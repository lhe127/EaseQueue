@extends('Admin.adminDashboard')

@section('content')

<style>
    #alert-popup {
        position: fixed;
        top: 15%;
        /* Upper middle position */
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        background-color: #38a169;
        color: white;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        animation: fadeOut 3s forwards;
        opacity: 1;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }
</style>

<div class="w-full max-w-2xl p-8 bg-white rounded-lg shadow-lg mx-auto">

    @if (session('success'))
    <div id="alert-popup">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="text-2xl font-bold text-center text-black mb-8">Open Hours</h2>

    <form method="POST" action="{{ route('updateQueueSettings') }}">
        @csrf
        <!-- Open Hours -->
        <h3 class="text-xl font-semibold text-black mb-4">Open Hours</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
            <div>
                <label class="block text-sm font-medium text-black mb-2">From:</label>
                <div class="flex items-center space-x-2">
                    <select name="open_hour_from"
                        class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 24; $i++) <option value="{{ $i }}" {{ old('open_hour_from', explode(':',
                            $queueSetting->open_time_from ?? '00:00')[0]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2,
                            '0', STR_PAD_LEFT) }}</option>
                            @endfor
                    </select>
                    <span class="text-black">:</span>
                    <select name="open_minute_from"
                        class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 60; $i +=5) <option value="{{ $i }}" {{ old('open_minute_from', explode(':',
                            $queueSetting->open_time_from ?? '00:00')[1]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2,
                            '0', STR_PAD_LEFT) }}</option>
                            @endfor
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-black mb-2">To:</label>
                <div class="flex items-center space-x-2">
                    <select name="open_hour_to"
                        class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 24; $i++) <option value="{{ $i }}" {{ old('open_hour_to', explode(':',
                            $queueSetting->open_time_to ?? '00:00')[0]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2,
                            '0', STR_PAD_LEFT) }}</option>
                            @endfor
                    </select>
                    <span class="text-black">:</span>
                    <select name="open_minute_to"
                        class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for ($i = 0; $i < 60; $i +=5) <option value="{{ $i }}" {{ old('open_minute_to', explode(':',
                            $queueSetting->open_time_to ?? '00:00')[1]) == $i ? 'selected' : '' }}>{{ str_pad($i, 2,
                            '0', STR_PAD_LEFT) }}</option>
                            @endfor
                    </select>
                </div>
            </div>
        </div>

        <!-- Update Button -->
        <button type="submit"
            class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">Update</button>
    </form>

    <form method="POST" action="{{route('adminSettingQueue')}}" id="transferForm">
        @csrf
        <button type="button"
            class="mt-4 w-full py-3 bg-gray-600 text-white font-semibold rounded-md hover:bg-red-700 transition"
            onclick="confirmTransfer()">
            Transfer and Clear Queue Data
        </button>
    </form>

</div>

<script>
    // Function to show the confirmation alert before form submission
    function confirmTransfer() {
        const userConfirmed = confirm("Are you sure you want to transfer the queue data and clear the current queue?");
        
        if (userConfirmed) {
            // If confirmed, submit the form
            document.getElementById('transferForm').submit();
        } else {
            // If not confirmed, do nothing
            return;
        }
    }
</script>
@endsection