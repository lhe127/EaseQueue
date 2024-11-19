@extends('Admin.adminDashboard')
@section('content')

<head>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }
    </style>
</head>

<div class="flex-1 bg-white rounded-xl shadow-lg p-6">
    <div class="mb-4 flex items-center space-x-2">
        <!-- Long, responsive search input -->
        <input type="text" id="searchInput" class="form-control flex-grow" placeholder="Search" aria-label="Search">

        <!-- Fixed-width Add Staff Button -->
        <form action="{{ route('adminAddStaff') }}" method="GET">
            <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-600 whitespace-nowrap">
                + Add New Staff
            </button>
        </form>
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
            <tbody id="staffTable">
                @foreach ($allStaff as $staff)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $staff->staffID }}</td>
                    <td class="px-4 py-2">{{ $staff->name }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('updateStaffInfo', ['staffID' => $staff->staffID]) }}" class="text-blue-600 hover:text-blue-800">
                            <span class="material-icons-outlined">edit</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.getElementById('staffTable').getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toLowerCase();

            Array.from(tableRows).forEach(row => {
                const cells = row.getElementsByTagName('td');
                let match = false;
                Array.from(cells).forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(filter)) {
                        match = true;
                    }
                });

                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

@endsection
