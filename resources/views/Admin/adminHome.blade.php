@extends('Admin/adminDashboard')
@section('content')

<div style="bg-gray-200; width:100%; display:flex; flex-direction:column; gap:1rem;">
    <div class="dashboard" style="display: flex; flex-wrap: wrap; gap: 1rem;">
<!-- Table -->
        <div class="staff-table-container" style="background-color:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; flex: 1;">

        <header class="px-5 py-4 border-b border-gray-100">
            <h1 class="font-bold text-gray-800" style="font-size:1.5em">Staff Status</h1>
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
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">

                        @foreach($staff as $member)
                            <tr>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                            <img class="rounded-full" src="https://via.placeholder.com/40" alt="{{ $member->name }}">
                                        </div>
                                        <div class="font-medium text-gray-800">{{ $member->name }}</div>
                                    </div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left">{{$member->department ->name }}</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="text-left font-medium">{{$member->counter ->name }}</div>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <select class="border border-gray-300 rounded px-2 py-1 w-32">
                                        <option value="available" {{ $member->status === 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="pause" {{ $member->status === 'pause' ? 'selected' : '' }}>Pause</option>
                                        <option value="services" {{ $member->status === 'services' ? 'selected' : '' }}>Services</option>
                                        <option value="break" {{ $member->status === 'break' ? 'selected' : '' }}>Break</option>
                                        <option value="offline" {{ $member->status === 'offline' ? 'selected' : '' }}>Offline</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
 
        <div class="live-table-container" style="background-color:white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; flex: 0.3;">
        <header class="px-5 py-4 border-b border-gray-100">
         <h1 class="font-bold text-gray-800" style="font-size:1.2em">Live Table</h1>
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
    .live-table-container {
        max-height: 340px; 
        padding: 2px;     
    }

    .live-table-container table {
        width: 100%;       
    }
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