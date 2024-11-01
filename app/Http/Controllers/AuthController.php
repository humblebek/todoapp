<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        // Use email and password for authentication
        $credentials = $request->only('email', 'password');

        // Use Auth::attempt to check the hashed password
        if (Auth::attempt($credentials)) {
            return redirect()->route('index')->with('success', 'Successfully logged in!');
        } else {
            return redirect()->route('login')->withErrors([
                'credentials' => 'Invalid email or password. Please try again.',
            ])->withInput();
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
