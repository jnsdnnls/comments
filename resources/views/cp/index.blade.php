<!-- resources/views/cp/index.blade.php -->

@extends('statamic::layout')
@section('title', 'Comments')
@section('wrapper_class', 'max-w-full')


@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="flex-1">All Comments</h1>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Author</th>
            <th>Comment</th>
            <th>Posted On</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($comments as $comment)
        <tr>
            <td class="flex items-center gap-2">
                <img src="{{ Statamic::modify($comment['email'])->gravatar() }}" alt="User Logo" class="w-8 h-8 bg-green-500 rounded-full">
                {{ $comment['email'] }}
            </td>
            <td>{{ $comment['content'] }}</td>
            <td>{{ $comment['created_at'] }}</td>
            <td>
                <!-- Dropdown for managing the comment -->
                <dropdown-list>
                    <button class="button btn-primary flex items-center pr-4" slot="trigger">
                        Actions <svg-icon name="micro/chevron-down-xs" class="w-2 ml-2" />
                    </button>
                    <form method="POST" action="{{ route('statamic.cp.comments.delete', $comment['comment_id']) }}" class="w-full inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item">Delete</button>
                    </form>
                </dropdown-list>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No comments found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
