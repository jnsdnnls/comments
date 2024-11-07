<div class="container max-w-lg mx-auto py-8 flex flex-col">
    <img src="{{ Statamic::modify($user['email'])->gravatar(512) }}" alt="User Logo" class="bg-green-500 rounded-full w-1/2 h-1/2 m-auto mb-12">
    <h1 class="text-3xl font-bold mb-4">User Profile</h1>
    <p>Welcome to your profile page! Here you can manage your account settings.</p>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Your Details</h2>
        <ul class="list-disc pl-5 mb-4">
            <li>Email: <strong>{{ $user['email'] }}</strong></li>
            <li>Name: <strong>{{ $user['name'] ?? 'Guest'  }}</strong></li>
        </ul>
    </div>

    <div class="mt-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                Logout
            </button>
        </form>
    </div>
</div>