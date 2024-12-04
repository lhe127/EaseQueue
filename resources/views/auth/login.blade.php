<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <section class="min-h-screen flex items-stretch text-white">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center" style="background-image: url(https://i.pinimg.com/736x/f6/16/d5/f616d5d65f039c1492ca62bce97856ef.jpg);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="w-full px-24 z-10">
                <h1 class="text-5xl font-bold text-left tracking-wide">EaseQueue</h1>
                <p class="text-3xl my-4">Effortless Queuing Experience</p>
            </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
                <h1 class="font-bold" style="font-size:4em">LOGIN</h1>
                <form method="POST" action="{{ route('login') }}" class="p-6 rounded-lg shadow-lg max-w-md mx-auto"  style="background-color: #161616;">
                    @csrf
                    <div class="pb-2 pt-4">
                        <input type="email" name="email" id="email" placeholder="Email" class="block w-full p-4 text-lg rounded-sm bg-black border-2 border-white focus:border-blue-500 focus:outline-none">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-sm bg-black border-2 border-white focus:border-blue-500 focus:outline-none" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 mt-4 rounded-lg font-medium hover:bg-blue-700 transition duration-300">Login</button>
                    <div class="mt-4 text-center">
                    
                </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
