<x-layout>
    <div class="flex h-screen bg-gray-50 overflow-hidden relative">

        <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

        <x-admin-sidebar />

        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-6 lg:p-8">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">System Settings</h1>
                    <p class="text-sm text-gray-500 mt-1">Configure your institute rules, update metadata parameters, and
                        manage administrative safety presets.</p>
                </div>
                <button onclick="toggleSidebar()" class="hamburger-btn lg:hidden self-start sm:self-center"
                    aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start mb-8">

                <!-- ─── SIDEBAR NAV ─── -->
                <div
                    class="space-y-2 lg:sticky lg:top-6 bg-white border border-gray-200 rounded-2xl p-4 shrink-0 shadow-sm">
                    <a href="#profile"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-blue-50 text-blue-600 font-semibold text-sm transition border border-blue-200">
                        <i class="bi bi-building"></i> Institutional Profile
                    </a>
                    <a href="#security"
                        class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-gray-100 hover:text-gray-800 font-medium text-sm transition border border-transparent">
                        <i class="bi bi-shield-lock"></i> Password & Security
                    </a>
                </div>

                <div class="lg:col-span-2 space-y-6">

                    <!-- ─── INSTITUTE DETAILS ─── -->
                    <section id="profile" class="bg-white border border-gray-200 rounded-2xl p-6 space-y-6 shadow-sm">
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                <i class="bi bi-building text-blue-600"></i> Institute Details
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">Organization name and plan are managed by the platform
                                administrator. You can update your contact details below.</p>
                        </div>

                        <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-500">Organization Name</label>
                                    <input type="text" name="org_name"
                                        value="{{ old('org_name', $organization->name) }}"
                                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition"
                                        required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-500">Primary Contact
                                        Email</label>
                                    <input type="email" name="contact_email"
                                        value="{{ old('contact_email', $organization->contact_email) }}"
                                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition"
                                        required>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-500">Institutional Contact
                                        Desk</label>
                                    <input type="text" name="contact_phone"
                                        value="{{ old('contact_phone', $organization->contact_phone) }}"
                                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition">
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

                    <!-- ─── PASSWORD & SECURITY ─── -->
                    <section id="security" class="bg-white border border-gray-200 rounded-2xl p-6 space-y-6 shadow-sm">
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                <i class="bi bi-shield-lock text-blue-600"></i> Password & Security
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">Keep administrative accounts secured by rotating
                                active passwords frequently.</p>
                        </div>

                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl p-3">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="space-y-1.5">
                                <label class="block text-xs font-semibold text-gray-500">Current Login Password</label>
                                <input type="password" name="current_password" placeholder="••••••••••••"
                                    class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition"
                                    required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-500">New Account
                                        Password</label>
                                    <input type="password" name="new_password" placeholder="Min. 8 characters"
                                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition"
                                        required minlength="8">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-semibold text-gray-500">Confirm Security
                                        Mask</label>
                                    <input type="password" name="new_password_confirmation"
                                        placeholder="Match new password"
                                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:border-blue-500 transition"
                                        required minlength="8">
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

    <!-- ─── TOAST ─── -->
    <div id="toastAlert"
        class="fixed bottom-6 right-6 z-[200] flex items-center gap-3 bg-white border border-emerald-200 text-emerald-700 text-xs font-semibold px-4 py-3 rounded-xl shadow-lg transition-all duration-300 transform opacity-0 translate-y-4 pointer-events-none">
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

        function showToast(message, isError = false) {
            const toast = document.getElementById('toastAlert');
            const messageSpan = document.getElementById('toastMessage');

            if (isError) {
                toast.classList.remove('border-emerald-200', 'text-emerald-700');
                toast.classList.add('border-red-200', 'text-red-600');
            } else {
                toast.classList.remove('border-red-200', 'text-red-600');
                toast.classList.add('border-emerald-200', 'text-emerald-700');
            }

            messageSpan.innerText = message;
            toast.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
            toast.classList.add('opacity-100', 'translate-y-0');

            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
            }, 3500);
        }

        @if (session('success'))
            document.addEventListener('DOMContentLoaded', () => {
                showToast(@json(session('success')));
            });
        @endif

        /* ─── Sidebar Toggle ─── */
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                sidebar.classList.add('open');
                overlay.classList.add('show');
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
