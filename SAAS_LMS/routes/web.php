<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminAuthController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

// ---------------------------------------------------------------------------
// Guest routes
// ---------------------------------------------------------------------------
Route::middleware('guest:super_admin')->group(function () {
    Route::get('/login', [SuperAdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [SuperAdminAuthController::class, 'login'])->name('login.attempt');
});

// ---------------------------------------------------------------------------
// Authenticated Super Admin routes
// ---------------------------------------------------------------------------
Route::middleware('super_admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Tenant management
    Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
    Route::patch('/tenants/{tenant}/status', [TenantController::class, 'updateStatus'])->name('tenants.status');
    Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.destroy');
});

// Logout (POST, no redirect loop)
Route::post('/logout', [SuperAdminAuthController::class, 'logout'])
    ->middleware('super_admin')
    ->name('logout');
