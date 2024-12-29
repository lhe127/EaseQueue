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
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    let lastAnnouncedQueue = null;
    let lastCurrentQueue = null;

    const PUSHER_APP_KEY = "{{ config('broadcasting.connections.pusher.key') }}";
    const PUSHER_APP_CLUSTER = "{{ config('broadcasting.connections.pusher.options.cluster') }}";

    const pusher = new Pusher(PUSHER_APP_KEY, {
        cluster: PUSHER_APP_CLUSTER,
        encrypted: true,
    });

    // Subscribe to the channel
    const channel = pusher.subscribe('queue-updates');

    // Listen for updates
    channel.bind('queue.updated', function(data) {
        console.log('Received Pusher update:', data);
        updateQueueDisplay(data);
    });

    async function fetchLiveQueue() {
        try {
            const response = await fetch("{{ route('fetchLiveQueue') }}", {
                headers: {
                    'Cache-Control': 'no-cache',
                    'Pragma': 'no-cache'
                }
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();

            if (!data.current) {
                console.log("No current queue data.");
                return;
            }

            // Update current queue display
            updateQueueDisplay({
                queue_number: data.current.queue_number,
                counter_number: data.current.counter,
                department: data.current.department
            });

            // Update previous queues
            if (Array.isArray(data.previous)) {
                // Clear existing cards if needed
                const previousContainer = document.getElementById('previous-number-container');
                previousContainer.innerHTML = '';
                
                // Add each previous queue
                data.previous.forEach(queue => {
                    updatePreviousQueues({
                        queue_number: queue.queue_number,
                        counter_number: queue.counter
                    });
                });
            }

        } catch (error) {
            console.error("Error fetching live queue:", error);
        }
    }

    function updateQueueDisplay(data) {
        const currentQueueNumber = document.getElementById('currentQueueNumber');
        const currentCounter = document.getElementById('currentCounter');
        const currentDepartment = document.getElementById('currentDepartment');

        if (currentQueueNumber && data.queue_number) {
            currentQueueNumber.textContent = data.queue_number;
        }

        if (currentCounter && data.counter_number) {
            currentCounter.textContent = ` ${data.counter_number}`;
        }

        if (currentDepartment && data.department) {
            currentDepartment.textContent = ` ${data.department}`;
        }

        // Check if this is a new queue number for announcement
        if (lastAnnouncedQueue !== data.queue_number) {
            announceQueue(data.queue_number, data.counter_number);
            lastAnnouncedQueue = data.queue_number;
            updatePreviousQueues(data);
        }
    }

    function updatePreviousQueues(currentData) {
        const previousContainer = document.getElementById('previous-number-container');
        if (!previousContainer || !currentData.queue_number) return;

        // Check if this queue number already exists in the list
        const existingCards = previousContainer.querySelectorAll('.queue-card');
        const alreadyExists = Array.from(existingCards).some(card => 
            card.querySelector('.queue-number').textContent === currentData.queue_number.toString()
        );

        if (!alreadyExists) {
            const card = document.createElement('div');
            card.className = "bg-gray-100 border border-gray-300 rounded-lg p-4 shadow-sm flex justify-between items-center queue-card";
            card.innerHTML = `
                <div class="text-xl font-bold text-gray-800 queue-number">${currentData.queue_number}</div>
                <div class="text-sm text-gray-500">Counter: ${currentData.counter_number}</div>
            `;

            // Remove oldest card if we have 5 or more
            while (previousContainer.childElementCount >= 5) {
                previousContainer.removeChild(previousContainer.lastElementChild);
            }

            // Add new card at the beginning
            previousContainer.prepend(card);
        }
    }


    function announceQueue(queueNumber, counterNumber) {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
            const speech = new SpeechSynthesisUtterance();
            speech.text = `Queue number ${queueNumber}, please proceed to ${counterNumber}`;
            speech.lang = 'en-US';
            speech.volume = 1;
            speech.rate = 1;
            speech.pitch = 2.5;
            window.speechSynthesis.speak(speech);
        }
    }

    fetchLiveQueue();
    const refreshInterval = setInterval(fetchLiveQueue, 3000);
    
    document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        clearInterval(refreshInterval);
    } else {
        fetchLiveQueue();
        setInterval(fetchLiveQueue, 3000);
    }
});
</script>
@endsection