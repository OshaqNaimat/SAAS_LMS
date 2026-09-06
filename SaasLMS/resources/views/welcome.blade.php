<x-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center items-center p-4 relative overflow-y-hidden">

        <div id="roleGlow"
            class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-blue-100/40 rounded-full blur-[120px] pointer-events-none transition-all duration-500">
        </div>

        <div class="w-full max-w-[450px] z-10 space-y-6">

            <div class="flex flex-col items-center text-center space-y-2.5">
                <div id="brandIconContainer"
                    class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 text-xl shadow-sm transition-all duration-300">
                    <i id="brandIcon" class="bi bi-building"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-gray-900">Name <span
                            class="text-blue-600">Name</span>
                    </h1>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-6 lg:p-8 shadow-md relative overflow-hidden">

                <div class="space-y-1 mb-6">
                    <h2 id="authHeading" class="text-base font-bold text-gray-900">Sign In</h2>
                    <p id="authSubheading" class="text-xs text-gray-500">Enter your secure organizational credentials to
                        authenticate session keys.</p>
                </div>

                <form action="/login" method="POST" class="space-y-4" onsubmit="handleAuthSubmit(event)">
                    @csrf

                    @if ($errors->has('login_identity'))
                        <div
                            class="bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl p-3 mb-2 flex items-center gap-2 font-medium">
                            <i class="bi bi-exclamation-triangle-fill text-sm"></i>
                            <span>{{ $errors->first('login_identity') }}</span>
                        </div>
                    @endif

                    <input type="hidden" name="role" id="userRoleInput" value="admin">

                    <div class="space-y-1.5">
                        <label id="identifierLabel" class="block text-xs font-semibold text-gray-600">
                            Email (Student Should Enter Their Roll Number)
                        </label>
                        <div class="relative">
                            <span id="identifierIcon"
                                class="absolute left-4 inset-y-0 flex items-center text-gray-400 pointer-events-none">
                                <i class="bi bi-envelope text-xs"></i>
                            </span>

                            <input type="text" id="identifierInput" name="login_identity"
                                value="{{ old('login_identity') }}" placeholder="Student Roll Number / Faculty Email "
                                class="w-full bg-white border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition"
                                required autofocus>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-gray-600">Security Password</label>
                        </div>
                        <div class="relative">
                            <span
                                class="absolute left-4 inset-y-0 flex items-center text-gray-400 text-xs pointer-events-none">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input type="password" id="authPassword" name="password" placeholder="••••••••••••"
                                class="w-full bg-white border border-gray-300 rounded-xl pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition"
                                required>

                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute right-3 inset-y-0 flex items-center text-gray-400 hover:text-gray-600 transition px-1">
                                <i id="visibilityIcon" class="bi bi-eye text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="authSubmitBtn"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold transition text-white shadow-lg shadow-blue-600/10">
                            Access Dashboard <i class="bi bi-arrow-right-short text-sm"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center text-[11px] text-gray-400">
                Protected by secondary institutional encryption masks.<br>
                &copy; 2026 Apex Global Systems. All privileges cataloged.
            </div>
        </div>
    </div>

    <script>
        // Configuration Map matching distinct structural theme layouts dynamically
        const roleConfig = {
            admin: {
                heading: "Administrative Sign In",
                subheading: "Enter your secure organizational credentials to authenticate session keys.",
                label: "Administrative Email",
                placeholder: "admin@apex.edu",
                type: "email",
                icon: "bi-building",
                inputIcon: "bi-envelope",
                colorClass: "bg-blue-600",
                textClass: "text-blue-600",
                focusBorder: "focus:border-blue-500",
                shadowGlow: "bg-blue-100/40"
            },
            // You can add teacher/student configs here if needed
        };

        function switchRole(role) {
            const config = roleConfig[role];

            // 1. Update active hidden form payload field context
            document.getElementById('userRoleInput').value = role;

            // 2. Refresh textual layouts inside active panel blocks
            document.getElementById('authHeading').innerText = config.heading;
            document.getElementById('authSubheading').innerText = config.subheading;
            document.getElementById('identifierLabel').innerText = config.label;

            const identityField = document.getElementById('identifierInput');
            identityField.placeholder = config.placeholder;
            identityField.type = config.type;
            identityField.value = ""; // Clean input across swaps

            // SAFELY MUTATE TAILWIND FOCUS BORDERS WITHOUT REGEX BREAKS
            identityField.classList.remove('focus:border-blue-500', 'focus:border-emerald-500', 'focus:border-amber-500');
            identityField.classList.add(config.focusBorder);

            // 3. Update dynamic layout icons
            document.getElementById('brandIcon').className = `bi ${config.icon}`;
            document.getElementById('identifierIcon').innerHTML = `<i class="bi ${config.inputIcon}"></i>`;

            // 4. Smoothly mutate background accent glow matrices
            document.getElementById('roleGlow').className =
                `absolute top-1/4 left-1/2 -translate-x-1/2 w-[500px] h-[500px] rounded-full blur-[120px] pointer-events-none transition-all duration-500 ${config.shadowGlow}`;

            // 5. Redraw global icon border containers to match theme
            const brandIconCont = document.getElementById('brandIconContainer');
            brandIconCont.className =
                `w-12 h-12 rounded-2xl border flex items-center justify-center text-xl shadow-sm transition-all duration-300 ${role === 'admin' ? 'bg-blue-50 border-blue-200 text-blue-600' : role === 'teacher' ? 'bg-emerald-50 border-emerald-200 text-emerald-600' : 'bg-amber-50 border-amber-200 text-amber-600'}`;

            // 6. Restructure layout tabs activation classes (if any)
            document.querySelectorAll('.role-tab')?.forEach(btn => {
                btn.className =
                    "role-tab flex-1 flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-medium text-gray-500 hover:text-gray-700 transition-all duration-200";
            });

            const activeTab = document.getElementById(`tab-${role}`);
            if (activeTab) {
                activeTab.className =
                    `role-tab flex-1 flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-semibold transition-all duration-200 ${config.colorClass} text-white`;
            }

            // Adjust link texts matching dynamic accents smoothly
            document.querySelectorAll('.id-accent-text')?.forEach(el => {
                el.className = `text-[11px] font-medium id-accent-text transition ${config.textClass}`;
            });

            // Re-adjust button active coloration metrics
            const submitBtn = document.getElementById('authSubmitBtn');
            submitBtn.className =
                `w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold transition text-white shadow-lg ${config.colorClass}`;
        }

        function togglePasswordVisibility() {
            const passInput = document.getElementById('authPassword');
            const icon = document.getElementById('visibilityIcon');

            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        function handleAuthSubmit(event) {
            const btn = document.getElementById('authSubmitBtn');
            btn.disabled = true;
            btn.innerHTML =
                `<span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span> Checking Key Syncs...`;
        }
    </script>
</x-layout>
