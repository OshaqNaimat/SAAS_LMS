<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        // Organizations
        $totalOrganizations = Organization::count();
        $activeOrganizations = Organization::where('status', 'active')->count();

        // Users
        $totalUsers = User::count();
        $usersThisWeek = User::where('created_at', '>=', now()->subDays(7))->count();
        $usersLastWeek = User::whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
        $userGrowthPct = $usersLastWeek > 0
            ? round((($usersThisWeek - $usersLastWeek) / $usersLastWeek) * 100, 1)
            : ($usersThisWeek > 0 ? 100 : 0);

        // SaaS revenue (subscriptions — what orgs pay YOU)
        $saasRevenueThisMonth = Subscription::where('status', 'active')
            ->whereMonth('starts_at', now()->month)
            ->whereYear('starts_at', now()->year)
            ->sum('amount');

        $saasRevenueLastMonth = Subscription::where('status', 'active')
            ->whereMonth('starts_at', now()->subMonth()->month)
            ->whereYear('starts_at', now()->subMonth()->year)
            ->sum('amount');

        $saasGrowthPct = $saasRevenueLastMonth > 0
            ? round((($saasRevenueThisMonth - $saasRevenueLastMonth) / $saasRevenueLastMonth) * 100, 1)
            : ($saasRevenueThisMonth > 0 ? 100 : 0);

        // School fee revenue (what students pay schools — payments table)
        $feeRevenueTotal = Payment::where('status', 'cleared')->sum('amount');
        $feeRevenueThisMonth = Payment::where('status', 'cleared')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        // Revenue trend for chart — last 7 days of SaaS subscription starts
        $revenueTrend = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo);
            return Subscription::whereDate('starts_at', $date)->sum('amount');
        });

        // User growth for chart — last 8 weeks
        $userGrowthTrend = collect(range(7, 0))->map(function ($weeksAgo) {
            $start = now()->subWeeks($weeksAgo + 1);
            $end = now()->subWeeks($weeksAgo);
            return User::whereBetween('created_at', [$start, $end])->count();
        });

        // Recent activity — merge recent orgs + subscriptions + suspensions
        $recentOrgs = Organization::latest()->take(5)->get()->map(function ($org) {
            return [
                'title' => "{$org->name} " . ($org->status === 'suspended' ? 'was suspended' : 'joined the platform'),
                'description' => ucfirst($org->status) . ' organization',
                'time' => $org->created_at,
                'initials' => strtoupper(substr($org->name, 0, 2)),
            ];
        });

        $recentSubs = Subscription::with('organization')->latest()->take(5)->get()->map(function ($sub) {
            return [
                'title' => ($sub->organization->name ?? 'Unknown org') . " subscribed to {$sub->plan}",
                'description' => ucfirst($sub->billing_cycle) . ' billing • Rs. ' . number_format($sub->amount),
                'time' => $sub->created_at,
                'initials' => strtoupper(substr($sub->organization->name ?? 'NA', 0, 2)),
            ];
        });

        $recentActivity = $recentOrgs->merge($recentSubs)
            ->sortByDesc('time')
            ->take(6)
            ->values();

        // System status — real checks
       $systemStatus = [
    'app' => $this->appServerStatus(),
    'database' => $this->checkDatabase(),
    'cache' => $this->checkCache(),
    'queue' => $this->checkQueue(),
    'storage' => $this->checkStorage(),
];

        return view('super-admin.dashboard', compact(
            'totalOrganizations',
            'activeOrganizations',
            'totalUsers',
            'userGrowthPct',
            'saasRevenueThisMonth',
            'saasGrowthPct',
            'feeRevenueTotal',
            'feeRevenueThisMonth',
            'revenueTrend',
            'userGrowthTrend',
            'recentActivity',
            'systemStatus'
        ));
    }

   private function checkDatabase(): bool
{
    try {
        DB::connection()->getPdo();
        return true;
    } catch (\Exception $e) {
        return false;
    }
}


private function checkStorage(): float
{
    $total = disk_total_space(storage_path());
    $free = disk_free_space(storage_path());
    return round((($total - $free) / $total) * 100, 1);
}
    private function checkCache(): array
{
    $driver = config('cache.default');
    try {
        $testKey = '_health_check_' . time();
        cache()->put($testKey, true, 5);
        $working = cache()->get($testKey) === true;
        cache()->forget($testKey);
        return ['driver' => $driver, 'online' => $working];
    } catch (\Exception $e) {
        return ['driver' => $driver, 'online' => false];
    }
}
private function checkQueue(): array
{
    $driver = config('queue.default');
    // 'sync' means jobs run immediately inline — there's no real queue/worker to monitor
    return ['driver' => $driver, 'is_real_queue' => $driver !== 'sync'];
}
private function appServerStatus(): array
{
    return [
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version(),
        'environment' => app()->environment(),
    ];
}
}

