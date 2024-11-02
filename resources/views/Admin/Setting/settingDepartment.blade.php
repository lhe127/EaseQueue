@extends('Admin.adminDashboard')
@section('content')

<!-- Main Container with Updated Font -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full px-6 py-4 bg-white">
    <!-- Trigger Button for Modal -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-black">Manage Departments and Counters</h1>
        <button onclick="openModal()"
            class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700 transition duration-300 ease-in-out">
            + Add Counter
        </button>
    </div>

    <!-- Modal Structure -->
    <div id="addCounterModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-black">Add New Counter</h2>
                <button onclick="closeModal()"
                    class="text-gray-600 hover:text-black transition duration-300 ease-in-out">X</button>
            </div>
            <form action="{{ route('addNewCounter') }}" method="POST">
                @csrf
                @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="space-y-4">
                    <!-- Department Selection -->
                    <select id="departmentSelect" name="department_id" class="w-full px-4 py-2 border rounded"
                        onchange="toggleDepartmentInput(this)">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                        <option value="new">+ Add New Department</option>
                    </select>

                    <!-- New Department Input (Initially Hidden) -->
                    <input type="text" id="newDepartmentInput" name="new_department_name"
                        placeholder="New Department Name" class="w-full px-4 py-2 border rounded hidden" />

                    <!-- New Department Description Input (Initially Hidden) -->
                    <textarea id="newDepartmentDescription" name="new_department_description"
                        placeholder="Department Description" class="w-full px-4 py-2 border rounded hidden"
                        rows="3"></textarea>

                    <!-- Counter Name -->
                    <input type="text" name="counter_name" placeholder="Counter Name" required
                        class="w-full px-4 py-2 border rounded" />

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-300 ease-in-out">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 ease-in-out">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="w-full text-sm text-center text-black" style="border: 1px solid black; border-collapse: collapse;">
        <!-- Header -->
        <thead class="text-xs uppercase bg-gray-200 text-black">
            <tr>
                <th class="px-6 py-4 text-center text-lg font-semibold" style="border: 1px solid black;">Department</th>
                <th class="px-6 py-4 text-center text-lg font-semibold" style="border: 1px solid black;">Counter</th>
                <th class="px-6 py-4 text-center text-lg font-semibold" style="border: 1px solid black;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
            @if ($department->counters->isEmpty())
            <tr class="bg-white hover:bg-gray-100">
                <td colspan="2" class="px-6 py-4 text-center font-semibold text-lg text-black"
                    style="border: 1px solid black;">
                    {{ $department->name }}
                </td>
                <td class="px-6 py-4 text-center" style="border: 1px solid black;">
                    <form action="{{ route('deleteDepartment', $department->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this department?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-600 hover:text-red-800 transition duration-300 ease-in-out font-semibold">Delete</button>
                    </form>
                </td>
            </tr>
            @else
            @foreach ($department->counters as $index => $counter)
            <tr class="bg-white hover:bg-gray-100">
                @if ($loop->first)
                <td rowspan="{{ $department->counters->count() }}"
                    class="px-6 py-4 text-center font-semibold text-lg text-black" style="border: 1px solid black;">
                    {{ $department->name }}
                </td>
                @endif
                <td class="px-6 py-4 text-black text-center" style="border: 1px solid black;">{{ $counter->name }}</td>
                <td class="px-6 py-4 text-center" style="border: 1px solid black;">
                    <form action="{{ route('deleteCounter', $counter->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this counter?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-600 hover:text-red-800 transition duration-300 ease-in-out font-semibold">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
            @endforeach
        </tbody>
    </table>

</div>

<!-- Modal Toggle Script -->
<script>
    function openModal() {
        document.getElementById('addCounterModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addCounterModal').classList.add('hidden');
    }

    function toggleDepartmentInput(select) {
        const newDepartmentInput = document.getElementById('newDepartmentInput');
        const newDepartmentDescription = document.getElementById('newDepartmentDescription');
        if (select.value === 'new') {
            newDepartmentInput.classList.remove('hidden');
            newDepartmentDescription.classList.remove('hidden');
            newDepartmentInput.required = true;
            newDepartmentDescription.required = true;
            select.required = false;
        } else {
            newDepartmentInput.classList.add('hidden');
            newDepartmentDescription.classList.add('hidden');
            newDepartmentInput.required = false;
            newDepartmentDescription.required = false;
            select.required = true;
        }
    }
</script>

@endsection