@extends('customer.shared.customerNavigation')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Customer/getNumber.css">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const queueId = @json($queue->id); // Get the queue ID from the server
    const refreshedKey = `queue_refreshed_${queueId}`; // Unique key for this queue's refresh status
    let lastNowServing = null; // Store the initial value of nowServing
    
    // Check if the page has already been refreshed for this queue
    let isUpdated = sessionStorage.getItem(refreshedKey) === 'true';

    function checkQueueStatus() {
        if (isUpdated) return; // Stop polling if already updated

        fetch(`/queue-status/${queueId}/check`)
            .then(response => response.json())
            .then(data => {
                if (data.staffID) {
                    // Mark as updated and refresh the page
                    isUpdated = true;
                    sessionStorage.setItem(refreshedKey, 'true'); // Store the refresh status in session storage
                    location.reload(); // Reload the page
                }
                
                // Check if 'nowServing' has changed
                if (lastNowServing !== data.nowServing) {
                    lastNowServing = data.nowServing;
                    location.reload(); // Reload the page if 'nowServing' has changed
                }
            })
            .catch(error => {
                console.error('Error fetching queue status:', error);
            });
    }

    // Poll the server every 5 seconds
    setInterval(checkQueueStatus, 5000);
});

    </script>

</head>

<div class="container text-center" style="padding-top: 0">
    <h2 class="title">Queue Status</h2>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border-radius: 15px;">
                <div class="card-body">
                    <h4 class="mb-3">Your Queue Number:
                        <strong class="text-success display-4" id="queueNumber">{{ $queue->queue_number }}</strong>
                    </h4>
                    <p class="lead">
                        Estimated Time:
                        <strong class="text-warning display-5" id="estimatedTime">
                            @if($queue->staffID)
                            Your Turn
                            @else
                            {{ $estimatedWaitTime }}
                            @endif
                        </strong>
                    </p>
                    <hr class="my-4">
                    <h5 class="text-muted">Now Serving:
                        @if($nowServing)
                        <strong class="text-danger display-4" id="nowServing">{{ $nowServing }}</strong>
                        @else
                        <strong class="text-danger display-4" id="nowServing">No one is being served</strong>
                        @endif
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection