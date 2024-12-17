@extends('Admin/adminDashboard')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Customer Live Table</h1>
    
    <!-- 实时数据表格 -->
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Date</th>
                <th class="border border-gray-300 px-4 py-2">Time</th>
                <th class="border border-gray-300 px-4 py-2">Current Queue Number</th>
                <th class="border border-gray-300 px-4 py-2">Department</th>
                <th class="border border-gray-300 px-4 py-2">Counter</th>
                <th class="border border-gray-300 px-4 py-2">Previous Queue Number</th>
                <th class="border border-gray-300 px-4 py-2">Previous Counter</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 px-4 py-2" id="date"></td>
                <td class="border border-gray-300 px-4 py-2" id="time"></td>
                <td class="border border-gray-300 px-4 py-2" id="current_queue"></td>
                <td class="border border-gray-300 px-4 py-2" id="department"></td>
                <td class="border border-gray-300 px-4 py-2" id="counter"></td>
                <td class="border border-gray-300 px-4 py-2" id="previous_queue"></td>
                <td class="border border-gray-300 px-4 py-2" id="previous_counter"></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- JavaScript for Fetching Data -->
<script>
    async function fetchLiveQueue() {
        try {
            const response = await fetch("{{ url('/fetchLiveQueue') }}"); // 使用 Laravel 路由
            const data = await response.json();

            // 填充数据
            document.getElementById('date').textContent = new Date().toLocaleDateString();
            document.getElementById('time').textContent = new Date().toLocaleTimeString();
            document.getElementById('current_queue').textContent = data.current.queue_number || 'N/A';
            document.getElementById('department').textContent = data.current.department || 'N/A';
            document.getElementById('counter').textContent = data.current.counter?.name || 'N/A';
            document.getElementById('previous_queue').textContent = data.previous.queue_number || 'N/A';
            document.getElementById('previous_counter').textContent = data.previous.counter || 'N/A';

        } catch (error) {
            console.error("Error fetching live queue data:", error);
        }
    }

    // 自动刷新数据，每 5 秒执行一次
    setInterval(fetchLiveQueue, 5000);
    fetchLiveQueue(); // 页面初次加载时执行
</script>
@endsection
