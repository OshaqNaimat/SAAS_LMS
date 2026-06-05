<x-layout>
    <div class="min-h-screen bg-[#090d16] flex flex-col justify-center items-center p-4 relative overflow-y-auto">

        <div id="roleGlow"
            class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px] pointer-events-none transition-all duration-500">
        </div>

        <div class="w-full max-w-[450px] z-10 space-y-6">

            <div class="flex flex-col items-center text-center space-y-2.5">
                <div id="brandIconContainer"
                    class="w-12 h-12 rounded-2xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xl shadow-lg transition-all duration-300">
                    <i id="brandIcon" class="bi bi-building"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-white">Apex Global Institute</h1>
                    <p class="text-xs text-gray-400 mt-1">Unified Multi-Role Portal Engine</p>
                </div>
            </div>

            <div class="bg-[#111c2a] border border-slate-800 p-1.5 rounded-xl flex gap-1">
                <button type="button" onclick="switchRole('admin')" id="tab-admin"
                    class="role-tab flex-1 flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-semibold transition-all duration-200 bg-blue-600 text-white">
                    <i class="bi bi-shield-lock-fill"></i> Admin
                </button>
                <button type="button" onclick="switchRole('teacher')" id="tab-teacher"
                    class="role-tab flex-1 flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-medium text-gray-400 hover:text-white transition-all duration-200">
                    <i class="bi bi-person-workspace"></i> Teacher
                </button>
                <button type="button" onclick="switchRole('student')" id="tab-student"
                    class="role-tab flex-1 flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-medium text-gray-400 hover:text-white transition-all duration-200">
                    <i class="bi bi-mortarboard-fill"></i> Student
                </button>
            </div>

            <div
                class="bg-[#111c2a] border border-slate-800 rounded-2xl p-6 lg:p-8 shadow-2xl relative overflow-hidden">

                <div class="space-y-1 mb-6">
                    <h2 id="authHeading" class="text-base font-bold text-white">Administrative Sign In</h2>
                    <p id="authSubheading" class="text-xs text-gray-400">Enter your secure organizational credentials to
                        authenticate session keys.</p>
                </div>

                <form action="/login" method="POST" class="space-y-4" onsubmit="handleAuthSubmit(event)">
                    @csrf
                    @if ($errors->has('login_identity'))
                        <div
                            class="bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs rounded-xl p-3 mb-2 flex items-center gap-2 font-medium">
                            <i class="bi bi-exclamation-triangle-fill text-sm"></i>
                            <span>{{ $errors->first('login_identity') }}</span>
                        </div>
                    @endif

                    <input type="hidden" name="role" id="userRoleInput" value="admin">

                    @if ($errors->has('login_identity'))
                        <div
                            class="bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs rounded-xl p-3 mb-2 flex items-center gap-2">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>{{ $errors->first('login_identity') }}</span>
                        </div>
                    @endif

                    <div class="space-y-1.5">
                        <label id="identifierLabel" class="block text-xs font-semibold text-gray-400">
                            Administrative Email
                        </label>
                        <div class="relative">
                            <span id="identifierIcon"
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs pointer-events-none">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="text" id="identifierInput" name="login_identity"
                                value="{{ old('login_identity') }}" placeholder="admin@apex.edu"
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500 transition"
                                required autofocus>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-gray-400">Security Password</label>
                            <a href="/forgot-password"
                                class="text-[11px] font-medium text-blue-400 hover:text-blue-300 id-accent-text transition">
                                Forgot Key?
                            </a>
                        </div>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs pointer-events-none">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input type="password" id="authPassword" name="password" placeholder="••••••••••••"
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl pl-10 pr-10 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500 transition"
                                required>

                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition px-1">
                                <i id="visibilityIcon" class="bi bi-eye text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="rounded bg-[#090d16] border-slate-800 text-blue-600 focus:ring-0 focus:ring-offset-0 w-3.5 h-3.5 cursor-pointer">
                            <span class="text-[11px] text-gray-400 group-hover:text-gray-300 transition font-medium">
                                Keep session keys active
                            </span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" id="authSubmitBtn"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-semibold transition text-white shadow-lg shadow-blue-600/10">
                            Initialize Secure Access <i class="bi bi-arrow-right-short text-sm"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center text-[11px] text-gray-500">
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
                textClass: "text-blue-400",
                focusBorder: "focus:border-blue-500",
                shadowGlow: "bg-blue-600/5"
            },
            teacher: {
                heading: "Faculty Portal Gate",
                subheading: "Access your lecture schedules, digital logic registers, and attendance sheets.",
                label: "Official Faculty Email",
                placeholder: "professor.mercer@apex.edu",
                type: "email",
                icon: "bi-person-workspace",
                inputIcon: "bi-envelope",
                colorClass: "bg-emerald-600",
                textClass: "text-emerald-400",
                focusBorder: "focus:border-emerald-500",
                shadowGlow: "bg-emerald-600/5"
            },
            student: {
                heading: "Student Central Ledger",
                subheading: "Sign in using your portal Roll ID to check academic status and pay bills.",
                label: "Institutional Roll Number",
                placeholder: "e.g. AGI-2026-XXXX",
                type: "text",
                icon: "bi-mortarboard-fill",
                inputIcon: "bi-card-text",
                colorClass: "bg-amber-600",
                textClass: "text-amber-400",
                focusBorder: "focus:border-amber-500",
                shadowGlow: "bg-amber-600/5"
            }
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

            // Update focused visual border tokens dynamically
            identityField.className = identityField.className.replace(/focus:border-\w+-\d+/, config.focusBorder);

            // 3. Update dynamic layout icons
            document.getElementById('brandIcon').className = `bi ${config.icon}`;
            document.getElementById('identifierIcon').innerHTML = `<i class="bi ${config.inputIcon}"></i>`;

            // 4. Smoothly mutate background accent glow matrices
            document.getElementById('roleGlow').className =
                `absolute top-1/4 left-1/2 -translate-x-1/2 w-[500px] h-[500px] rounded-full blur-[120px] pointer-events-none transition-all duration-500 ${config.shadowGlow}`;

            // 5. Redraw global icon border containers to match theme
            const brandIconCont = document.getElementById('brandIconContainer');
            brandIconCont.className =
                `w-12 h-12 rounded-2xl border flex items-center justify-center text-xl shadow-lg transition-all duration-300 ${role === 'admin' ? 'bg-blue-600/10 border-blue-500/20 text-blue-400' : role === 'teacher' ? 'bg-emerald-600/10 border-emerald-500/20 text-emerald-400' : 'bg-amber-600/10 border-amber-500/20 text-amber-400'}`;

            // 6. Restructure layout tabs activation classes
            document.querySelectorAll('.role-tab').forEach(btn => {
                btn.className =
                    "role-tab flex-1 flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-medium text-gray-400 hover:text-white transition-all duration-200";
            });

            const activeTab = document.getElementById(`tab-${role}`);
            activeTab.className =
                `role-tab flex-1 flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-semibold transition-all duration-200 ${config.colorClass} text-white`;

            // Adjust link texts matching dynamic accents smoothly
            document.querySelectorAll('.id-accent-text').forEach(el => {
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
