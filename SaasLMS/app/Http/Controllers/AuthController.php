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
    // Validate structural form input field formats
    $request->validate([
        'login_identity' => 'required|email',
        'password'       => 'required|string',
        'role'           => 'required|string',
    ]);

    $credentials = [
        'email'    => $request->input('login_identity'),
        'password' => $request->input('password'),
    ];

    // Check credentials against database tables
   if (Auth::attempt($credentials, $request->boolean('remember'))) {
    $request->session()->regenerate();
    $user = Auth::user();

    // Route users to their specific authorized dashboard URLs
    if ($user->role === 'admin') {
        return redirect()->route('dashboard');
    }

    if ($user->role === 'teacher') {
        return redirect()->route('teacher.dashboard');
    }

    if ($user->role === 'student') {
        return redirect()->route('student.dashboard');
    }
}
    // Explicit validation matching failure states
    return back()->withErrors([
        'login_identity' => 'The provided security credentials do not match our logs.',
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
