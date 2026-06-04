<x-layout>
    <div class="flex h-screen bg-[#090d16] overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">System Settings</h1>
                    <p class="text-sm text-gray-400 mt-1">Configure your institute rules, update metadata parameters, and
                        manage administrative safety presets.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start mb-8">

                <div class="space-y-2 lg:sticky lg:top-6 bg-[#111c2a] border border-slate-800 rounded-2xl p-4 shrink-0">
                    <a href="#profile"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-blue-600/10 text-blue-400 font-semibold text-sm transition border border-blue-500/20">
                        <i class="bi bi-building"></i> Institutional Profile
                    </a>
                    <a href="#academic"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-400 hover:bg-slate-900/40 hover:text-white font-medium text-sm transition border border-transparent">
                        <i class="bi bi-mortarboard"></i> Academic Configurations
                    </a>
                    <a href="#security"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-400 hover:bg-slate-900/40 hover:text-white font-medium text-sm transition border border-transparent">
                        <i class="bi bi-shield-lock"></i> Password & Security
                    </a>
                </div>

                <div class="lg:col-span-2 space-y-6">

                    <section id="profile" class="bg-[#111c2a] border border-slate-800 rounded-2xl p-6 space-y-6">
                        <div class="border-b border-slate-800 pb-4">
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <i class="bi bi-building text-blue-400"></i> Institute Details
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">Update primary global identifying names and license
                                text fields displayed across generated headers.</p>
                        </div>

                        <form class="space-y-4"
                            onsubmit="handleSettingsSave(event, 'Institutional profile settings updated successfully!')">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">Organization Name</label>
                                    <input type="text" value="Apex Global Institute"
                                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500"
                                        required>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">Enterprise Registry
                                        Tier</label>
                                    <input type="text" value="Enterprise Plan"
                                        class="w-full bg-[#090d16]/60 border border-slate-800/80 rounded-xl px-4 py-2.5 text-sm text-gray-500 cursor-not-allowed focus:outline-none"
                                        readonly>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">Primary Contact
                                        Email</label>
                                    <input type="email" value="admin@apex.edu"
                                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500"
                                        required>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">Institutional Contact
                                        Desk</label>
                                    <input type="text" value="+92 21 111 273 9"
                                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500">
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="px-5 py-2 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </section>

                    <section id="academic" class="bg-[#111c2a] border border-slate-800 rounded-2xl p-6 space-y-6">
                        <div class="border-b border-slate-800 pb-4">
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <i class="bi bi-mortarboard text-blue-400"></i> Academic Configurations
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">Establish active terms and baseline currency
                                configuration masks for non-Stripe direct transaction tables.</p>
                        </div>

                        <form class="space-y-4"
                            onsubmit="handleSettingsSave(event, 'Academic parameters configured updated successfully!')">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">Active Tracking Fiscal
                                        Year</label>
                                    <div class="relative">
                                        <select
                                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 appearance-none">
                                            <option value="2026" selected>Year 2026 Baseline</option>
                                            <option value="2025">Year 2025 Archive</option>
                                        </select>
                                        <i
                                            class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">Currency Localization
                                        Code</label>
                                    <div class="relative">
                                        <select
                                            class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 appearance-none">
                                            <option value="PKR" selected>PKR (Pakistani Rupee)</option>
                                            <option value="USD">USD (United States Dollar)</option>
                                        </select>
                                        <i
                                            class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 pt-2">
                                <label class="block text-xs font-semibold text-gray-400">Automation Settings</label>
                                <div
                                    class="flex items-center justify-between p-3 bg-[#090d16] border border-slate-800 rounded-xl">
                                    <div class="space-y-0.5">
                                        <h5 class="text-xs font-bold text-white">Auto-generate Challan Invoices</h5>
                                        <p class="text-[11px] text-gray-400">Create pending review items at term
                                            enrollment.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div
                                            class="w-9 h-5 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-gray-400 peer-checked:after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="px-5 py-2 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                                    Save Parameters
                                </button>
                            </div>
                        </form>
                    </section>

                    <section id="security" class="bg-[#111c2a] border border-slate-800 rounded-2xl p-6 space-y-6">
                        <div class="border-b border-slate-800 pb-4">
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <i class="bi bi-shield-lock text-blue-400"></i> Password & Security
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">Keep administrative accounts secured by rotating
                                active passwords frequently.</p>
                        </div>

                        <form class="space-y-4"
                            onsubmit="handleSettingsSave(event, 'Security access password modified safely!')">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-semibold text-gray-400">Current Login Password</label>
                                <input type="password" placeholder="••••••••••••"
                                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500"
                                    required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">New Account
                                        Password</label>
                                    <input type="password" placeholder="Min. 8 characters"
                                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500"
                                        required>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-400">Confirm Security
                                        Mask</label>
                                    <input type="password" placeholder="Match new password"
                                        class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500"
                                        required>
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="px-5 py-2 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white transition shadow-lg shadow-blue-600/10">
                                    Update Security Key
                                </button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </main>
    </div>

    <div id="toastAlert"
        class="fixed bottom-6 right-6 z-[200] flex items-center gap-3 bg-slate-900 border border-emerald-500/30 text-emerald-400 text-xs font-semibold px-4 py-3 rounded-xl shadow-2xl transition-all duration-300 transform opacity-0 translate-y-4 pointer-events-none">
        <i class="bi bi-check-circle-fill text-sm"></i>
        <span id="toastMessage">Configuration saved successfully!</span>
    </div>

    <script>
        function handleSettingsSave(event, customMessage) {
            event.preventDefault();

            const toast = document.getElementById('toastAlert');
            const messageSpan = document.getElementById('toastMessage');

            if (toast && messageSpan) {
                messageSpan.innerText = customMessage;

                toast.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                toast.classList.add('opacity-100', 'translate-y-0');

                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-y-0');
                    toast.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                }, 3500);
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('show');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });
    </script>
</x-layout>
