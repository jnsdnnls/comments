<h3 class="text-2xl bg-green-400 text-center text-green-900 font-bold mt-8 p-4">
    Leave a Comment
</h3>

@if(auth()->check())
<form action="{{ url('comments') }}" method="post" class="mt-4 space-y-4">
    @csrf

    <div>
        <textarea
            name="content"
            placeholder="Add your comment"
            class="w-full p-3 border border-green-400 bg-green-50 text-green-900 focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-500"
            rows="4"
            required></textarea>
    </div>

    <input type="hidden" name="post_id" value="{{ $postId }}">

    <div class="text-center">
        <button
            type="submit"
            class="bg-green-500 w-full text-white px-6 py-2 font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
            Submit
        </button>
    </div>
</form>
@else
<p class="text-green-600">Please <a href="{{ route('register') }}" class="text-blue-500 underline">register</a> or <a href="{{ route('login') }}" class="text-blue-500 underline">log in</a> to leave a comment.</p>
@endif
