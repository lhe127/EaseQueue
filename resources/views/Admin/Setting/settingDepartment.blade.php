@extends('Admin.adminDashboard')
@section('content')

<style>
    /* From Uiverse.io by vinodjangid07 */
    .deleteButton {
        width: 40px;
        height: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        background-color: transparent;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .deleteButton svg {
        width: 44%;
    }

    .deleteButton:hover {
        background-color: rgb(237, 56, 56);
        overflow: visible;
    }

    .bin path {
        transition: all 0.2s;
    }

    .deleteButton:hover .bin path {
        fill: #fff;
    }

    .deleteButton:active {
        transform: scale(0.98);
    }

    .tooltip {
        --tooltip-color: rgb(41, 41, 41);
        position: absolute;
        top: -40px;
        background-color: var(--tooltip-color);
        color: white;
        border-radius: 5px;
        font-size: 12px;
        padding: 8px 12px;
        font-weight: 600;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.105);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.5s;
    }

    .tooltip::before {
        position: absolute;
        width: 10px;
        height: 10px;
        transform: rotate(45deg);
        content: "";
        background-color: var(--tooltip-color);
        bottom: -10%;
    }

    .deleteButton:hover .tooltip {
        opacity: 1;
    }

    /* Center the delete button in the td */
    .deleteButtonContainer {
        display: flex;
        justify-content: center;
        /* Center horizontally */
        align-items: center;
        /* Center vertically */
        height: 100%;
        /* Make sure it takes up the full height */
    }
</style>

<!-- Main Container with Updated Font -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full px-6 py-4 bg-white">
    <!-- Trigger Button for Modal -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-black">Manage Departments and Counters</h1>
        <button onclick="openModal()"
            class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700 transition duration-300 ease-in-out">
            + Add
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
            @if ($department->counter->isEmpty())
            <tr class="bg-white hover:bg-gray-100">
                <td colspan="2" class="px-6 py-4 text-center font-semibold text-lg text-black"
                    style="border: 1px solid black;">
                    {{ $department->name }}
                </td>
                <td class="px-6 py-4 text-center" style="border: 1px solid black;">
                    <div class="deleteButtonContainer">
                        <form action="{{ route('deleteDepartment', $department->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this department?');">
                            @csrf
                            @method('DELETE')
                            <button class="deleteButton">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 50 59" class="bin">
                                    <path fill="#B5BAC1"
                                        d="M0 7.5C0 5.01472 2.01472 3 4.5 3H45.5C47.9853 3 50 5.01472 50 7.5V7.5C50 8.32843 49.3284 9 48.5 9H1.5C0.671571 9 0 8.32843 0 7.5V7.5Z">
                                    </path>
                                    <path fill="#B5BAC1"
                                        d="M17 3C17 1.34315 18.3431 0 20 0H29.3125C30.9694 0 32.3125 1.34315 32.3125 3V3H17V3Z">
                                    </path>
                                    <path fill="#B5BAC1"
                                        d="M2.18565 18.0974C2.08466 15.821 3.903 13.9202 6.18172 13.9202H43.8189C46.0976 13.9202 47.916 15.821 47.815 18.0975L46.1699 55.1775C46.0751 57.3155 44.314 59.0002 42.1739 59.0002H7.8268C5.68661 59.0002 3.92559 57.3155 3.83073 55.1775L2.18565 18.0974ZM18.0003 49.5402C16.6196 49.5402 15.5003 48.4209 15.5003 47.0402V24.9602C15.5003 23.5795 16.6196 22.4602 18.0003 22.4602C19.381 22.4602 20.5003 23.5795 20.5003 24.9602V47.0402C20.5003 48.4209 19.381 49.5402 18.0003 49.5402ZM29.5003 47.0402C29.5003 48.4209 30.6196 49.5402 32.0003 49.5402C33.381 49.5402 34.5003 48.4209 34.5003 47.0402V24.9602C34.5003 23.5795 33.381 22.4602 32.0003 22.4602C30.6196 22.4602 29.5003 23.5795 29.5003 24.9602V47.0402Z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                    <path fill="#B5BAC1" d="M2 13H48L47.6742 21.28H2.32031L2 13Z"></path>
                                </svg>

                                <span class="tooltip">Delete</span>
                            </button>
                        </form>
                    </div>
                </td>

                </form>
                </td>
            </tr>
            @else
            @foreach ($department->counter as $index => $counter)
            <tr class="bg-white hover:bg-gray-100">
                @if ($loop->first)
                <td rowspan="{{ $department->counter->count() }}"
                    class="px-6 py-4 text-center font-semibold text-lg text-black" style="border: 1px solid black;">
                    {{ $department->name }}
                </td>
                @endif
                <td class="px-6 py-4 text-black text-center" style="border: 1px solid black;">{{ $counter->name }}</td>
                <td class="px-6 py-4 text-center" style="border: 1px solid black;">
                    <div class="deleteButtonContainer">
                        <form action="{{ route('deleteCounter', $counter->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this counter?');">
                            @csrf
                            @method('DELETE')
                            <button class="deleteButton">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 50 59" class="bin">
                                    <path fill="#B5BAC1"
                                        d="M0 7.5C0 5.01472 2.01472 3 4.5 3H45.5C47.9853 3 50 5.01472 50 7.5V7.5C50 8.32843 49.3284 9 48.5 9H1.5C0.671571 9 0 8.32843 0 7.5V7.5Z">
                                    </path>
                                    <path fill="#B5BAC1"
                                        d="M17 3C17 1.34315 18.3431 0 20 0H29.3125C30.9694 0 32.3125 1.34315 32.3125 3V3H17V3Z">
                                    </path>
                                    <path fill="#B5BAC1"
                                        d="M2.18565 18.0974C2.08466 15.821 3.903 13.9202 6.18172 13.9202H43.8189C46.0976 13.9202 47.916 15.821 47.815 18.0975L46.1699 55.1775C46.0751 57.3155 44.314 59.0002 42.1739 59.0002H7.8268C5.68661 59.0002 3.92559 57.3155 3.83073 55.1775L2.18565 18.0974ZM18.0003 49.5402C16.6196 49.5402 15.5003 48.4209 15.5003 47.0402V24.9602C15.5003 23.5795 16.6196 22.4602 18.0003 22.4602C19.381 22.4602 20.5003 23.5795 20.5003 24.9602V47.0402C20.5003 48.4209 19.381 49.5402 18.0003 49.5402ZM29.5003 47.0402C29.5003 48.4209 30.6196 49.5402 32.0003 49.5402C33.381 49.5402 34.5003 48.4209 34.5003 47.0402V24.9602C34.5003 23.5795 33.381 22.4602 32.0003 22.4602C30.6196 22.4602 29.5003 23.5795 29.5003 24.9602V47.0402Z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                    <path fill="#B5BAC1" d="M2 13H48L47.6742 21.28H2.32031L2 13Z"></path>
                                </svg>
                                <span class="tooltip">Delete</span>
                            </button>
                    </div>
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