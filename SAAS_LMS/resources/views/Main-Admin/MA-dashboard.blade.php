<x-layout>
    <div class="bg-slate-50 font-sans antialiased text-slate-800">
        <div class="flex h-screen overflow-hidden">

            <!-- SIDEBAR -->
            <aside
                class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between hidden md:flex border-r border-slate-800">
                <div>
                    <div class="h-16 flex items-center px-6 border-b border-slate-800 gap-3">
                        <div class="bg-blue-600 text-white p-2 rounded-lg flex items-center justify-center">
                            <i class="bi bi-layers-half text-xl leading-none"></i>
                        </div>
                        <div>
                            <h1 class="text-white font-bold leading-none tracking-wide text-sm">EDUCORE</h1>
                            <span class="text-xs text-blue-400 font-semibold uppercase tracking-wider">SaaS Engine</span>
                        </div>
                    </div>

                    <nav class="p-4 space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2.5 bg-blue-600 text-white rounded-lg font-medium transition-all duration-200">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition-all duration-200">
                            <i class="bi bi-building"></i> School Tenants
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition-all duration-200">
                            <i class="bi bi-credit-card"></i> Subscriptions
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition-all duration-200">
                            <i class="bi bi-shield-lock"></i> Platform Admins
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg font-medium transition-all duration-200">
                            <i class="bi bi-sliders"></i> Global Settings
                        </a>
                    </nav>
                </div>

                <div class="p-4 border-t border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 bg-slate-700 text-white font-bold rounded-full flex items-center justify-center text-sm border border-slate-600">
                            SA
                        </div>
                        <div class="leading-tight">
                            <p class="text-sm font-semibold text-white">{{ Auth::guard('super_admin')->user()->name }}
                            </p>
                            <p class="text-xs text-slate-500">System Root</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-500 hover:text-red-400 p-1 rounded transition-colors">
                            <i class="bi bi-box-arrow-right text-lg"></i>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- MAIN -->
            <main class="flex-1 flex flex-col overflow-y-auto">

                <!-- TOP NAVBAR -->
                <header
                    class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-10">
                    <div class="flex items-center gap-4">
                        <button class="md:hidden text-slate-600 text-xl"><i class="bi bi-list"></i></button>
                        <h2 class="text-lg font-bold text-slate-800">Global Overview</h2>
                    </div>
                    <div class="flex items-center gap-4">
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Engine Online
                        </span>
                        <div class="w-px h-6 bg-slate-200"></div>
                        <p class="text-sm text-slate-500 font-medium"><i
                                class="bi bi-calendar3 mr-2"></i>{{ now()->format('M Y') }}</p>
                    </div>
                </header>

                <!-- FLASH MESSAGE -->
                @if (session('success'))
                    <div
                        class="mx-6 mt-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-lg flex items-center gap-2">
                        <i class="bi bi-check-circle-fill text-emerald-500"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- CONTENT -->
                <div class="p-6 max-w-7xl w-full mx-auto space-y-6">

                    <!-- METRIC CARDS -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        <div
                            class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Tenants</p>
                                <h3 class="text-2xl font-bold text-slate-900">{{ $metrics['total_tenants'] }}</h3>
                                <p class="text-xs text-emerald-600 font-medium"><i class="bi bi-arrow-up-short"></i>
                                    +{{ $metrics['new_this_month'] }} this month</p>
                            </div>
                            <div
                                class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>

                        <div
                            class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Active Students
                                </p>
                                <h3 class="text-2xl font-bold text-slate-900">
                                    {{ number_format($metrics['active_students']) }}</h3>
                                <p class="text-xs text-emerald-600 font-medium">Across all tenants</p>
                            </div>
                            <div
                                class="w-12 h-12 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>

                        <div
                            class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Active Platforms
                                </p>
                                <h3 class="text-2xl font-bold text-slate-900">{{ $metrics['active_tenants'] }}</h3>
                                <p class="text-xs text-slate-500 font-medium">Live & operational</p>
                            </div>
                            <div
                                class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="bi bi-activity"></i>
                            </div>
                        </div>

                        <div
                            class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">System Load</p>
                                <h3 class="text-2xl font-bold text-slate-900">1.4%</h3>
                                <p class="text-xs text-emerald-600 font-medium">Optimal Status</p>
                            </div>
                            <div
                                class="w-12 h-12 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="bi bi-cpu"></i>
                            </div>
                        </div>
                    </div>

                    <!-- FORM + TABLE -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- PROVISION FORM -->
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs lg:col-span-1">
                            <div class="mb-4">
                                <h3 class="text-base font-bold text-slate-900">Provision New School Tenant</h3>
                                <p class="text-xs text-slate-500">Deploys an isolated school database node and sets its
                                    managing Tenant Admin instantly.</p>
                            </div>

                            <form action="{{ route('tenants.store') }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">School
                                        / Organization Name</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i
                                                class="bi bi-building"></i></span>
                                        <input type="text" name="company_name" value="{{ old('company_name') }}"
                                            required placeholder="e.g., Apex International School"
                                            class="w-full pl-9 pr-3 py-2 bg-slate-50 border @error('company_name') border-red-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                    </div>
                                    @error('company_name')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Tenant
                                        Administrator Name</label>
                                    <div class="relative">
                                        <span
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i
                                                class="bi bi-person-gear"></i></span>
                                        <input type="text" name="admin_name" value="{{ old('admin_name') }}"
                                            required placeholder="e.g., Prof. Sarah Khan"
                                            class="w-full pl-9 pr-3 py-2 bg-slate-50 border @error('admin_name') border-red-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                    </div>
                                    @error('admin_name')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Tenant
                                        Admin Email</label>
                                    <div class="relative">
                                        <span
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i
                                                class="bi bi-envelope"></i></span>
                                        <input type="email" name="admin_email" value="{{ old('admin_email') }}"
                                            required placeholder="admin@apexschool.com"
                                            class="w-full pl-9 pr-3 py-2 bg-slate-50 border @error('admin_email') border-red-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                    </div>
                                    @error('admin_email')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Temporary
                                        Initial Password</label>
                                    <div class="relative">
                                        <span
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400"><i
                                                class="bi bi-key"></i></span>
                                        <input type="password" name="password" required placeholder="••••••••"
                                            class="w-full pl-9 pr-3 py-2 bg-slate-50 border @error('password') border-red-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                    </div>
                                    @error('password')
                                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-xs hover:shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer">
                                    <i class="bi bi-plus-circle"></i> Provision & Create Tenant
                                </button>
                            </form>
                        </div>

                        <!-- TENANT TABLE -->
                        <div
                            class="bg-white rounded-xl border border-slate-200 shadow-xs lg:col-span-2 overflow-hidden flex flex-col justify-between">
                            <div>
                                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-base font-bold text-slate-900">Recent Onboarded Platforms</h3>
                                        <p class="text-xs text-slate-500">Live operational statuses of newly active
                                            installations.</p>
                                    </div>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr
                                                class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                                <th class="py-3 px-6">School System</th>
                                                <th class="py-3 px-6">Slug ID</th>
                                                <th class="py-3 px-6">Primary Contact</th>
                                                <th class="py-3 px-6 text-center">Status</th>
                                                <th class="py-3 px-6 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                                            @forelse($tenants as $tenant)
                                                <tr class="hover:bg-slate-50/75 transition-colors">
                                                    <td class="py-3.5 px-6 font-semibold text-slate-900">
                                                        {{ $tenant->company_name }}</td>
                                                    <td class="py-3.5 px-6 font-mono text-xs text-slate-500">
                                                        {{ $tenant->slug }}</td>
                                                    <td class="py-3.5 px-6">{{ $tenant->admin_email }}</td>
                                                    <td class="py-3.5 px-6 text-center">
                                                        <span
                                                            class="inline-flex px-2 py-0.5 text-xs font-medium rounded-md {{ $tenant->status_badge_class }}">
                                                            {{ $tenant->status_label }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3.5 px-6 text-center">
                                                        <div class="flex items-center justify-center gap-2">
                                                            <form action="{{ route('tenants.status', $tenant) }}"
                                                                method="POST">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="status"
                                                                    value="{{ $tenant->status === 'active' ? 'idle' : 'active' }}">
                                                                <button type="submit"
                                                                    class="text-xs px-2 py-1 rounded border border-slate-200 hover:bg-slate-100 text-slate-600 transition-colors"
                                                                    title="Toggle Status">
                                                                    <i class="bi bi-arrow-left-right"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('tenants.destroy', $tenant) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Remove {{ addslashes($tenant->company_name) }}? This cannot be undone.')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-xs px-2 py-1 rounded border border-red-100 hover:bg-red-50 text-red-500 transition-colors"
                                                                    title="Delete">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5"
                                                        class="py-10 text-center text-slate-400 text-sm">
                                                        <i class="bi bi-building-slash text-2xl block mb-2"></i>
                                                        No tenants provisioned yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div
                                class="bg-slate-50 border-t border-slate-100 px-6 py-3 flex items-center justify-between text-xs text-slate-500">
                                <p>Showing {{ $tenants->firstItem() ?? 0 }}–{{ $tenants->lastItem() ?? 0 }} of
                                    {{ $tenants->total() }} Registered Tenants</p>
                                <div>{{ $tenants->links('pagination::simple-tailwind') }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
</x-layout>
