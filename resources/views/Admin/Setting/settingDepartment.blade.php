@extends('Admin.adminDashboard')
@section('content')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full px-0" style="font-family: 'Inter', sans-serif;">
    <table class="table-auto w-full text-sm text-left text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-600">
        <!-- Header -->
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-400">
            <tr>
                <th colspan="3" scope="col" class="px-6 py-4 text-center font-bold text-xl text-gray-800 dark:text-gray-200">
                    ADD/DELETE DEPARTMENT
                </th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 3; $i++)
                <tr class="bg-white dark:bg-gray-800 border-b border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 ease-in-out">
                    <!-- Department Cell -->
                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-black text-xl">
                        <span>Department {{$i + 1}}</span>
                    </td>
                    <!-- Counter Cell -->
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-500 text-base">
                        <span>Counter {{$i + 1}}</span>
                    </td>
                    <!-- Edit Link Cell -->
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition duration-300 ease-in-out text-lg font-semibold">Edit</a>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>

@endsection