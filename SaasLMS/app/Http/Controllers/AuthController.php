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
    // 1. Validate basic inputs
    $request->validate([
        'login_identity' => 'required|string',
        'password'       => 'required|string',
    ]);

    $identity = $request->input('login_identity');
    $password = $request->input('password');

    // 2. AUTOMATIC DETECTION LAYER
    if (str_contains($identity, '@')) {
        // It's an email -> Could be an Admin or a Teacher
        $credentials = ['email' => $identity, 'password' => $password];
    } else {
        // No @ symbol -> It's a Student Roll Number
        $credentials = ['roll_number' => $identity, 'password' => $password];
    }

    // 3. Attempt Authentication
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        $user = Auth::user();

        // 4. Smart Redirection based on the authenticated user's actual database role
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Welcome Admin.');
        }

        if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard')->with('success', 'Welcome Teacher.');
        }

        if ($user->role === 'student') {
            return redirect()->route('student.dashboard')->with('success', 'Welcome Student.');
        }
    }

    // Fallback if credentials fail
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
