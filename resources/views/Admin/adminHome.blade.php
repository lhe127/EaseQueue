@extends('Admin/adminDashboard')
@section('content')
<div style="bg-gray-200; width:100%; display:flex; flex-direction:column; gap:1rem;">
    <div class="dashboard" style="display: flex; flex-wrap: wrap; gap: 1rem;">
<!-- Table -->
        <div class="staff-table-container" style="background-color:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; flex: 1;">

        <header class="px-5 py-4 border-b border-gray-100">
            <h1 class="font-bold text-gray-800">Staff Status</h1>
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
                                <th class="p-4 whitespace-nowrap">
                                    <div class="font-semibold text-left">Counter</div>
                                </th>
                                <th class="p-4 whitespace-nowrap">
                                    <div class="font-semibold text-center">Status</div>
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
                                    <div class="text-center font-medium ">1</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <select class="border border-gray-300 rounded px-2 py-1 w-32">
                                    <option value="available">Available</option>
                                    <option value="pause">Pause</option>
                                    <option value="services">Services</option>
                                    <option value="break">Break</option>
                                    <option value="offline">Offline</option>
                                </select>
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
                                    <div class="text-center font-medium ">2</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <select class="border border-gray-300 rounded px-2 py-1 w-32">
                                    <option value="available">Available</option>
                                    <option value="pause">Pause</option>
                                    <option value="services">Services</option>
                                    <option value="break">Break</option>
                                    <option value="offline">Offline</option>
                                </select>
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
                                    <div class="text-center font-medium ">3</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <select class="border border-gray-300 rounded px-2 py-1 w-32">
                                    <option value="available">Available</option>
                                    <option value="pause">Pause</option>
                                    <option value="services">Services</option>
                                    <option value="break">Break</option>
                                    <option value="offline">Offline</option>
                                </select>
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
                                    <div class="text-center font-medium ">4</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <select class="border border-gray-300 rounded px-2 py-1 w-32">
                                    <option value="available">Available</option>
                                    <option value="pause">Pause</option>
                                    <option value="services">Services</option>
                                    <option value="break">Break</option>
                                    <option value="offline">Offline</option>
                                </select>
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
                                    <div class="text-center font-medium ">5</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                <select class="border border-gray-300 rounded px-2 py-1 w-32">
                                    <option value="available">Available</option>
                                    <option value="pause">Pause</option>
                                    <option value="services">Services</option>
                                    <option value="break">Break</option>
                                    <option value="offline">Offline</option>
                                </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 
        <div class="live-table-container" style="background-color:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; flex: 0.3;">
        <header class="px-5 py-4 border-b border-gray-100">
         <h1 class="font-bold text-gray-800">Live Table</h1>
     </header>
     <span class="px-5 py-4 border-b border-gray-100"> Total waiting: <strong>4</strong></span>

     <div class="p-3">
         <div class="overflow-x-auto">
             <table class="table-auto w-full">
                 <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                     <tr>
                         <th class="p-2 whitespace-nowrap ">
                             <div class="font-semibold text-left">ID</div>
                         </th>
                         <th class="p-2 whitespace-nowrap">
                             <div class="font-semibold text-left">Queue Number</div>
                         </th>
                     </tr>
                 </thead>
                 <tbody class="text-sm divide-y divide-gray-100">
                     <tr>
                         <td class="p-2 whitespace-nowrap">
                             <div class="flex items-center">
                                 <div class="font-medium text-gray-800">1</div>
                             </div>
                         </td>
                         <td class="p-2 whitespace-nowrap">
                             <div class="text-left">1001</div>
                         </td>
                     </tr>
                     <tr>
                         <td class="p-2 whitespace-nowrap">
                             <div class="flex items-center">
                                 <div class="font-medium text-gray-800">2</div>
                             </div>
                         </td>
                         <td class="p-2 whitespace-nowrap">
                             <div class="text-left">1002</div>
                         </td>
                     </tr>
                     <tr>
                         <td class="p-2 whitespace-nowrap">
                             <div class="flex items-center">
                                 <div class="font-medium text-gray-800">3</div>
                             </div>
                         </td>
                         <td class="p-2 whitespace-nowrap">
                             <div class="text-left">2001</div>
                         </td>
                     </tr>
                     <tr>
                         <td class="p-2 whitespace-nowrap">
                             <div class="flex items-center">
                                 <div class="font-medium text-gray-800">4</div>
                             </div>
                         </td>
                         <td class="p-2 whitespace-nowrap">
                             <div class="text-left">2002</div>
                         </td>
                     </tr>
                     <tr>
                         <td class="p-2 whitespace-nowrap">
                             <div class="flex items-center">
                                 <div class="font-medium text-gray-800">5</div>
                             </div>
                         </td>
                         <td class="p-2 whitespace-nowrap">
                             <div class="text-left">1003</div>
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
        .live-table-container {
            width: 30%;
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
        .staff-table-container, .live-table-container {
            width: 100%;
        }
    }
</style>
@endsection