@php
use Statamic\Facades\User;
$user = User::current();
@endphp

<div class="container max-w-lg mx-auto py-8 flex flex-col">
    <img src="{{ Statamic::modify($user->email())->gravatar(2048) }}" alt="User Logo" class="bg-green-500 rounded-full w-1/2 h-1/2 m-auto mb-12">
    <h1 class="text-3xl font-bold mb-4">User Profile</h1>
    <p>Welcome to your profile page! Here you can manage your account settings.</p>

    <div class="mt-6">
        <h2 class="text-xl font-semibold">Your Details</h2>
        <ul class="list-disc pl-5 mb-4">
            <li>Email: <strong>{{ $user->email() }}</strong></li>
            <li>Name: <strong>{{ $user->name() }}</strong></li>
        </ul>

    </div>
</div>
