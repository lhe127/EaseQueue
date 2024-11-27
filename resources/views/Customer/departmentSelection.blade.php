@extends('customer.shared.customerNavigation')
@section('title', 'Service Providers')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/Customer/settingDepartment.css">
</head>

<body>

    <div class="container">
        <h2 class="title text-center my-4">Service Providers</h2>

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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="joinQueueModalLabel">Join Queue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Do you want to join the queue for <span id="departmentName"></span>?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="joinQueueButton">Join Queue</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // When a department card is clicked, store the department name in the modal
            $('.department-card').on('click', function() {
                var department = $(this).data('department'); // Get department name from data attribute
                console.log('Department clicked:', department); // Debugging log
                $('#departmentName').text(department); // Set department name in modal
                $('#joinQueueButton').data('department', department); // Store department name in button data attribute
            });

            // When the "Join Queue" button is clicked, redirect to the getNumber page with the department name as a query parameter
            $('#joinQueueButton').on('click', function() {
                var department = $(this).data('department'); // Get department name from button data attribute
                if (department) {
                    var url = "/getNumber?department=" + encodeURIComponent(department); // URL with department parameter
                    console.log('Redirecting to:', url); // Debugging log
                    window.location.href = url; // Redirect to getNumber page
                }
            });
        });
    </script>

</body>

</html>
@endsection

{{-- @extends('customer.shared.customerNavigation')

@section('title', 'Service Providers')

@section('content')
<div class="container">
    <h2 class="title text-center my-4">Service Providers</h2>

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

<!-- Modal -->
<div class="modal fade" id="joinQueueModal" tabindex="-1" role="dialog" aria-labelledby="joinQueueModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="joinQueueModalLabel">Join Queue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to join the queue for <span id="departmentName"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmJoinQueue">Join Queue</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#joinQueueModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var department = button.data('department');
        var modal = $(this);
        modal.find('#departmentName').text(department);

        $('#confirmJoinQueue').off('click').on('click', function () {
            window.location.href = '/queueing/' + department;
        });
    });
</script>
@endsection --}}
