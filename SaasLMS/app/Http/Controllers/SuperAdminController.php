<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\ClassRoom;
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
}
