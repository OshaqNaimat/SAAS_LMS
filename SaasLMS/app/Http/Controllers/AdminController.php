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
        'name'           => 'required|string|max:255',
        'email'          => 'required|email|unique:users,email',
        'password'       => 'required|string|min:6',
        'assigned_class' => 'nullable|string',
    ]);

    User::create([
        'name'           => $request->name,
        'email'          => $request->email,
        'password'       => Hash::make($request->password),
        'role'           => 'teacher', // hardcode server-side, don't trust the hidden input
        'assigned_class' => $request->assigned_class,
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
    ]);

    User::create([
        'name'        => $request->name,
        'father_name' => $request->father_name,
        'roll_number' => $request->roll_number,
        'class'       => $request->class,
        'section'     => $request->section,
        'password'    => Hash::make($request->password),
        'role'        => 'student', // hardcode server-side
    ]);

    return back()->with('success', 'New Student Registered successfully!');
}
public function facultyRoster()
{
    $teachers = User::where('role', 'teacher')->latest()->get();
    $students = User::where('role', 'student')->latest()->get();

    return view('admin.faculty', compact('teachers', 'students')); // ✅ correct
}
public function dashboard()
{
    $totalTeachers = User::where('role', 'teacher')->count();
    $totalStudents = User::where('role', 'student')->count();

    return view('admin.dashboard', compact('totalTeachers', 'totalStudents'));
}
};
