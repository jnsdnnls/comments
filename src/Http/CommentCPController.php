<?php

namespace Jnsdnnls\Comments\Http;

use Illuminate\Http\Request;
use Jnsdnnls\Comments\Models\CommentModel;

use Statamic\Http\Controllers\Controller;

class CommentCPController extends Controller
{
    public function index()
    {
        // Retrieve all comments, assuming CommentsService handles this.
        $comments = CommentModel::allComments();

        // Render the view and pass the comments data to it

        return view('comments::cp.index', compact('comments'));
    }

    public function edit($commentId)
    {
        $comment = CommentModel::findById($commentId);

        // dd($comment);

        return view('comments::cp.edit', compact('comment'));
    }

    public function destroy($commentId)
    {
        CommentModel::destroy($commentId);

        return redirect()->route('statamic.cp.comments.index')->with('status', 'Comment deleted.');
    }
}
