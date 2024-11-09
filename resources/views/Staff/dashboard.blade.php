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
    <div class="bg-gray-50 min-h-screen select-none">
        <div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
            <div class="flex items-center justify-between py-2 text-5x1">
                <div class="font-bold text-blue-900 text-4xl">Staff<span class="text-orange-600">Panel</span></div>
                <div class="flex items-center text-gray-500">
                    <span class="material-icons-outlined p-2" style="font-size: 30px">notifications</span>
                    <div class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2"
                        style="background-image: url(https://i.pinimg.com/564x/de/0f/3d/de0f3d06d2c6dbf29a888cf78e4c0323.jpg)">
                    </div>
                    
                    <select id="statusDropdown" class="ml-4 border rounded-md p-2 text-white shadow-sm focus:outline-none focus:border-blue-500" style="width: 150px;" onchange="changeDropdownColor()">
                        <option value="available">Available</option>
                        <option value="pause">Pause</option>
                        <option value="break">Break</option>
                        <option value="offline">Offline</option>
                        <option value="logout">Log out</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex flex-row pt-32 px-10 pb-4">
            <div class="w-2/12 mr-6">
                <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
                    <a href="{{route('home')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
                        <span class="material-icons-outlined float-left pr-2">dashboard</span>
                        Home
                        <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                    </a>
                    <a href="{{route('calendar')}}" class="inline-block hover:text-black  my-4 w-full">
                        <div class="fill-current text-gray-600 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 material-icons-outlined float-left pr-1 mr-1 ml-px" viewBox="0 0 448 512">
                                <path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z" />
                            </svg>
                            Calendar
                            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                        </div>
                    </a>
                    <a href="{{route('report')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
                        <span class="material-icons-outlined float-left pr-2">file_copy</span>
                        Report
                        <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
                <a href="{{route('history')}}" class="inline-block hover:text-black my-4 w-full">
                        <div class="fill-current text-gray-600 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 material-icons-outlined float-left pr-1 mr-1" viewBox="0 0 576 512">
                            <path d="M88.7 223.8L0 375.8 0 96C0 60.7 28.7 32 64 32l117.5 0c17 0 33.3 6.7 45.3 18.7l26.5 26.5c12 12 28.3 18.7 45.3 18.7L416 96c35.3 0 64 28.7 64 64l0 32-336 0c-22.8 0-43.8 12.1-55.3 31.8zm27.6 16.1C122.1 230 132.6 224 144 224l400 0c11.5 0 22 6.1 27.7 16.1s5.7 22.2-.1 32.1l-112 192C453.9 474 443.4 480 432 480L32 480c-11.5 0-22-6.1-27.7-16.1s-5.7-22.2 .1-32.1l112-192z" />
                        </svg>
                        History
                        <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                    </div>
                    </a>
                    <a href="{{route('contact')}}" class="inline-block hover:text-black my-4 w-full">
                        <div class="fill-current text-gray-600 hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-6 material-icons-outlined float-left pr-1 mr-1" viewBox="0 0 448 512">
                           <path d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z"/>
                    </svg>
                        Contact Admin
                        <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                    </div>
                        
                    </a>
                </div>
            </div>
           
            @yield('content')
        </div> 
    </div>
    <script>
        function changeDropdownColor() {
            const dropdown = document.getElementById('statusDropdown');
            const selectedValue = dropdown.value;

            dropdown.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-orange-500', 'bg-gray-500', 'bg-red-500');

            switch (selectedValue) {
                case 'available':
                    dropdown.classList.add('bg-green-500');  
                    break;
                case 'pause':
                    dropdown.classList.add('bg-yellow-500'); 
                    break;
                case 'break':
                    dropdown.classList.add('bg-orange-500'); 
                    break;
                case 'offline':
                    dropdown.classList.add('bg-gray-500');   
                    break;
                case 'logout':
                    dropdown.classList.add('bg-red-500');   
                    break;
            }
        }
        
        window.onload = () => {
            changeDropdownColor();
        };
    </script>
</body>

</html>