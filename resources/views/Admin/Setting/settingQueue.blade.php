@extends('Admin.adminDashboard')

@section('content')
<div class="w-full max-w-2xl p-8 bg-white rounded-lg shadow-lg mx-auto">
    <h2 class="text-2xl font-bold text-center text-black mb-6">Queue Setting</h2>
    
    <!-- Limit and Limit of Call -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-sm font-medium text-black mb-2">Limit:</label>
            <select class="w-full p-3 border border-gray-300 rounded-md text-black bg-gray-100">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-black mb-2">Limit of Call:</label>
            <select class="w-full p-3 border border-gray-300 rounded-md text-black bg-gray-100">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
    </div>

    <!-- Notification Time -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-black mb-2">Notification:</label>
        <div class="flex items-center space-x-2">
            <select class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100">
                @for ($i = 0; $i < 24; $i++)
                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                @endfor
            </select>
            <span class="text-black">:</span>
            <select class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100">
                @for ($i = 0; $i < 60; $i += 5)
                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Open Hours -->
    <h3 class="text-xl font-semibold text-black mb-4">Open Hours</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-sm font-medium text-black mb-2">From:</label>
            <div class="flex items-center space-x-2">
                <select class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100">
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
                <span class="text-black">:</span>
                <select class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100">
                    @for ($i = 0; $i < 60; $i += 5)
                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-black mb-2">To:</label>
            <div class="flex items-center space-x-2">
                <select class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100">
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
                <span class="text-black">:</span>
                <select class="w-20 p-3 border border-gray-300 rounded-md text-center text-black bg-gray-100">
                    @for ($i = 0; $i < 60; $i += 5)
                        <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <!-- Update Button -->
    <button class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">Update</button>
</div>
@endsection
