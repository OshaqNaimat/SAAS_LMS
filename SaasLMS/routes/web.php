<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// super admin routes
Route::view("/super-admin-dashboard",'super-admin.dashboard');
Route::view("/super-admin-organizations",'super-admin.organizations');





// admin dashbaord
Route::view("/admin-dashboard",'admin.dashboard');
