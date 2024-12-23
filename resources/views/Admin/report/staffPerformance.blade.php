@extends('Admin.adminDashboard')

@section('content')
<div class="w-full p-4">
    <!-- Add Report Type Toggle -->
    <div class="mb-4 flex justify-end">
        <a href="{{ route('Admin.Report.adminReportDetail') }}" 
           class="px-4 py-2 mr-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
            Department Report
        </a>
        <a href="{{ route('Admin.Report.staffPerformance') }}" 
           class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
            Staff Performance
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($staffData as $staffId => $data)
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">{{ $data['name'] }}</h2>
                <canvas id="chart_{{ $staffId }}" width="400" height="200"></canvas>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    @foreach($staffData as $staffId => $data)
        new Chart(document.getElementById('chart_{{ $staffId }}').getContext('2d'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Completed Services',
                        data: @json($data['services']),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Skipped Services',
                        data: @json($data['skipped']),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    @endforeach
});
</script>
@endsection