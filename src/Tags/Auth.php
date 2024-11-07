<?php

namespace Jnsdnnls\Comments\Tags;

use Statamic\Tags\Tags;
use Illuminate\Support\Facades\Session;

class Auth extends Tags
{
    public function login()
    {
        $user = Session::get('authenticated_visitor');
        if ($user) {
            return redirect(url('/profile'));
        }
        return view('comments::auth.login');
    }

    public function signup()
    {
        return view('comments::auth.register');
    }

    public function profile()
    {
        $user = Session::get('authenticated_visitor');

        if (!$user) {
            return redirect(url('/login'));
        }

        return view('comments::auth.profile', compact('user'));
    }
}
