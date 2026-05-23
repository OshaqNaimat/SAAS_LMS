<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    // ---------------------------------------------------------------------------
    // POST /tenants — provision a new school tenant
    // ---------------------------------------------------------------------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'admin_name'   => ['required', 'string', 'max:255'],
            'admin_email'  => ['required', 'email', 'unique:tenants,admin_email'],
            'password'     => ['required', 'string', 'min:8'],
        ]);

        Tenant::create([
            'company_name' => $validated['company_name'],
            'admin_name'   => $validated['admin_name'],
            'admin_email'  => $validated['admin_email'],
            'password'     => Hash::make($validated['password']),
            'status'       => 'active',
        ]);

        return redirect()
        ->route('dashboard')
->with('success', 'Tenant ' . $validated['company_name'] . ' provisioned successfully.');
    }

    // ---------------------------------------------------------------------------
    // PATCH /tenants/{tenant}/status — toggle active / idle / suspended
    // ---------------------------------------------------------------------------
    public function updateStatus(Request $request, Tenant $tenant)
    {
        $request->validate([
            'status' => ['required', 'in:active,idle,suspended'],
        ]);

        $tenant->update(['status' => $request->status]);

        return back()->with('success', "Status updated to {$request->status}.");
    }

    // ---------------------------------------------------------------------------
    // DELETE /tenants/{tenant} — remove a tenant
    // ---------------------------------------------------------------------------
    public function destroy(Tenant $tenant)
    {
        $name = $tenant->company_name;
        $tenant->delete();

return back()->with("success", "Tenant {$name} has been removed.");    }
}
