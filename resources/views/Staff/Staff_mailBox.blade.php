@extends('Staff/dashboard')
@section('content')
<div class="w-[76rem] mx-auto">
    <div class="bg-white border rounded-lg shadow relative p-5">
        <h3 class="text-3xl font-semibold mb-6">Manage Requests</h3>

        <table class="table-auto w-full text-left text-sm">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2">Request Type</th>
                    <th class="px-4 py-2">Date (From-To)</th>
                    <th class="px-4 py-2">Reason</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $request->requestType }}</td>
                    <td class="px-4 py-2">{{ $request->Fdate }} - {{ $request->Tdate }}</td>
                    <td class="px-4 py-2">{{ $request->reason }}</td>
                    <td class="px-4 py-2">
                    @if($request->status == 'Rejected')
								<span class="relative inline-flex items-center justify-center px-3 py-1 font-medium text-white bg-red-600 rounded-full shadow">
									<span aria-hidden="true" class="absolute inset-0 bg-red-500 opacity-70 rounded-full"></span>
									<span class="relative">{{ $request->status }}</span>
								</span>
								@elseif($request->status == 'Approved')
								<span class="relative inline-flex items-center justify-center px-3 py-1 font-medium text-white bg-yellow-500 rounded-full shadow">
									<span aria-hidden="true" class="absolute inset-0 bg-yellow-400 opacity-70 rounded-full"></span>
									<span class="relative">{{ $request->status }}</span>
								</span>
                                @else
                                <span class="relative inline-flex items-center justify-center px-3 py-1 font-medium text-white bg-yellow-500 rounded-full shadow">
									<span aria-hidden="true" class="absolute inset-0 bg-green-400 opacity-70 rounded-full"></span>
									<span class="relative">{{ $request->status }}</span>
								</span>
					@endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
