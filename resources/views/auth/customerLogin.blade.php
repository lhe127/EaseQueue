<style>
/* For mobile screens: */
@media only screen and (max-width: 767px) {
  .col-s-12 {
    width: 100%; /* Full width for mobile */
    padding: 0 1rem; /* Adds horizontal padding for better spacing */
  }
}

/* For desktop screens: */
@media only screen and (min-width: 768px) {
  .col-6 {
    width: 40%; /* Adjusts container width to 50% on desktop */
    margin: auto; /* Centers container horizontally */
  }

  .col-4{
    width: 60%;
    margin: auto; /* Centers container horizontally */
  }
}
</style>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" 
     style="background-image:url('https://images.pexels.com/photos/269138/pexels-photo-269138.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')">
    <div class="rounded-xl bg-gray-800 bg-opacity-60 px-8 py-12 shadow-lg backdrop-blur-md col-s-12 col-6">
        <div class="text-white">
            <div class="mb-8 flex flex-col items-center">
                <img src="https://www.logo.wine/a/logo/WhatsApp/WhatsApp-Logo.wine.svg" width="200" alt="WhatsApp Logo" />
                <h1 class="mb-2 text-3xl">WhatsApp</h1>
                <span class="text-gray-300">Don't have an account yet?
                    <a href="{{ route('auth.customerRegister') }}" 
                       class="text-gray-300 hover:underline hover:text-green-500">
                         Register
                    </a>
                </span>
            </div>
            <form method="POST" action="{{ route('customerLogin') }}">
                @csrf
                <div class="mb-6 text-lg col-s-12 col-4">
                    <div class="flex items-center rounded-3xl border-none bg-green-500 bg-opacity-50 px-4 py-2 text-center shadow-lg backdrop-blur-md">
                        <span class="text-white text-lg mr-4">+60</span>
                        <input type="text" name="phone" id="phone" placeholder="Phone Number"
                               class="flex-1 bg-transparent placeholder-gray-200 outline-none">
                    </div>
                </div>
                <div class="mt-8 flex justify-center text-lg">
                    <button type="submit"
                        class="rounded-3xl bg-green-500 bg-opacity-50 px-12 py-3 text-white shadow-xl transition-colors duration-300 hover:bg-green-900">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
