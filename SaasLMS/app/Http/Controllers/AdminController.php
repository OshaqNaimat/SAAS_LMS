<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
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
public function destroy(User $user)
{
    $user->delete();
    return back()->with('success', ucfirst($user->role) . ' removed successfully!');
}

public function updateTeacher(Request $request, User $user)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'email'          => 'required|email|unique:users,email,' . $user->id,
        'assigned_class' => 'nullable|string',
    ]);

    $user->update([
        'name'           => $request->name,
        'email'          => $request->email,
        'assigned_class' => $request->assigned_class,
    ]);

    return back()->with('success', 'Teacher updated successfully!');
}

public function updateStudent(Request $request, User $user)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'roll_number' => 'required|string|unique:users,roll_number,' . $user->id,
        'class'       => 'required|string',
        'section'     => 'required|string',
    ]);

    $user->update($request->only('name', 'father_name', 'roll_number', 'class', 'section'));

    return back()->with('success', 'Student updated successfully!');
}
public function classesIndex()
{
    $classes = ClassRoom::with('teacher')->latest()->get();
    $teachers = User::where('role', 'teacher')->get();

    $totalClasses = $classes->count();
    $overcrowded = $classes->filter(fn ($c) => $c->studentCount() >= $c->max_seats)->count();

    return view('admin.classes', compact('classes', 'teachers', 'totalClasses', 'overcrowded'));
}

public function storeClass(Request $request)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'section'    => 'required|string|max:255',
        'stream'     => 'nullable|string|max:255',
        'room'       => 'nullable|string|max:255',
        'max_seats'  => 'required|integer|min:1',
        'teacher_id' => 'nullable|exists:users,id',
    ]);

    ClassRoom::create($request->only('name', 'section', 'stream', 'room', 'max_seats', 'teacher_id'));

    return back()->with('success', 'Class created successfully!');
}

public function updateClass(Request $request, ClassRoom $classRoom)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'section'    => 'required|string|max:255',
        'stream'     => 'nullable|string|max:255',
        'room'       => 'nullable|string|max:255',
        'max_seats'  => 'required|integer|min:1',
        'teacher_id' => 'nullable|exists:users,id',
    ]);

    $classRoom->update($request->only('name', 'section', 'stream', 'room', 'max_seats', 'teacher_id'));

    return back()->with('success', 'Class updated successfully!');
}

public function destroyClass(ClassRoom $classRoom)
{
    $classRoom->delete();
    return back()->with('success', 'Class removed successfully!');
}
};
