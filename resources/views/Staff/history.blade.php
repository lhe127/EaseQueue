@extends("Staff/dashboard")
@section('content')
<div class="bg-white p-8 rounded-md w-[74rem]">
	<div class=" flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold ml-[2rem]">Queue History</h2>
		</div>
		<div class="flex items-center justify-between">
			<div class="flex bg-gray-50 items-center p-2 rounded-md w-[20rem]">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
					fill="currentColor">
					<path fill-rule="evenodd"
						d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						clip-rule="evenodd" />
				</svg>
				<input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
			</div>
		</div>
	</div>
	<div>
		<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-2 overflow-x-auto">
			<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
				<table class="min-w-full leading-normal">
					<thead>
						<tr>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								ID
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Queue Number
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Phone Number
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								FCall
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								LCall
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Status
							</th>
						</tr>
					</thead>

					<tbody>
						<div>
							<tr>

								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
										<div class="ml-3">
											<p class="text-gray-900 whitespace-no-wrap">
												1
											</p>
										</div>
									</div>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">3001</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">012-3456 7890</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										Jan 21, 2020
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
									Jan 21, 2020
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span
										class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
										<span aria-hidden
											class="absolute inset-0 bg-red-900 opacity-50 rounded-full"></span>
										<span class="relative">absence</span>
									</span>
								</td>

							</tr>
							<tr>

								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
										<div class="ml-3">
											<p class="text-gray-900 whitespace-no-wrap">
												2
											</p>
										</div>
									</div>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">3002</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">012-3456 7890</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										Jan 01, 2020
									</p>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
									    Jan 01, 2020
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span
										class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
										<span aria-hidden
											class="absolute inset-0 bg-lime-500 opacity-50 rounded-full"></span>
										<span class="relative">Transfer</span>
									</span>
								</td>

							</tr>
							<tr>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
										<div class="ml-3">
											<p class="text-gray-900 whitespace-no-wrap">
												3
											</p>
										</div>
									</div>
								</td>

								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">3003</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">012-3456 7890</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										Jan 10, 2020
									</p>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										Jan 10, 2020
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span
										class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
										<span aria-hidden
											class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
										<span class="relative">Complete</span>
									</span>
								</td>
							</tr>
							<tr>
								<td class="px-5 py-5 bg-white text-sm">
									<div class="flex items-center">
										<div class="ml-3">
											<p class="text-gray-900 whitespace-no-wrap">
												4
											</p>
										</div>
									</div>
								</td>
								<td class="px-5 py-5 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">3004</p>
								</td>
								<td class="px-5 py-5 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">012-3456 7890</p>
								</td>
								<td class="px-5 py-5 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">Jan 18, 2020</p>
								</td>
								<td class="px-5 py-5 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">Jan 18, 2020</p>
								</td>
								<td class="px-5 py-5 bg-white text-sm">
									<span
										class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
										<span aria-hidden
											class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
										<span class="relative">Complete</span>
									</span>
								</td>
							</tr>
						</div>
					</tbody>

				</table>
				<div
					class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
					<span class="text-xs xs:text-sm text-gray-900">
						showing 1 to 4 of 50 Entries
					</span>
					<div class="inline-flex mt-2 xs:mt-0">
						<button
							class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
							Prev
						</button>
						&nbsp; &nbsp;
						<button
							class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
							Next
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection