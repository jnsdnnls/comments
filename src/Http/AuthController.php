<?php

namespace Jnsdnnls\Comments\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Jnsdnnls\Comments\Mail\SendPasswordEmail;
use Statamic\Facades\YAML;
use Illuminate\Support\Facades\File;

class AuthController
{
    protected $storagePath = 'resources/visitors'; // Path to store visitor info

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        // Check if the directory exists; if not, create it
        $directoryPath = base_path($this->storagePath);
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        // Check if the email is already registered
        if ($this->findVisitorByEmail($request->email)) {
            return redirect()->back()->withErrors('The email is already registered.');
        }

        // Store visitor information
        $visitorData = [
            'email' => $request->email,
            'name' => $request->name,
            'status' => 'active',
            'id' => uniqid(),
        ];
        $this->storeVisitor($visitorData);

        // Send verification code on registration
        $verificationCode = random_int(100000, 999999);
        Mail::to($request->email)->send(new SendPasswordEmail($verificationCode));

        // Store the verification code in session
        Session::put('verification_code', $verificationCode);
        Session::put('visitor_email', $request->email);

        return redirect(url('/login'))->with('status', 'Registration successful! Check your email for the verification code.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|numeric|digits:6',
        ]);

        $loggedInData = [
            'email' => $request->email,
            'name' => $request->name,
            'id' => uniqid(),
        ];

        // Check the session-stored verification code
        if ($request->verification_code != Session::get('verification_code') || $request->email != Session::get('visitor_email')) {
            return redirect()->back()->withErrors('Invalid verification code.');
        }

        // Authenticate the visitor by storing their email in session
        Session::put('authenticated_visitor', $loggedInData);

        // Clear verification code from session for security
        Session::forget('verification_code');

        return redirect(url('/'))->with('status', 'Logged in successfully!');
    }

    protected function findVisitorByEmail($email)
    {
        $file = base_path("{$this->storagePath}/" . md5($email) . ".yaml");
        return file_exists($file) ? YAML::file($file)->parse() : null;
    }

    protected function storeVisitor($data)
    {
        // Check if the directory exists; if not, create it
        $directoryPath = base_path($this->storagePath);
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $file = "{$directoryPath}/{$data['id']}.yaml";
        File::put($file, YAML::dump($data));
    }

    public function logout()
    {
        Session::forget('authenticated_visitor');
        return redirect(url('/'))->with('status', 'Logged out successfully!');
    }
}
