@extends('customer/shared/customerNavigation')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<div class="container text-center my-3">
    <h2 class="queue-title my-4">Queue Status</h2>

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

<style>
    body {
        background-color: #f0f4f8;
        /* Light gray background for the page */
        font-family: 'Roboto', sans-serif;
        /* Use the Roboto font */
    }

    .queue-title {
        font-family: 'Roboto', sans-serif;
        /* Clean font */
        font-size: 2.2rem;
        /* Slightly smaller font size */
        font-weight: normal;
        /* Medium font weight for subtlety */
        color: #343a40;
        /* Dark gray color for readability */
        border-bottom: 2px solid #5161ce;
        /* Simple underline */
        padding-bottom: 10px;
        /* Space below the title */
        margin-bottom: 20px;
        /* Space below the title */
        transition: color 0.3s ease;
        /* Smooth color transition */
    }

    .queue-title:hover {
        color: #5161ce;
        /* Change color on hover for a slight effect */
    }


    .card {
        background-color: #f8f9fa;
        /* Light background for the card */
        border: none;
        /* No border for a clean look */
    }

    .card-body h4,
    .card-body h5,
    .card-body p {
        transition: transform 0.3s ease;
        /* Smooth animation on hover */
    }

    .card-body h4:hover,
    .card-body h5:hover,
    .card-body p:hover {
        transform: scale(1.05);
        /* Slightly enlarge text on hover */
    }

    .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary color */
        border: none;
        /* No border for clean look */
        transition: background-color 0.3s;
        /* Smooth color transition */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }

    hr {
        border-top: 2px solid #007bff;
        /* Blue line for the separator */
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .queue-title {
            font-size: 2rem;
            /* Slightly smaller title on mobile */
        }

        .card-body h4,
        .card-body h5 {
            font-size: 1.5rem;
            /* Adjust font sizes for smaller screens */
        }
    }
</style>

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