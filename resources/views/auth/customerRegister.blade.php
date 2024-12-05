<form method="POST" action="{{ route('auth.customerRegister') }}" class="p-6 rounded-lg shadow-lg max-w-md mx-auto">
    @csrf
    <div class="pb-2 pt-4">
        <input type="text" name="phone" id="phone" placeholder="Phone Number"
            class="block w-full p-4 text-lg rounded-sm bg-gray-200 border-2 focus:border-blue-500 focus:outline-none">
    </div>
    <button type="submit" class="w-full bg-green-600 text-white py-3 mt-4 rounded-lg font-medium hover:bg-green-700 transition duration-300">Register</button>
</form>