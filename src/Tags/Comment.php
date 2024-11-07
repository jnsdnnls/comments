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
        $entryId = $this->context->get('id');
        $comments = CommentModel::all($entryId);

        $sortedComments = collect($comments)->sortByDesc(function ($comment) {
            return Carbon::parse($comment['created_at']);
        })->values()->all();

        return view('comments::tags.commentsList', ['comments' => $sortedComments]);
    }

    public function form()
    {

        $entryId = $this->context->get('id');

        return view('comments::tags.commentsForm', compact('entryId'));
    }
}
