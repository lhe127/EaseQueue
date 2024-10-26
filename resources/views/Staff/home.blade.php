@extends('Staff/dashboard')
@section('content')

<div class="w-10/12 mt-3">
    <div class="flex flex-row">
        <div class=" bg-gray-200 border-solid border-2 border-black rounded-xl w-9/12 h-[30rem] mr-2 p-6">
            <div class="flex justify-center mt-[3rem]">
                <p class="text-7xl text-indigo-900 "><strong>3122</strong></p>
            </div>
            <div class="flex justify-center mt-[2rem]">
                <p class="text-3xl text-indigo-900"><strong>Renew License</strong></p>
            </div>
            <div class="flex justify-center mt-[1rem]">
                <p class="text-3xl text-indigo-900"><strong>00:00:00</strong>
            </div>
            <div class="flex justify-center gap-[4rem] mt-[4rem]">
                <form action="">
                    <div class="self-center">
                        <button class="text-xl  bg-cyan-500 hover:bg-blue-400 text-blue-dark font-semibold hover:text-white py-2 px-4 w-[8rem] h-[3.5rem] border border-blue hover:border-transparent rounded-full">
                            Call
                        </button>
                    </div>
                </form>
                <form action="">
                    <div class="self-center">
                        <button class="text-xl bg-cyan-500 hover:bg-blue-400 text-blue-dark font-semibold hover:text-white py-2 px-4 w-[8rem] h-[3.5rem] border border-blue hover:border-transparent rounded-full">
                            Transfer
                        </button>
                    </div>
                </form>
                <form action="">
                    <div class="self-center">
                        <button class="text-xl bg-cyan-500 hover:bg-blue-400 text-blue-dark font-semibold hover:text-white py-2 px-4 w-[8rem] h-[3.5rem] border border-blue hover:border-transparent rounded-full">
                            Next
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-md overflow-hidden max-w-lg mx-auto">
            <div class="bg-gray-300 py-3 px-4">
                <h2 class="text-2xl font-semibold text-gray-800 my-2">Queue Numbers</h2>
            </div>
            <ul class="divide-y divide-gray-200">
                <li class="flex items-center py-4 px-6">
                    <span class="text-gray-700 text-lg font-medium mr-8">1.</span>
                    <div class="flex-1">
                        <h2 class="text-xl font-medium text-gray-800">1001</h3>
                    </div>
                </li>
                <li class="flex items-center py-4 px-6">
                    <span class="text-gray-700 text-lg font-medium mr-8">2.</span>
                    <div class="flex-1">
                        <h2 class="text-xl font-medium text-gray-800">1002</h3>
                    </div>
                </li>
                <li class="flex items-center py-4 px-6">
                    <span class="text-gray-700 text-lg font-medium mr-8">3.</span>
                    <div class="flex-1">
                        <h2 class="text-xl font-medium text-gray-800">1003</h3>
                    </div>
                </li>
                <li class="flex items-center py-4 px-6">
                    <span class="text-gray-700 text-lg font-medium mr-8">4.</span>
                    <div class="flex-1">
                        <h2 class="text-xl font-medium text-gray-800">1004</h3>
                    </div>
                </li>
                <li class="flex items-center py-4 px-6">
                    <span class="text-gray-700 text-lg font-medium mr-8">5.</span>
                    <div class="flex-1">
                        <h2 class="text-xl font-medium text-gray-800">1005</h3>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection