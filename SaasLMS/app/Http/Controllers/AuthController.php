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
    $request->validate([
        'login_identity' => 'required|string',
        'password'       => 'required|string',
    ]);

    $identity = $request->input('login_identity');
    $password = $request->input('password');

    if (str_contains($identity, '@')) {
        $credentials = ['email' => $identity, 'password' => $password];
    } else {
        $credentials = ['roll_number' => $identity, 'password' => $password];
    }

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->role === 'super_admin') {
            return redirect()->route('super-admin.dashboard')->with('success', 'Welcome Super Admin.');
        }

        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Welcome Admin.');
        }

        if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard')->with('success', 'Welcome Teacher.');
        }

        if ($user->role === 'student') {
            return redirect()->route('student.dashboard')->with('success', 'Welcome Student.');
        }

        // Safety net: any role that reaches here has no defined redirect
        Auth::logout();
        return back()->withErrors([
            'login_identity' => 'Your account role is not configured for dashboard access.',
        ]);
    }

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
