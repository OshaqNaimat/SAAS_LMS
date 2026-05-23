<?php

namespace App\Http\Controllers;

use App\Models\Tenant;

class DashboardController extends Controller
{
    public function index()
{
    $tenants = Tenant::latest()->paginate(10);

    $metrics = [
        'total_tenants'   => Tenant::count(),
        'new_this_month'  => Tenant::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->count(),
        'active_students' => Tenant::sum('student_count'),
        'active_tenants'  => Tenant::where('status', 'active')->count(),
    ];

    return view('Main-Admin.MA-dashboard', compact('tenants', 'metrics'));
}
}
