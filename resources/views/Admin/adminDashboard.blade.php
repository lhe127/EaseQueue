<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/6a7808c541.js" crossorigin="anonymous"></script>

</head>


<body>
    <div class="bg-gray-200 min-h-screen select-none">
        <div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
            <div class="flex items-center justify-between py-2 text-5x1">
                <div class="font-bold text-blue-900 text-4xl">Admin<span class="text-orange-600">Panel</span></div>
                <div class="flex items-center text-gray-500">
                    <span class="material-icons-outlined p-2" style="font-size: 30px">notifications</span>
                    <div onclick="toggledropdown()" class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2" style="background-image: url(https://koululainen.fi/wp-content/uploads/2024/06/kapybara_verkkoon.jpg)"></div>
                </div>
            </div>
        </div>

        <div class="flex flex-row pt-32 px-10 pb-4">
            <div class="w-2/12 mr-6">
                <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
                    <a href="" class="inline-block text-gray-600 hover:text-black my-4 w-full">
                        <span class="material-icons-outlined float-left pr-2">dashboard</span>
                        Home
                        <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                    </a>
                    <a href="" class="inline-block hover:text-black  my-4 w-full">
                        <div class="fill-current text-gray-600 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 material-icons-outlined float-left pr-1 mr-1 ml-px" viewBox="0 0 448 512">
                                <path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                            </svg>
                            Report
                            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                        </div>
                    </a>
                    <a href="#" class="inline-block text-gray-600 hover:text-black my-4 w-full" onclick="toggleSettingDropdown()">
                        <span class="material-icons-outlined float-left pr-2">file_copy</span>
                        Setting
                        <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                    </a>
                    <!-- Setting Dropdown -->
                    <div id="settingDropdown" class="hidden bg-white mt-2 rounded-md shadow-lg">
                        <a href="{{route('adminSetDepartment')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Department</a>
                        <a href="{{route('adminSetStaff')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Staff</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Queue</a>
                    </div>
                </div>
            </div>
           
            @yield('content')
        </div> 
        <div class="rounded border-gray-500 bg-white absolute shadow-md top-[4.8rem] right-[1rem] hidden" id="dropdown">
                <div class=" flex justify-center items-center h-[3rem] w-[9rem] text-xl hover:bg-gray-200 cursor-pointer ">Available</div>
                <div class=" flex justify-center items-center h-[3rem] w-[9rem] text-xl hover:bg-gray-200 cursor-pointer">Pause</div>
                <a href=""><div class=" flex justify-center items-center h-[3rem] w-[9rem] text-xl hover:bg-gray-200 cursor-pointer">Log out</div></a>
            </div>
    </div>
    <script>
        function toggledropdown(){
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        }

        function toggleSettingDropdown() {
            const settingDropdown = document.getElementById('settingDropdown');
            settingDropdown.classList.toggle('hidden');
        }
    </script>
</body>

</html>
