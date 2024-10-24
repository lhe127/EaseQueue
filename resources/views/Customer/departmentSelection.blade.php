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

    <style>
        body {
            background-color: #f4f4f4;
        }

        /* Department Cards */
        .card.department-card {
            cursor: pointer;
            margin: 15px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .card.department-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            height: 130px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            background-color: #ffffff;
            z-index: 1;
        }

        .card.department-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, #5161ce, #64c3e8);
            opacity: 0.1;
            z-index: 0;
            transition: opacity 0.3s ease;
        }

        .card-body>i {
            margin-bottom: 10px;
            font-size: 3em;
            color: #5161ce;
        }

        @media (max-width: 576px) {
            .card-body>i {
                font-size: 2em;
            }
        }

        h5 {
            font-size: 1.25em;
        }

        @media (max-width: 576px) {
            h5 {
                font-size: 1em;
            }
        }

        /* Redesigned Modal */
        .modal-content {
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-header {
            background-color: #5161ce;
            color: white;
            border-bottom: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-title {
            font-size: 28px;
            font-weight: 600;
        }

        .modal-header .close {
            color: white;
            opacity: 0.8;
        }

        .modal-body {
            background-color: #f4f4f4;
            padding: 30px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            text-align: center;
        }

        .modal-body h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .modal-footer {
            border-top: none;
            justify-content: center;
            padding: 20px;
        }

        .btn-primary {
            background-color: #5161ce;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #64c3e8;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
        }

        @media (max-width: 576px) {
            .modal-body h3 {
                font-size: 18px;
            }

            .modal-title {
                font-size: 24px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="title text-center my-4">Service Providers</h2>

        <!-- Department Selection Area -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card department-card" data-toggle="modal" data-target="#joinQueueModal"
                    data-department="Academic Affairs, Admission & Registration Office">
                    <div class="card-body text-center">
                        <i class="fas fa-graduation-cap"></i>
                        <h5>Academic Affairs, Admission & Registration Office</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card department-card" data-toggle="modal" data-target="#joinQueueModal"
                    data-department="Asset Management And General Affairs Office">
                    <div class="card-body text-center">
                        <i class="fas fa-building"></i>
                        <h5>Asset Management And General Affairs Office</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card department-card" data-toggle="modal" data-target="#joinQueueModal"
                    data-department="Student Recruitment Office">
                    <div class="card-body text-center">
                        <i class="fas fa-id-card"></i>
                        <h5>Student Recruitment Office</h5>
                    </div>
                </div>
            </div>
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
            var department = $(this).data('department');
            $('#departmentName').text(department);
        });

        // When the "Join Queue" button is clicked, redirect to the getNumber page
        $('#joinQueueButton').on('click', function() {
            var department = $('#departmentName').text();
            var url = "/getNumber?department=" + encodeURIComponent(department);
            window.location.href = url; // Redirect to getNumber page with department as a query parameter
        });
    });
    </script>
</body>

</html>
@endsection