<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// super admin routes
// Route::view("/super-admin-dashboard",'super-admin.dashboard');
// Route::view("/super-admin-organizations",'super-admin.organizations');
// Route::view("/super-admin-analytics",'super-admin.analytics');
// Route::view("/super-admin-settings",'super-admin.settings');


// admin dashbaord
// Route::view("/admin-dashboard",'admin.dashboard');
// Route::view("/admin-faculty",'admin.faculty');
// Route::view("/admin-classes-control",'admin.classes');
// Route::view("/admin-attendence-control",'admin.attendence');
// Route::view("/admin-reports-control",'admin.reports');
// Route::view("/admin-billings-control",'admin.billings');
// Route::view("/admin-setting",'admin.setting');

// // teacher routes
// // Route::view("/teacher-dashboard",'teacher.dashboard');
// Route::view("/teacher-schedules",'teacher.Schedule');
// Route::view("/teacher-attendance",'teacher.attendence-registry');
// Route::view("/teacher-batches",'teacher.assigned-batches');
// Route::view("/teacher-announcements",'teacher.notice-board');

// // student routes
// // Route::view("/student-dashboard",'student.dashboard');
// Route::view("/student-timetable",'student.student-timetable');
// Route::view("/student-attendance",'student.student-attendence');


// // Form Actions Handling Authentication Tasks
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Dashboard Route Protection Setup Blueprint
// Route::get('/dashboard', function () {
//     return view('admin.dashboard'); // Replace with your actual dashboard controller mapping later
// })->middleware('auth')->name('dashboard');


// Route::post('/admin/add-teacher', [AdminController::class, 'storeTeacher'])->middleware('auth')->name('admin.add-teacher');

// // 2. Isolated Teacher Panel Domain Scope Guard
// Route::get('/teacher/dashboard', function () {
//     return view('teacher.dashboard'); // Loads the file located at resources/views/teacher/dashboard.blade.php
// })->middleware('auth')->name('teacher.dashboard');
Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --------------------------------------------------------
// SECURE ADMIN WORKSPACE (Only Admins Allowed)
// --------------------------------------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // FIXED: Both registration forms are now safely guarded inside the admin group
    Route::post('/admin/add-teacher', [AdminController::class, 'storeTeacher'])->name('admin.add-teacher');
    Route::post('/admin/add-student', [AdminController::class, 'storeStudent'])->name('admin.add-student');
    Route::get('/admin/faculty-roster', [AdminController::class, 'facultyRoster'])->name('admin.faculty-roster');
    Route::get('/admin-faculty', [AdminController::class, 'facultyRoster'])->name('admin.faculty');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
    Route::put('/admin/teachers/{user}', [AdminController::class, 'updateTeacher'])->name('admin.teacher.update');
    Route::put('/admin/students/{user}', [AdminController::class, 'updateStudent'])->name('admin.student.update');

    Route::view('/admin-classes-control','admin.classes');
    Route::view('/admin-attendence-control','admin.attendence');
    Route::view('/admin-reports-control','admin.reports');
    Route::view('/admin-billings-control','admin.billings');
    Route::view('/admin-setting','admin.setting');
});


// --------------------------------------------------------
// SECURE TEACHER WORKSPACE (Only Teachers Allowed)
// --------------------------------------------------------
Route::middleware(['auth', 'role:teacher'])->group(function () {

    // FIXED: Removed the stray backtick character from the path string
    Route::get('/teacher-dashboard', function () {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');
});


// --------------------------------------------------------
// SECURE STUDENT WORKSPACE (Only Students Allowed)
// --------------------------------------------------------
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student-dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
