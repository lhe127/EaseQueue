@extends('Customer.shared.customerNavigation')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Customer/getNumber.css">

    <script>
        function fetchQueueStatus() {
            $(document).ready(function () {
                const queueId = @json($queue->id); // Get the queue ID dynamically from server-side
                const refreshedKey = `queue_refreshed_${queueId}`; // Unique key for refresh status
                let isUpdated = sessionStorage.getItem(refreshedKey) === 'true'; // Check refresh status
    
                if (isUpdated) return; // Stop further execution if already refreshed
    
                // Fetch queue status from the server
                $.ajax({
                    url: `/queue-status/${queueId}/check`, // Endpoint to fetch the queue status
                    method: 'GET',
                    success: function (data) {
                        // Check if the page needs to refresh due to `staffID` or other changes
                        if (data.staffID && !isUpdated) {
                            sessionStorage.setItem(refreshedKey, 'true'); // Mark as refreshed
                            location.reload(); // Reload the page
                            return;
                        }
    
                        // Update nowServing if it has changed
                        const nowServingElement = $('#nowServing');
                        if (nowServingElement.text() !== data.nowServing) {
                            nowServingElement.text(data.nowServing || 'No one is being served');
                        }
    
                        // Update estimated time dynamically
                        const estimatedTimeElement = $('#estimatedTime');
                        estimatedTimeElement.text(
                            data.nowServing === 0
                                ? 'Waiting for the first customer'
                                : data.estimatedTime || 'Calculating...'
                        );
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching queue status:', error);
                    }
                });
            });
        }
    
        // Fetch queue status every 5 seconds
        setInterval(fetchQueueStatus, 4000);
        fetchQueueStatus(); // Initial fetch
    </script>

</head>

<div class="container text-center" style="padding-top: 0">
    <h2 class="title">Queue Status</h2>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border-radius: 15px;">
                <div class="card-body">
                    <p class="lead font-weight-bold">Queue Number:</p>
                    <strong class="text-success display-4 font-weight-bold" id="queueNumber">{{ $queue->queue_number
                        }}</strong>

                    <p class="lead mt-3 font-weight-bold">Estimated Time:</p>
                    <strong class="text-warning font-weight-bold" style="font-size: 25px" id="estimatedTime">
                        @if($isYourTurn)
                        Your Turn - {{$counter->name}}
                        @else
                        {{ $estimatedWaitTime }}
                        @endif
                    </strong>

                    <hr class="my-4">

                    <p class="lead mt-3 font-weight-bold">Now Serving:</p>
                    @if($nowServing)
                    <strong class="text-danger display-4 font-weight-bold" id="nowServing">{{ $nowServing }}</strong>
                    @else
                    <strong class="text-danger display-4 font-weight-bold" id="nowServing">No one is being
                        served</strong>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection