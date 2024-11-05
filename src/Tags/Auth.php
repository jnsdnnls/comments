<?php

namespace Jnsdnnls\Comments\Tags;

use Statamic\Tags\Tags;

class Auth extends Tags
{
    public function login()
    {
        return view('comments::auth.login');
    }

    public function signup()
    {
        return view('comments::auth.register');
    }

    public function profile()
    {
        return view('comments::auth.profile');
    }
}
