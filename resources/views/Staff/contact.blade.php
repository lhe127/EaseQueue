@extends('Staff.dashboard')
@section('content')
<div class="w-[76rem]">
    <div class="bg-white border rounded-lg shadow relative mx-10">

        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-3xl font-semibold">
                Post Request
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="product-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-6">
            <form action="{{route('postContact')}}" method="post" enctype='multipart/form-data'>
                @csrf
                <input type="hidden" name="staffID" value="S24001">
                <div class="grid grid-cols-6 gap-6">
                    <div id="Type" class="col-span-6 sm:col-span-3">
                        <label for="Type" class="text-xl font-medium text-gray-900 block mb-4">Type</label>
                        <div class="flex items-center mt-2">
                            <input id="Exchange" type="radio" value="Exchange" name="Type" class="w-4 h-4 text-blue-600 border-gray-300 dark:bg-gray-300 dark:border-gray-600" onchange="toggleMCUpload()">
                            <label for="Exchange" class="ms-2 text-sm font-medium text-gray-900 dark:text-black">Exchange</label>
                        </div>
                        <div class="flex items-center">
                            <input id="AL" type="radio" value="AL" name="Type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600" onchange="toggleMCUpload()">
                            <label for="AL" class="ms-2 text-sm font-medium text-gray-900 dark:text-black">Annual Leave</label>
                        </div>
                        <div class="flex items-center">
                            <input id="MC" type="radio" value="MC" name="Type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600" onchange="toggleMCUpload()">
                            <label for="MC" class="ms-2 text-sm font-medium text-gray-900 dark:text-black">Medical Certificate</label>
                        </div>
                        <div class="w-[20rem] hidden" id="dropMC">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="MCimage">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="MCimage" id="MCimage" name="MCimage" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="MCimage">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="brand" class="text-xl font-medium text-gray-900 block mb-2 mt-2">Date</label>
                        <p>From</p>
                        <input type="date" name="Fdate" id="Fdate" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                        <p class="mt-1">To</p>
                        <input type="date" name="Tdate" id="Tdate" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" required="">
                    </div>

                    <div class="col-span-full">
                        <label for="Reason" class="text-sm font-medium text-gray-900 block mb-2">Reason</label>
                        <textarea id="Reason" name="Reason" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4" placeholder="Details"></textarea>
                    </div>
                </div>
                <div class="p-6 border-t border-gray-200 rounded-b">
                    <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Submit</button>
                </div>
            </form>
        </div>


    </div>
</div>

<script>
    function toggleMCUpload() {
        const dropMC = document.getElementById('dropMC');
        const mcRadio = document.getElementById('MC');

        if (mcRadio.checked) {
            dropMC.style.display = "block";
        } else {
            dropMC.style.display = "none";
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        toggleMCUpload(); // Call once to set the correct initial state
    });
</script>
@endsection
