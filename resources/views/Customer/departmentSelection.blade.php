@extends('customer.shared.customerNavigation')

@section('title', 'Service Providers')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/Customer/settingDepartment.css">
</head>

<div class="container">
    <h2 class="title">Service Providers</h2>

    <!-- Show Error Message if Any -->
    @if(session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
    @endif

    <!-- Department Selection Area -->
    <div class="row">
        @foreach($departments as $department)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card department-card" data-toggle="modal" data-target="#joinQueueModal"
                data-department="{{ $department->name }}">
                <div class="card-body text-center">
                    <i class="fas {{ $department->icon }}"></i>
                    <h5>{{ $department->name }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal for Joining Queue -->
<div class="modal fade" id="joinQueueModal" tabindex="-1" role="dialog" aria-labelledby="joinQueueModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="joinQueueModalLabel">Join Queue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                @if($existingQueue)
                <h3 class="modal-question">You are already in the queue for <strong>{{ $existingQueue->department->name
                        }}</strong>.</h3>
                <p>Your queue number is <strong>{{ $existingQueue->queue_number }}</strong>.</p>
                @else
                <h3 class="modal-question">Do you want to join the queue for <span id="departmentName"></span>?</h3>
                @endif
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Cancel</button>

                @if($existingQueue)
                <!-- Button to Get Queue Number Page -->
                <a href="{{ route('showQueueStatus', ['queueId' => $existingQueue->id]) }}"
                    class="btn btn-primary btn-confirm">Queue Status</a>
                @else
                <!-- Join Queue Button -->
                <form id="joinQueueForm" method="get" action="{{ route('joinQueue', ':department') }}"
                    class="flex-form">
                    <button type="submit" class="btn btn-primary btn-confirm" id="joinQueueButton">Join Queue</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
            // When a department card is clicked, store the department name in the modal
            $('.department-card').on('click', function () {
                var department = $(this).data('department'); // Get department name from data attribute
                $('#departmentName').text(department); // Set department name in modal
                $('#joinQueueButton').data('department', department); // Store department name in button data attribute
                // Replace the form action with the correct department name
                $('#joinQueueForm').attr('action', "/joinQueue/" + encodeURIComponent(department));
            });
        });
</script>

@endsection