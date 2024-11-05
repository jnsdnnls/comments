<?php

namespace Jnsdnnls\Comments\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jnsdnnls\Comments\Models\CommentModel;
use Statamic\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index($postId)
    {
        // Retrieve all comments for the given post ID from the YAML file
        $comments = CommentModel::all($postId);

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'post_id' => 'required|string',
        ]);

        $user = Auth::user();

        $commentData = [
            'name' => $user->name(),  // Use the logged-in user's name
            'post_id' => $request->input('post_id'),
            'comment_id' => uniqid(),  // Generate a unique ID for the comment
            'email' => $user->email(),  // Use the logged-in user's email
            'content' => $request->input('content'),
            'created_at' => now()->toDateTimeString(),
        ];

        // Create a new Comment and save it in YAML
        $comment = new CommentModel($commentData, $request->input('post_id'));
        $comment->save();

        return redirect()->back()->with('success', 'Fields added to collection blueprint.');
    }
}
