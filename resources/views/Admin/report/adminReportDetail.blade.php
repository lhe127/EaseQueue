@extends('Admin/adminDashboard')
@section('content')
<div class="w-[70rem] ml-8">
    <div><h1 class="text-center" style="font-size:2em"><strong>STAFF PERFORMANCE DETAILS</strong></h1>
    <canvas id="myChart" style="background-color:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; flex: 1;"></canvas>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February',' March', 'April','May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Num of Service',
                backgroundColor: 'rgb(10, 186, 181)',
                data: [12, 19, 3, 5, 2, 3 ,12, 19, 3, 5, 2, 3],
                borderWidth: 1
            },{
                label: 'Num of Pass',
                backgroundColor: 'rgb(65 ,255 ,255)',
                data: [ 5, 2, 3 ,12, 19, 3, 5, 2, 3, 12, 19, 3],
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
</script>
@endsection