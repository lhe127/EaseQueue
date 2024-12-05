<!-- component -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url('https://images.pexels.com/photos/4406619/pexels-photo-4406619.jpeg')">
    <div class="rounded-xl bg-gray-800 bg-opacity-60 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
        <div class="text-white">
            <div class="mb-8 flex flex-col items-center">
                <img src="https://www.logo.wine/a/logo/WhatsApp/WhatsApp-Logo.wine.svg" width="150" alt="Instagram Logo" />
                <h1 class="mb-2 text-2xl">WhatsApp</h1>
                <span class="text-gray-300">Already Have An Account?<a href="{{ route('customerLogin') }}" 
                       class="text-gray-300 hover:underline hover:text-green-500">
                         Login
                </a></span>
            </div>
            <form method="POST" action="{{ route('auth.customerRegister') }}">
                @csrf
                <div class="mb-4 text-lg">
                    <input type="text" name="phone" id="phone" placeholder="Phone Number"
                        class="rounded-3xl border-none bg-green-500 bg-opacity-50 px-6 py-2 text-center placeholder-gray-200 shadow-lg outline-none backdrop-blur-md">
                </div>
                <div class="mt-8 flex justify-center text-lg">
                    <button type="submit"
                        class="rounded-3xl bg-green-500 bg-opacity-50 px-10 py-2 text-white shadow-xl transition-colors duration-300 hover:bg-green-900">REGISTER</button>
                </div>
            </form>
        </div>
    </div>
</div>