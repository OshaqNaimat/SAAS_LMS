<?php

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
Route::view("/admin-dashboard",'admin.dashboard');
Route::view("/admin-faculty",'admin.faculty');
Route::view("/admin-classes-control",'admin.classes');
Route::view("/admin-attendence-control",'admin.attendence');
Route::view("/admin-reports-control",'admin.reports');
Route::view("/admin-billings-control",'admin.billings');
Route::view("/admin-setting",'admin.setting');

// teacher routes
Route::view("/teacher-dashboard",'teacher.dashboard');
Route::view("/teacher-schedules",'teacher.Schedule');
Route::view("/teacher-attendance",'teacher.attendence-registry');
Route::view("/teacher-batches",'teacher.assigned-batches');

