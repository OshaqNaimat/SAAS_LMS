<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role, // Saves explicitly as 'teacher'
        ]);

        return back()->with('success', 'Teacher Registered successfully!');
    }
    public function storeStudent(Request $request)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'roll_number' => 'required|string|unique:users,roll_number',
        'class'       => 'required|string',
        'section'     => 'required|string',
        'password'    => 'required|string|min:4',
        'role'        => 'required|string',
    ]);

    User::create([
        'name'        => $request->name,
        'father_name' => $request->father_name,
        'roll_number' => $request->roll_number,
        'class'       => $request->class,
        'section'     => $request->section,
        'password'    => Hash::make($request->password),
        'role'        => $request->role, // Saves explicitly as 'student'
    ]);

    return back()->with('success', 'New Student Registered successfully!');
}
}

