@extends('Customer.shared.customerNavigation')
@section('title', 'History Page')

@section('content')

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            /* Light gray background for comfort */
            font-family: 'Roboto', sans-serif;
            /* Clean and modern font */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
        }

        .table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #343a40;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        .status {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 30px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .completed {
            background-color: #28a745;
            color: white;
        }

        .pending {
            background-color: #ffc107;
            color: white;
        }

        .missing {
            background-color: #dc3545;
            color: white;
        }

        /* Icons for status */
        .status i {
            margin-right: 5px;
        }

        /* Responsive adjustments */
        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                /* Stack elements vertically */
                width: 100%;
                /* Full width for each block */
                margin-bottom: 15px;
                /* Add spacing between table rows */
            }

            th {
                display: none;
                /* Hide table headers */
            }

            .table td {
                text-align: right;
                /* Align text to the right for the labels */
                position: relative;
                padding-left: 50%;
                /* Add padding to make space for labels on the left */
            }

            .table td::before {
                content: attr(data-label);
                /* Use data-label attribute as the label (like Date, Service, Status) */
                position: absolute;
                left: 15px;
                /* Position label on the left */
                font-weight: bold;
                text-align: left;
                /* Align labels to the left */
            }

            /* For the status, make sure the colors and labels are preserved */
            .status {
                display: block;
                width: auto;
                padding: 8px;
                margin-top: 5px;
                margin-bottom: 5px;
                border-radius: 20px;
                text-align: center;
            }

            .completed {
                background-color: #28a745;
                /* Green for Completed */
                color: white;
            }

            .pending {
                background-color: #ffc107;
                /* Yellow for Pending */
                color: white;
            }

            .missing {
                background-color: #dc3545;
                /* Red for Missing */
                color: white;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Queue History</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Date">2024-10-22</td>
                    <td data-label="Service">Academic Affairs</td>
                    <td data-label="Status">
                        <span class="status completed">
                            <i class="fas fa-check-circle"></i> Completed
                        </span>
                    </td>
                </tr>
                <tr>
                    <td data-label="Date">2024-10-20</td>
                    <td data-label="Service">Student Recruitment</td>
                    <td data-label="Status">
                        <span class="status pending">
                            <i class="fas fa-hourglass-half"></i> Pending
                        </span>
                    </td>
                </tr>
                <tr>
                    <td data-label="Date">2024-10-20</td>
                    <td data-label="Service">Asset Management</td>
                    <td data-label="Status">
                        <span class="status missing">
                            <i class="fas fa-times-circle"></i> Missing
                        </span>
                    </td>
                </tr>
                {{-- Add your entries here --}}
                {{-- @foreach($history as $entry)
                <tr>
                    <td data-label="Date">{{ $entry->date }}</td>
                    <td data-label="Service">{{ $entry->service }}</td>
                    <td data-label="Status">
                        <span class="status {{ strtolower($entry->status) }}">
                            {{ $entry->status }}
                        </span>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</body>

@endsection