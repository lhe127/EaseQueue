@extends('customer.shared.customerNavigation')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Customer/getNumber.css">
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
                    <p class="lead">Estimated Time:
                        <strong class="text-warning display-5" id="estimatedTime">minutes</strong>
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

    @endsection