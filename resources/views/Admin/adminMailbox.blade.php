@extends('Admin.adminDashboard')
@section('content')
<div class="w-[76rem] mx-auto">
    <div class="bg-white border rounded-lg shadow relative p-5">
        <h3 class="text-3xl font-semibold mb-6">Manage Requests</h3>

        <table class="table-auto w-full text-left text-sm">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2">Staff ID</th>
                    <th class="px-4 py-2">Staff Name</th>
                    <th class="px-4 py-2">Request Type</th>
                    <th class="px-4 py-2">Date (From-To)</th>
                    <th class="px-4 py-2">Reason</th>
                    <th class="px-4 py-2">Attachment</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $request->staffID }}</td>
                    <td class="px-4 py-2">{{ $request->staff->name }}</td> <!-- Ensure 'staff' relationship exists -->
                    <td class="px-4 py-2">{{ $request->requestType }}</td>
                    <td class="px-4 py-2">{{ $request->Fdate }} - {{ $request->Tdate }}</td>
                    <td class="px-4 py-2">{{ $request->reason }}</td>
                    <td class="px-4 py-2">
                        @if ($request->image)
                        <a href="{{ asset('images/' . $request->image) }}" target="_blank" class="text-blue-500 underline">View File</a>
                        @else
                        No Attachment
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <span class="{{ $request->status === 'Pending' ? 'text-yellow-500' : ($request->status === 'Approved' ? 'text-green-500' : 'text-red-500') }}">
                            {{ $request->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        @if ($request->status === 'Pending')
                        <form action="{{ route('admin.updateRequest', $request->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <button name="status" value="Approved" class="bg-green-500 text-white px-3 py-1 rounded fa fa-check" style="font-size:18px"></button>
                            <button name="status" value="Rejected" class="bg-red-500 text-white px-3 py-1 rounded fa fa-close" style="font-size:18px"></button>
                        </form>
                        @else
                        <span class="text-gray-500 italic">No Actions Available</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
