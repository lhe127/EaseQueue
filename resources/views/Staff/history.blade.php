@extends('Staff/dashboard')
@section('content')
<div class="bg-white p-8 rounded-md w-[74rem]">
	<div class="flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold ml-[2rem] text-3xl">Queue History</h2>
		</div>
		<div class="flex items-center justify-between">
		</div>
	</div>
	<div>
		<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-2 overflow-x-auto">
			<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
				<table class="min-w-full leading-normal">
					<thead>
						<tr>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								ID
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Queue Number
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Phone Number
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								FCall
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								LCall
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Status
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($queueNumbers as $queueNumber)
						<tr>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								<div class="flex items-center">
									<div class="ml-3">
										<p class="text-gray-900 whitespace-no-wrap">
											{{ $queueNumber->id }}
										</p>
									</div>
								</div>
							</td>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								<p class="text-gray-900 whitespace-no-wrap">{{ $queueNumber->queue_number }}</p>
							</td>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								<p class="text-gray-900 whitespace-no-wrap">{{ $queueNumber->customer->phone }}</p>
							</td>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								<p class="text-gray-900 whitespace-no-wrap">{{ $queueNumber->service_start_time }}</p>
							</td>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								<p class="text-gray-900 whitespace-no-wrap">{{ $queueNumber->service_end_time }}</p>
							</td>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								@if($queueNumber->status == 'absent')
								<span class="relative inline-flex items-center justify-center px-3 py-1 font-medium text-white bg-red-600 rounded-full shadow">
									<span aria-hidden="true" class="absolute inset-0 bg-red-500 opacity-70 rounded-full"></span>
									<span class="relative">{{ $queueNumber->status }}</span>
								</span>
								@else
								<span class="relative inline-flex items-center justify-center px-3 py-1 font-medium text-white bg-yellow-500 rounded-full shadow">
									<span aria-hidden="true" class="absolute inset-0 bg-yellow-400 opacity-70 rounded-full"></span>
									<span class="relative">{{ $queueNumber->status }}</span>
								</span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="px-5 py-5 bg-white border-t">
					<div class=" mt-2 xs:mt-0">
						{{ $queueNumbers->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection