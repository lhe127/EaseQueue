@extends('customer/shared/customerNavigation')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Customer/getNumber.css">
</head>

<div class="container text-center my-3">
    <h2 class="title my-4">Queue Status</h2>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border-radius: 15px;">
                <div class="card-body">
                    <h4 class="mb-3">Your Queue Number:
                        <strong class="text-success display-4" id="queueNumber">12</strong>
                    </h4>
                    <p class="lead">Estimated Time:
                        <strong class="text-warning display-5" id="estimatedTime">15 minutes</strong>
                    </p>
                    <hr class="my-4">
                    <h5 class="text-muted">Now Serving:
                        <strong class="text-danger display-4" id="nowServing">10</strong>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button class="btn btn-primary btn-lg rounded-pill px-5" id="refreshButton">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>
</div>

<script>
    document.getElementById('refreshButton').addEventListener('click', function() {
        // Simulating refresh by updating the queue number and estimated time
        const newQueueNumber = Math.floor(Math.random() * 50); // Random number for demo
        const newEstimatedTime = Math.floor(Math.random() * 30) + 1; // Random estimated time
        const nowServingNumber = newQueueNumber > 0 ? newQueueNumber - 2 : 0; // Logic to prevent negative

        // Update the displayed values
        document.getElementById('queueNumber').textContent = newQueueNumber;
        document.getElementById('estimatedTime').textContent = `${newEstimatedTime} minutes`;
        document.getElementById('nowServing').textContent = nowServingNumber;
    });
</script>

@endsection