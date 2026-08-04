<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SuperAdminController extends Controller
{
    public function organizations(Request $request)
    {
        $query = Organization::withCount('users')->with(['admins' => fn($q) => $q->limit(1)]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('admins', fn($a) => $a->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $sort = $request->get('sort', 'newest');
        $query = $sort === 'most_users'
            ? $query->orderByDesc('users_count')
            : $query->orderByDesc('created_at');

        $organizations = $query->paginate(10)->withQueryString();

        $totalOrgs = Organization::count();
        $activeOrgs = Organization::where('status', 'active')->count();
        $trialOrgs = Organization::where('plan', 'trial')->count();
        $totalUsers = User::whereNotNull('organization_id')->count();

        return view('super-admin.organizations', compact(
            'organizations', 'totalOrgs', 'activeOrgs', 'trialOrgs', 'totalUsers'
        ));
    }

    public function storeOrganization(Request $request)
    {
        $request->validate([
            'org_name' => 'required|string|max:255',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:6',
            'domain' => 'nullable|string|max:255',
            'plan' => 'required|in:trial,basic,standard,enterprise',
            'max_users' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $org = Organization::create([
                'name' => $request->org_name,
                'slug' => Str::slug($request->org_name) . '-' . Str::random(4),
                'contact_email' => $request->admin_email,
                'plan' => $request->plan,
                'status' => 'active',
                'subscription_starts_at' => now(),
                'max_users' => $request->max_users,
            ]);

            User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'password' => Hash::make($request->admin_password),
                'role' => 'admin',
                'organization_id' => $org->id,
            ]);
        });

        return back()->with('success', 'Organization registered successfully!');
    }

    public function updateOrganization(Request $request, Organization $organization)
    {
        $request->validate([
            'org_name' => 'required|string|max:255',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
            'status' => 'required|in:active,suspended,cancelled',
        ]);

        $admin = $organization->admins()->first();

        $request->validate([
            'admin_email' => 'required|email|unique:users,email,' . ($admin?->id),
        ]);

        $organization->update([
            'name' => $request->org_name,
            'status' => $request->status,
        ]);

        if ($admin) {
            $admin->update([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
            ]);
        }

        return back()->with('success', 'Organization updated successfully!');
    }

    public function suspendOrganization(Organization $organization)
    {
        $organization->update(['status' => 'suspended']);
        return back()->with('success', $organization->name . ' has been suspended.');
    }

    public function renewOrganization(Organization $organization)
    {
        $organization->update([
            'status' => 'active',
            'subscription_starts_at' => now(),
            'subscription_ends_at' => now()->addYear(),
        ]);
        return back()->with('success', $organization->name . '\'s subscription has been renewed.');
    }

    public function destroyOrganization(Organization $organization)
    {
        $organization->delete(); // cascades to users, class_rooms, etc. via foreign keys
        return back()->with('success', 'Organization removed successfully!');
    }



    public function analytics()
{
    $totalOrgs = Organization::count();
    $activeOrgs = Organization::where('status', 'active')->count();
    $totalUsers = User::whereNotNull('organization_id')->count();

    // KPI 1: Total SaaS revenue (lifetime) + month-over-month growth
    $totalRevenue = Subscription::sum('amount');
    $revenueThisMonth = Subscription::whereMonth('period_starts_at', now()->month)
        ->whereYear('period_starts_at', now()->year)->sum('amount');
    $revenueLastMonth = Subscription::whereMonth('period_starts_at', now()->subMonth()->month)
        ->whereYear('period_starts_at', now()->subMonth()->year)->sum('amount');
    $revenueGrowthPct = $revenueLastMonth > 0
        ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 1)
        : ($revenueThisMonth > 0 ? 100 : 0);

    // KPI 2: Active users platform-wide + week-over-week growth
    $usersThisWeek = User::whereNotNull('organization_id')->where('created_at', '>=', now()->subDays(7))->count();
    $usersLastWeek = User::whereNotNull('organization_id')
        ->whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
    $userGrowthPct = $usersLastWeek > 0
        ? round((($usersThisWeek - $usersLastWeek) / $usersLastWeek) * 100, 1)
        : ($usersThisWeek > 0 ? 100 : 0);

    // KPI 3: Avg users per org (real, computable)
    $avgUsersPerOrg = $totalOrgs > 0 ? round($totalUsers / $totalOrgs, 1) : 0;

    // KPI 4: Trial conversion rate (real, computable)
    $trialOrgs = Organization::where('plan', 'trial')->count();
    $convertedOrgs = $totalOrgs - $trialOrgs;
    $trialConversionPct = $totalOrgs > 0 ? round(($convertedOrgs / $totalOrgs) * 100, 1) : 0;

    // Revenue trend — last 12 months
    $revenueTrend = collect(range(11, 0))->map(function ($monthsAgo) {
        $date = now()->subMonths($monthsAgo);
        return Subscription::whereMonth('period_starts_at', $date->month)
            ->whereYear('period_starts_at', $date->year)->sum('amount');
    });
    $revenueTrendLabels = collect(range(11, 0))->map(fn($m) => now()->subMonths($m)->format('M'));

    // User acquisition — new users per month, last 12 months
    $userAcquisitionTrend = collect(range(11, 0))->map(function ($monthsAgo) {
        $date = now()->subMonths($monthsAgo);
        return User::whereNotNull('organization_id')
            ->whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)->count();
    });

    // Organization distribution by plan
    $planCounts = Organization::selectRaw('plan, count(*) as total')->groupBy('plan')->pluck('total', 'plan');
    $planDistribution = collect(['enterprise', 'standard', 'basic', 'trial'])->map(function ($plan) use ($planCounts, $totalOrgs) {
        $count = $planCounts[$plan] ?? 0;
        return [
            'plan' => $plan,
            'count' => $count,
            'pct' => $totalOrgs > 0 ? round(($count / $totalOrgs) * 100) : 0,
        ];
    });

    // Top organizations by user count (real capacity usage, no fake growth)
    $topOrganizations = Organization::withCount('users')
        ->orderByDesc('users_count')
        ->take(5)
        ->get()
        ->map(fn($org) => [
            'name' => $org->name,
            'users_count' => $org->users_count,
            'plan' => $org->plan,
            'usage_pct' => $org->max_users > 0 ? min(100, round(($org->users_count / $org->max_users) * 100)) : 0,
        ]);

    return view('super-admin.analytics', compact(
    'totalOrgs', 'activeOrgs',
    'totalRevenue', 'revenueGrowthPct', 'totalUsers', 'userGrowthPct',
    'avgUsersPerOrg', 'trialConversionPct',
    'revenueTrend', 'revenueTrendLabels', 'userAcquisitionTrend',
    'planDistribution', 'topOrganizations'
));
}
}
