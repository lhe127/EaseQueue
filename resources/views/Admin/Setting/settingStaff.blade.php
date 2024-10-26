@extends('Admin.adminDashboard')
@section('content')

<head>
    <style>
        table, td, th{
            border: 1px solid black
        }
    </style>
</head>

<div class="flex-1 bg-white rounded-xl shadow-lg p-6">
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
    </div>

    <div class="overflow-y-auto">
        <table class="table-auto w-full border border-slate-950">
            <thead>
                <tr class="text-left bg-gray-200">
                    <th class="px-4 py-2">Staff ID</th>
                    <th class="px-4 py-2">Staff Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>         
                <tr class="border-t">
                    <td class="px-4 py-2">1</td>
                    <td class="px-4 py-2">LHE</td>
                    <td class="px-4 py-2">
                        <a href="" class="text-blue-600 hover:text-blue-800">
                            <span class="material-icons-outlined">edit</span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection