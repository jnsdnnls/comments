<h1 class="text-2xl font-bold text-center mb-6 mt-8">Register</h1>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-4">
        <input type="email" name="email" placeholder="Email" required
            class="flex w-full items-center justify-between p-5 border-t border-green-400 text-green-400 hover:text-green-900 " />
    </div>
    <div class="mb-4">
        <input type="text" name="name" placeholder="Full Name" required
            class="flex w-full items-center justify-between p-5 border-t border-green-400 text-green-400 hover:text-green-900  " />
    </div>
    <button type="submit"
        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold p-5 focus:outline-none focus:ring focus:ring-green-300">
        Register
    </button>
</form>
<p class="text-center mt-4">
    Already have an account? <a href="/login" class="text-blue-500 underline">Login</a>
</p>