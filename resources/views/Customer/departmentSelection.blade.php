@extends('Customer.shared.customerNavigation')
@section('title','Service Providers')
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

        .card.department-card {
            cursor: pointer;
            margin: 15px 0;
            transition: transform 0.3s ease;
        }

        .card.department-card:hover {
            transform: scale(1.05);
        }

        .card .fa {
            color: #5161ce;
            margin-bottom: 15px;
        }

        .modal-body h3 {
            font-size: 48px;
            font-weight: bold;
            color: #5161ce;
        }

        .card-body {
            height: 130px
        }

        .card-body > i {
            margin-bottom: 10px 
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center my-4">Service Providers</h2>

        <!-- Department Selection Area -->
        <div class="row">
            <div class="col-md-4">
                <div class="card department-card">
                    <div class="card-body text-center">
                        <i class="fas fa-graduation-cap fa-3x"></i>
                        <h5>Academic Affairs, Admission & Registration Office </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card department-card">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-3x"></i>
                        <h5>Asset Management And General Affairs Office</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card department-card">
                    <div class="card-body text-center">
                        <i class="fas fa-id-card fa-3x"></i>
                        <h5>Student Recruitment Office</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>

@endsection