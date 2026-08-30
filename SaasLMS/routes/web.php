<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --------------------------------------------------------
// SECURE ADMIN WORKSPACE (Only Admins Allowed)
// --------------------------------------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // FIXED: Both registration forms are now safely guarded inside the admin group
    Route::post('/admin/add-teacher', [AdminController::class, 'storeTeacher'])->name('admin.add-teacher');
    Route::post('/admin/add-student', [AdminController::class, 'storeStudent'])->name('admin.add-student');
    Route::get('/admin/faculty-roster', [AdminController::class, 'facultyRoster'])->name('admin.faculty-roster');
    Route::get('/admin-faculty', [AdminController::class, 'facultyRoster'])->name('admin.faculty');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
    Route::put('/admin/teachers/{user}', [AdminController::class, 'updateTeacher'])->name('admin.teacher.update');
    Route::put('/admin/students/{user}', [AdminController::class, 'updateStudent'])->name('admin.student.update');

    Route::get('/admin-classes-control', [AdminController::class, 'classesIndex'])->name('admin.classes');
Route::post('/admin-classes-control', [AdminController::class, 'storeClass'])->name('admin.classes.store');
Route::put('/admin-classes-control/{classRoom}', [AdminController::class, 'updateClass'])->name('admin.classes.update');
Route::delete('/admin-classes-control/{classRoom}', [AdminController::class, 'destroyClass'])->name('admin.classes.destroy');


    // Route::view('/admin-attendence-control','admin.attendence');
    Route::get('/admin-attendence-control', [AdminController::class, 'attendanceIndex'])->name('admin.attendance');
Route::post('/admin/attendance/mark', [AdminController::class, 'markAttendance'])->name('admin.attendance.mark');
Route::post('/admin/attendance/bulk-present', [AdminController::class, 'bulkMarkPresent'])->name('admin.attendance.bulk');
Route::post('/admin/attendance/save-batch', [AdminController::class, 'saveBatchAttendance'])->name('admin.attendance.save-batch');

    Route::get('/admin-reports-control', [AdminController::class, 'reportsIndex'])->name('admin.reports');
Route::post('/admin/reports/generate', [AdminController::class, 'generateReport'])->name('admin.reports.generate');
Route::get('/admin/reports/{report}/download', [AdminController::class, 'downloadReport'])->name('admin.reports.download');

   Route::get('/admin-billings-control', [AdminController::class, 'billingIndex'])->name('admin.billing');
Route::post('/admin/billing/store', [AdminController::class, 'storePayment'])->name('admin.billing.store');
Route::get('/admin/billing/search', [AdminController::class, 'searchPayments'])->name('admin.billing.search');
Route::put('/admin/billing/{payment}', [AdminController::class, 'updatePayment'])->name('admin.billing.update');

Route::get('/admin-schedule-control', [AdminController::class, 'scheduleIndex'])->name('admin.schedule');
Route::post('/admin/schedule', [AdminController::class, 'storeSchedule'])->name('admin.schedule.store');
Route::put('/admin/schedule/{schedule}', [AdminController::class, 'updateSchedule'])->name('admin.schedule.update');
Route::delete('/admin/schedule/{schedule}', [AdminController::class, 'destroySchedule'])->name('admin.schedule.destroy');
       Route::get('/admin/search', [AdminController::class, 'globalSearch'])->name('admin.search');

    Route::get('/admin-setting', [AdminController::class, 'settingsIndex'])->name('admin.settings');
Route::put('/admin/settings/profile', [AdminController::class, 'updateProfile'])->name('admin.settings.profile');
Route::put('/admin/settings/password', [AdminController::class, 'updatePassword'])->name('admin.settings.password');

Route::get('/admin/student/{student}', [AdminController::class, 'showStudentProfile'])->name('admin.student.profile');

Route::post('/admin/classes/{classRoom}/promote', [AdminController::class, 'promoteClass'])->name('admin.classes.promote');
Route::post('/admin/students/{student}/promote', [AdminController::class, 'promoteStudent'])->name('admin.students.promote');
});


// --------------------------------------------------------
// SECURE TEACHER WORKSPACE (Only Teachers Allowed)
// --------------------------------------------------------
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher-dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher-timetable', [TeacherController::class, 'timetable'])->name('teacher.Schedule');
     Route::get('/teacher-attendance', [TeacherController::class, 'attendanceIndex'])->name('teacher.attendance');
    Route::post('/save-attendance', [TeacherController::class, 'saveAttendance'])->name('teacher.attendance.save');
    Route::get('/teacher-classes', [TeacherController::class, 'classesIndex'])->name('teacher.classes');
    Route::view('/teacher-announcements','teacher.notice-board');
});

// --------------------------------------------------------
// SECURE STUDENT WORKSPACE (Only Students Allowed)
// --------------------------------------------------------
Route::middleware(['auth', 'role:student'])->group(function () {

       Route::get('/student-dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
        Route::get('/student-attendance', [StudentController::class, 'attendanceAnalytics'])->name('student.attendance');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
