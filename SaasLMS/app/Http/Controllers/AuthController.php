<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle incoming administrative authentication attempts.
     */
 public function login(Request $request)
{
    // 1. Validate using the exact input name from your form layout
    $request->validate([
        'login_identity' => 'required|email',
        'password'       => 'required|string',
    ]);

    // 2. Map your form's "login_identity" string to your table's "email" column
    $credentials = [
        'email'    => $request->input('login_identity'),
        'password' => $request->input('password'),
    ];

    // 3. Attempt secure structural session authentication
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Welcome back, Admin!');
        }

        return redirect()->intended('/dashboard');
    }

    // 4. Return custom validation error using your exact form field name
    return back()->withErrors([
        'login_identity' => 'The provided credentials do not match our recorded system logs.',
    ])->onlyInput('login_identity');
}

    /**
     * Terminate active user authentication proxy sessions cleanly.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
