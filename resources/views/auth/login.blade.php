<h1 class="text-2xl font-bold text-center mb-6 mt-8">Login</h1>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-4">
        <input type="email" name="email" placeholder="Email" required
            class="flex w-full items-center justify-between p-5 border-t border-green-400 text-green-400 hover:text-green-900" />
    </div>
    <div class="mb-4">
        <input type="password" name="verification_code" placeholder="Password" required
            class="flex w-full items-center justify-between p-5 border-t border-green-400 text-green-400 hover:text-green-900" />
    </div>
    <button type="submit"
        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold p-5 focus:outline-none focus:ring focus:ring-green-300">
        Login
    </button>
</form>
<p class="text-center mt-4">
    Don't have an account? <a href="/register" class="text-blue-500 underline">Register</a>
</p>