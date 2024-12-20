@extends('Staff.dashboard')

@section('content')

<div class="w-[70rem] ml-8">
    <div>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
    <!-- Hidden elements to store the data -->
    <div id="services-data" data-services="{{ implode(',', $services) }}" style="display: none;"></div>
    <div id="passes-data" data-passes="{{ implode(',', $passes) }}" style="display: none;"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve the data from the hidden elements
        let services = document.getElementById('services-data').getAttribute('data-services').split(',').map(Number);
        let passes = document.getElementById('passes-data').getAttribute('data-passes').split(',').map(Number);

        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Num of Service',
                    backgroundColor: 'rgb(10, 186, 181)',
                    data: services,
                    borderWidth: 1
                }, {
                    label: 'Num of Pass',
                    backgroundColor: 'rgb(65, 255, 255)',
                    data: passes,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endsection