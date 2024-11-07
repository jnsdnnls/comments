@extends('statamic::layout')
@section('title', 'Manage Users')
@section('wrapper_class', 'max-w-full')

@section('content')
<h1 class="text-3xl font-semibold mb-4">Registered Users</h1>

<!-- Display Success or Error Messages -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif (session('error'))
<div class="alert alert-error">
    {{ session('error') }}
</div>
@endif

<table class="data-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['status'] ?? 'Active' }}</td>
            <td>
                <!-- Ban Button -->
                @if ($user['status'] !== 'banned')
                <form method="POST" action="{{ route('comments.users.ban', $user['id']) }}" class="inline-block">
                    @csrf
                    <button type="submit" class="button btn-danger">Ban</button>
                </form>
                @else
                <span class="text-red-500">Banned</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection