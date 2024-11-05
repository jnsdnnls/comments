<?php

namespace Jnsdnnls\Comments\Tags;

use Carbon\Carbon;
use Jnsdnnls\Comments\Models\CommentModel;
use Statamic\Tags\Tags;

class Profile extends Tags
{
    public function index()
    {
        return view('comments::tags.profile');
    }
}
