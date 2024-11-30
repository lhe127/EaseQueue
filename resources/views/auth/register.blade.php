<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <section class="min-h-screen flex items-stretch text-white">
        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center" style="background-image: url(https://i.pinimg.com/736x/df/e8/53/dfe853bb6cbaa56f7ece7e1ec6eba887.jpg);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>

        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #161616;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
                <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
                <h1 class="font-bold" style="font-size:3em">Register</h1>
                <form method="POST" action="{{ route('auth.register') }}" class="p-6 rounded-lg shadow-lg max-w-md mx-auto" style="background-color: #161616;">
                    @csrf
                    <div class="pb-2 pt-4">
                        <input type="text" name="name" id="name" placeholder="Name" class="block w-full p-4 text-lg rounded-sm bg-black border-2 border-white focus:border-blue-500 focus:outline-none">
                    </div>

                    <div class="pb-2 pt-4">
                        <input type="email" name="email" id="email" placeholder="Email" class="block w-full p-4 text-lg rounded-sm bg-black border-2 border-white focus:border-blue-500 focus:outline-none">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-sm bg-black border-2 border-white focus:border-blue-500 focus:outline-none" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-sm bg-black border-2 border-white focus:border-blue-500 focus:outline-none" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 mt-4 rounded-lg font-medium hover:bg-blue-700 transition duration-300">Register</button>
                    <div class="mt-4 text-center">
                        <p class="text-white mt-4">Already have an account? 
                            <a href="{{ route('login.page') }}" class="text-blue-400 hover:underline">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
