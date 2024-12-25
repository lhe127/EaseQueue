@extends('Monitor.LiveDashboard')
@section('content')

<head>
    <style>
        @keyframes flicker {
            0% {
                opacity: 0.8;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            100% {
                opacity: 0.8;
                transform: scale(1);
            }
        }

        .animate-flicker {
            animation: flicker 1.2s ease-in-out infinite;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="flex bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 h-screen">
    <!-- Previous Queue Section on the Left -->
    <div class="w-1/2 px-16 pt-16">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-4">Previous Numbers</h2>
            <div id="previous-number-container" class="space-y-4">
                <!-- Previous queue numbers will be dynamically inserted here as cards -->
            </div>
        </div>
    </div>

    <!-- Current Queue Display on the Right -->
    <div class="w-1/2 px-16 pt-16">
        <div class="bg-white rounded-lg shadow-xl p-10 text-center">
            <div id="currentQueueNumber"
                class="text-9xl py-2 font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-400 animate-flicker">
                Loading...
            </div>
            <div id="currentDepartment" class="text-2xl py-3 font-semibold text-gray-700">
                Department: Loading...
            </div>
            <div id="currentCounter" class="text-2xl py-3 font-semibold text-gray-700">
                Counter: Loading...
            </div>
        </div>
    </div>
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
                document.getElementById('currentDepartment').textContent = `Department: ${currentDepartment || "N/A"}`;
                document.getElementById('currentCounter').textContent = `Counter: ${currentCounter || "N/A"}`;
                lastCurrentQueue = { queue_number: currentQueueNumber, counter: currentCounter };
                return;
            }

            if (currentQueueNumber !== lastCurrentQueue.queue_number) {
                const previousContainer = document.getElementById('previous-number-container');

                // Limit to display a maximum of 5 previous numbers
                if (previousContainer.childElementCount >= 5) {
                    previousContainer.removeChild(previousContainer.lastElementChild); // Remove the last card (oldest)
                }

                // Create a new card for the previous number
                const card = document.createElement('div');
                card.className = "bg-gray-100 border border-gray-300 rounded-lg p-4 shadow-sm flex justify-between items-center";

                card.innerHTML = `
                    <div class="text-xl font-bold text-gray-800">${lastCurrentQueue.queue_number}</div>
                    <div class="text-sm text-gray-500">Counter: ${lastCurrentQueue.counter}</div>
                `;

                // Insert the new card at the top
                previousContainer.prepend(card);

                // Update the current queue details
                document.getElementById('currentQueueNumber').textContent = currentQueueNumber;
                document.getElementById('currentDepartment').textContent = `Department: ${currentDepartment || "N/A"}`;
                document.getElementById('currentCounter').textContent = `Counter: ${currentCounter || "N/A"}`;
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