<?php

namespace Jnsdnnls\Comments\Tags;

use Carbon\Carbon;
use Jnsdnnls\Comments\Models\CommentModel;
use Statamic\Tags\Tags;

class Comment extends Tags
{
    public function index()
    {
        return view('comments::tags.comment');
    }

    public function show()
    {
        $postId = $this->params->get('post_id');
        $comments = CommentModel::all($postId);

        $sortedComments = collect($comments)->sortByDesc(function ($comment) {
            return Carbon::parse($comment['created_at']);
        })->values()->all();

        return view('comments::tags.commentsList', ['comments' => $sortedComments]);
    }

    public function form()
    {
        $postId = $this->params->get('post_id');

        return view('comments::tags.commentsForm', compact('postId'));
    }
}
