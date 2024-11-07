<?php

namespace Jnsdnnls\Comments\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        // Check if the user is logged in using the session system
        if (!Session::has('authenticated_visitor')) {
            return redirect()->route('login')->withErrors('You must be logged in to leave a comment.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
            'entry_id' => 'required|string',
        ]);

        // Get the logged-in user's data from the session
        $user = Session::get('authenticated_visitor');

        // Prepare comment data
        $commentData = [
            'entry_id' => $request->input('entry_id'),
            'comment_id' => uniqid(),  // Generate a unique ID for the comment
            'email' => $user['email'],
            'content' => $request->input('content'),
            'created_at' => now()->toDateTimeString(),
        ];

        // Create a new Comment and save it in YAML
        $comment = new CommentModel($commentData, $request->input('entry_id'));
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }
}
