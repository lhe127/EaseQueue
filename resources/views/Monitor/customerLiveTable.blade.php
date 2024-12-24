@extends('Monitor.LiveDashboard')
@section('content')
<head>
    <style>
        @keyframes flicker {
            0% { color: red; }
            50% { color: white; }
            100% { color: red; }
        }

        .animate-flicker {
            animation: flicker 0.3s linear alternate 2;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="flex bg-gray-200 h-screen">  
    <!-- Previous Queue Table -->
    <div class="w-2/6 pt-24 pl-16 "> 
        <table class="table-auto w-full">
            <thead>
                <tr class="text-3xl font-semibold tracking-wide text-center text-gray-900 bg-gray-100 uppercase border border-gray-600">
                    <th colspan="2" class="px-4 py-3 bg-gray-300">Previous Number</th>
                </tr>
            </thead>
            <tbody id="previous-number-table-body" class="bg-white font-semibold text-xl">
                <!-- Previous queue numbers will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    <!-- Current Queue Display -->
    <div class="w-3/6">
        <div class="flex flex-col items-center justify-center pt-24 mr-10">
            <div id="currentQueueNumber" class="text-9xl py-3 font-semibold animate-flicker text-red-600">Loading...</div>
            <div id="currentDepartment" class="text-4xl py-2 font-semibold text-gray-900"></div>
            <div id="currentCounter" class="text-4xl py-2 font-semibold text-gray-900"></div>
        </div>
    </div>
    
    <div class="w-1/6"></div>
</div>

<script>
    let lastCurrentQueue = null;

    async function fetchLiveQueue() {
        try {
            const response = await fetch("{{ route('fetchLiveQueue') }}");
            const data = await response.json();

            if (!data.current) {
                console.log("No current queue data.");
                return;
            }

            const currentQueueNumber = data.current.queue_number;
            const currentCounter = data.current.counter;
            const currentDepartment = data.current.department;

            if (lastCurrentQueue === null) {
                document.getElementById('currentQueueNumber').textContent = currentQueueNumber;
                document.getElementById('currentDepartment').textContent = currentDepartment || "N/A";
                document.getElementById('currentCounter').textContent = currentCounter || "N/A";
                lastCurrentQueue = { queue_number: currentQueueNumber, counter: currentCounter };
                return;
            }

            if (currentQueueNumber !== lastCurrentQueue.queue_number) {
                const previousTableBody = document.getElementById('previous-number-table-body');

                // 限制表格最多显示 5 行
                if (previousTableBody.rows.length >= 5) {
                    previousTableBody.deleteRow(previousTableBody.rows.length - 1); // 移除最后一行 (最旧的)
                }

                const row = previousTableBody.insertRow(0);
                const numberCell = row.insertCell(0);
                const counterCell = row.insertCell(1);

                numberCell.textContent = lastCurrentQueue.queue_number;
                counterCell.textContent = lastCurrentQueue.counter;

                numberCell.classList.add("px-4", "py-3", "border", "border-gray-600", "text-center");
                counterCell.classList.add("px-4", "py-3", "border", "border-gray-600", "text-center");

                document.getElementById('currentQueueNumber').textContent = currentQueueNumber;
                document.getElementById('currentDepartment').textContent = currentDepartment || "N/A";
                document.getElementById('currentCounter').textContent = currentCounter || "N/A";
                lastCurrentQueue = { queue_number: currentQueueNumber, counter: currentCounter };
            }
        } catch (error) {
            console.error("Error fetching live queue:", error);
        }
    }

    fetchLiveQueue();
    setInterval(fetchLiveQueue, 3000);
</script>

@endsection
