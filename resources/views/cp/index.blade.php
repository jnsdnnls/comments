<!-- resources/views/cp/index.blade.php -->

@extends('statamic::layout')
@section('title', 'Comments')

@section('content')
<div class="flex items-center justify-between mb-3">
    <h1 class="flex-1">All Comments</h1>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Author</th>
            <th>Content</th>
            <th>Posted On</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($comments as $comment)
        <tr>
            <td>{{ $comment['email'] }}</td>
            <td>{{ $comment['content'] }}</td>
            <td>{{ $comment['created_at'] }}</td>
            <td>
                <!-- Optional: Link to delete or manage the comment -->
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
