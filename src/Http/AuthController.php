<?php

namespace Jnsdnnls\Comments\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Statamic\Facades\User;
use Jnsdnnls\Comments\Mail\SendPasswordEmail;
use Illuminate\Support\Str;

class AuthController
{

    public function register(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (User::findByEmail($value)) {
                        $fail('The email has already been taken.');
                    }
                },
            ],
            'name' => 'required|string|max:255',
        ]);

        $password = Str::random(6); // Generate a random password
        $user = User::make()->email($request->email)->password($password)->name($request->name);

        $user->save();

        // Send the password to the user's email
        Mail::to($request->email)->send(new SendPasswordEmail($password));

        return redirect()->back()->with('status', 'Registration successful! Check your email for the password.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->back()->with('status', 'Logged in successfully!');
        }
        return redirect()->back()->withErrors('Invalid credentials');
    }
}
