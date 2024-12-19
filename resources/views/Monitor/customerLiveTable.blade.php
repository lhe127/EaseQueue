@extends('Monitor/LiveDashboard')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="flex bg-cyan-100 h-screen">  
    <div class="w-2/6 pt-24 pl-16 "> 
        <table class="table-auto"> 
            <thead>
                <tr class="text-3xl font-semibold tracking-wide text-center text-gray-900 bg-gray-100 uppercase border border-gray-600">
                    <th colspan="2" class="px-4 py-3">Previous Number</th>
                </tr>
            </thead>
            <tbody class="bg-white font-semibold text-xl">
                    <tr>
                        <td class="px-4 py-3 border border-gray-600 text-center">2001</td>
                        <td class="px-4 py-3 border border-gray-600 text-center">Counter 1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border border-gray-600 text-center">2002</td>
                        <td class="px-4 py-3 border border-gray-600 text-center">Counter 2</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border border-gray-600 text-center">2003</td>
                        <td class="px-4 py-3 border border-gray-600 text-center">Counter 3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border border-gray-600 text-center">2004</td>
                        <td class="px-4 py-3 border border-gray-600 text-center">Counter 4</td>
                    </tr>
            </tbody>
        </table>
    </div>
    <div class="w-3/6">
        <div class="flex flex-col items-center justify-center pt-24 mr-10">
            <div class="text-9xl py-3 font-semibold text-red-600">2005</div>
            <div class="text-4xl py-2 font-semibold text-gray-900">Ago</div>
            <div class="text-4xl py-2 font-semibold text-gray-900">Counter 1</div>
    </div>
    <div class="w-1/6">
    </div>
    </div>

@endsection