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
                    <div onclick="openModal('modelConfirm')" class="self-center">
                        <button class="text-xl bg-cyan-500 hover:bg-blue-400 text-blue-dark font-semibold hover:text-white py-2 px-4 w-[8rem] h-[3.5rem] border border-blue hover:border-transparent rounded-full">
                            Transfer
                        </button>
                    </div>
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
    

    <div id="modelConfirm" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

        <div class="flex justify-end p-2">
            <button onclick="closeModal('modelConfirm')" type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="p-6 pt-0 text-center">
            <h1 class=" font-bold text-4xl block ">Transfer To</h1>
            <div class="border border-solid border-black mt-4 mx-2 flex justify-between items-center">
                <label for="Department1" class=" font-bold text-2xl block m-3">Department 1 </label>
                <input id="Department1" type="radio" value="Department1" name="transfer" class="mr-3 w-7 h-7 text-blue-900 bg-gray-100 border-gray-300 ">
            </div>
            <div class="border border-solid border-black mx-2 mb-4 flex justify-between items-center">
                <label for="Department2" class=" font-bold text-2xl block m-3">Department 2 </label>
                <input id="Department2" type="radio" value="Department2" name="transfer" class="mr-3 w-7 h-7 text-blue-900 bg-gray-100 border-gray-300 ">
            </div>
            <form action="">
                @csrf
                <button onclick="closeModal('modelConfirm')" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                    Transfer
                </button>
            </form>
        </div>

    </div>
</div>
</div>
<script type="text/javascript">
    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>
@endsection