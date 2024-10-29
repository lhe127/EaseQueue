@extends('Admin/adminDashboard')
@section('content')
<div style="bg-gray-200; width:100%; display:flex; flex-direction:column; gap:1rem;">
    <div class="dashboard" style="display: flex; flex-wrap: wrap; gap: 1rem;">
<!-- Table -->
        <div class="staff-table-container" style="background-color:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; flex: 1;">

        <header class="px-5 py-4 border-b border-gray-100">
            <h1 class="font-bold  text-center underline decoration-double decoration-red-500" style="font-size:2em">Staff Performance Report</h1>
        </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-4 whitespace-nowrap ">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-4 whitespace-nowrap">
                                    <div class="font-semibold text-left">Department</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Counter</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Performance</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div>
                                        <div class="font-medium text-gray-800">Alex Shatov</div>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left">AARO</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left font-medium ">1</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <a class="fa-solid fa-chart-line" style="font-size: 30px" href="{{route('adminReportDetail')}}"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-06.jpg" width="40" height="40" alt="Philip Harbach"></div>
                                        <div class="font-medium text-gray-800">Philip Harbach</div>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left">AARO</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left font-medium ">2</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <a class="fa-solid fa-chart-line" style="font-size: 30px" href="{{route('adminReportDetail')}}"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-07.jpg" width="40" height="40" alt="Mirko Fisuk"></div>
                                        <div class="font-medium text-gray-800">Mirko Fisuk</div>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left">AGO</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left font-medium ">3</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <a class="fa-solid fa-chart-line" style="font-size: 30px" href="{{route('adminReportDetail')}}"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-08.jpg" width="40" height="40" alt="Olga Semklo"></div>
                                        <div class="font-medium text-gray-800">Olga Semklo</div>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left">AFO</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left font-medium ">4</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <a class="fa-solid fa-chart-line" style="font-size: 30px" href="{{route('adminReportDetail')}}"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-09.jpg" width="40" height="40" alt="Burak Long"></div>
                                        <div class="font-medium text-gray-800">Burak Long</div>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left">AFO</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left font-medium ">5</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <a class="fa-solid fa-chart-line" style="font-size: 30px" href="{{route('adminReportDetail')}}"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 
        
</div>
</div>

<style>

    @media (min-width: 992px) {
            .staff-table-container {
                width: 70%;
            }
            .dashboard {
                display: flex;
                justify-content: space-between;
            }
        }

        @media (max-width: 430px) {
            .dashboard {
                display: block;
            }
            .staff-table-container{
                width: 100%;
            }
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@endsection