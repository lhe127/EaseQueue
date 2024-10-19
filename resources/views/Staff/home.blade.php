@extends('Staff/dashboard')
@section('content')

<div class="w-10/12 mt-3">
    <div class="flex flex-row">
        <div class=" bg-zinc-300 border-solid border-2 border-black rounded-xl w-9/12 h-[30rem] mr-2 p-6">
            <div class="flex justify-center mt-[3rem]">
                <p class="text-7xl text-indigo-900 "><strong>3122</strong></p>
            </div>
            <div class="flex justify-center mt-[2rem]">
                <p class="text-3xl text-indigo-900"><strong>Renew License</strong></p>
            </div>
            <div class="flex justify-center mt-[1rem]">
                <p class="text-3xl text-indigo-900"><strong>00:00:00</strong>
            </div>
            <div class="flex justify-center gap-[4rem] mt-[3rem]">
                <span class="bg-cyan-700 text-2xl text-white inline-block rounded-full mt-12 px-8 py-2 w-[10rem] h-[3rem] text-center"><strong>Call</strong></span>
                <span class="bg-cyan-700 text-2xl text-white inline-block rounded-full mt-12 px-8 py-2 w-[10rem] h-[3rem] text-center"><strong>Transfer</strong></span>
                <span class="bg-cyan-700 text-2xl text-white inline-block rounded-full mt-12 px-8 py-2 w-[10rem] h-[3rem] text-center"><strong>Next</strong></span>
            </div>
        </div>

        <div class="flex flex-col bg-red-200 border-solid border-2 border-black drop-shadow-md rounded-xl w-3/12 ml-4 h-[30rem] ">
            <p class="text-3xl text-indigo-900 self-center mt-4 mb-3"><strong>Next Number</strong></p>
            <p class="border-t-4 border-black  mb-4 w-full"></p>
            <p class="text-3xl text-indigo-900  self-center"><strong>3123</strong></p>
            <p class="border-t-4 border-black mt-3 mb-4 w-full"></p>
            <p class="text-3xl text-indigo-900 self-center"><strong>3124</strong></p>
            <p class="border-t-4 border-black mt-3 mb-4 w-full"></p>
            <p class="text-3xl text-indigo-900 self-center "><strong>3125</strong></p>
            <p class="border-t-4 border-black mt-3 mb-4 w-full"></p>
            <p class="text-3xl text-indigo-900 self-center "><strong>3126</strong></p>
            <p class="border-t-4 border-black mt-3 mb-4 w-full"></p>
            <p class="text-3xl text-indigo-900 self-center "><strong>3127</strong></p>
        </div>
    </div>
</div>
@endsection