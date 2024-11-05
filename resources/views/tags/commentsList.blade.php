@php
use Carbon\Carbon;
use Statamic\Facades\User;

@endphp

<div id="comments" class="mt-8 space-y-4">
    @if(count($comments))
    @foreach($comments as $comment)
    @php
    $user = User::findByEmail($comment['email']);
    @endphp

    <div class="relative p-4 shadow-sm pl-16">
        <img src="{{ Statamic::modify($user->email())->gravatar() }}" alt="User Logo" class="absolute top-4 left-4 w-8 h-8 bg-green-500 rounded-full">


        <div class="flex items-centertext-xs gap-2">
            <h2 class="text-white font-bold">{{ $user ? $user->name() : 'Unknown User' }}</h2>
            <small class="text-green-500 mt-px">{{ Carbon::parse($comment['created_at'])->diffForHumans() }}</small>
        </div>
        <p class="text-white leading-6">{{ $comment['content'] }}</p>
    </div>
    @endforeach
    @else
    <p class="text-green-600 text-center p-4 border border-green-400">
        No comments yet. Be the first to comment!
    </p>
    @endif
</div>
