<x-layout>



    <div>

        <div class="app-container">
            <!-- Success Toast -->
            <div id="successToast" class="success-toast">
                <i class="bi bi-check-circle-fill"></i>
                <span id="successToastMsg"></span>
            </div>

            <!-- Sidebar Overlay -->
            <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

            <!-- Sidebar -->
            <x-admin-sidebar />

            <!-- Main Content -->
            <div class="main-wrapper">
                <!-- Mobile Header -->
                <header class="mobile-header">
                    <div class="brand-mobile">
                        <div class="mini-icon"><i class="bi bi-building"></i></div>
                        <span>Apex Global</span>
                    </div>
                    <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Menu"><i
                            class="bi bi-list"></i></button>
                </header>

                <!-- Dashboard Scroll -->
                <div class="dashboard-scroll">
                    <div class="dashboard-content">

                        <!-- Page Header -->
                        <div class="page-header">
                            <div class="welcome-text">
                                <h1>Welcome back, Admin 👋</h1>
                                <p>Here's what's happening with your organization today.</p>
                            </div>
                            <div class="header-actions">
                                <button class="btn-secondary" onclick="openModal('inviteModal')"><i
                                        class="bi bi-person-plus"></i>
                                    Add Memeber</button>
                                <button class="btn-primary" onclick="openModal('projectModal')"><i
                                        class="bi bi-plus-lg"></i>
                                    Add New Student</button>
                            </div>
                        </div>

                        <!-- KPI Cards -->
                        <div class="kpi-grid">
                            <div class="kpi-card">
                                <div class="kpi-info">
                                    <h4>Total Revenue</h4>
                                    <div class="kpi-value">Rs {{ number_format($totalRevenue) }}</div>
                                </div>
                                <div class="kpi-icon" style="color:#60a5fa;"><i class="bi bi-currency-dollar"></i></div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-info">
                                    <h4>Total Teachers</h4>
                                    <div class="kpi-value">{{ $totalTeachers }}</div>
                                </div>
                                <div class="kpi-icon" style="color:var(--green);"><i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-info">
                                    <h4>Total Students</h4>
                                    <div class="kpi-value">{{ $totalStudents }}</div>
                                </div>
                                <div class="kpi-icon" style="color:var(--pink);"><i class="bi bi-mortarboard-fill"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Row -->
                        <div class="chart-grid grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                            <!-- Project Progress Chart -->
                            <div class="chart-card w-full border rounded-xl p-4 bg-white shadow-sm">
                                <div class="chart-card-header flex justify-between items-center mb-4">
                                    <h3 class="font-semibold text-lg">Teacher Attendance</h3>
                                    <span
                                        class="text-xs font-semibold text-blue-500 bg-blue-50 px-2.5 py-1 rounded-md">Last
                                        7 Days</span>
                                </div>
                                <div class="chart-canvas tall w-full">
                                    @php
                                        $points = collect($teacherTrend)->map(function ($pct, $i) use ($trendLabels) {
                                            $x = 30 + $i * 51;
                                            $y = 160 - ($pct / 100) * 130;
                                            return ['x' => $x, 'y' => $y, 'pct' => $pct, 'label' => $trendLabels[$i]];
                                        });
                                        $polyPoints = $points->map(fn($p) => "{$p['x']},{$p['y']}")->implode(' ');
                                    @endphp
                                    <svg viewBox="0 0 400 210" preserveAspectRatio="xMidYMid meet"
                                        class="w-full h-auto">
                                        <defs>
                                            <linearGradient id="projGrad1" x1="0%" y1="0%" x2="0%"
                                                y2="100%">
                                                <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.3" />
                                                <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:0" />
                                            </linearGradient>
                                        </defs>

                                        <!-- Horizontal gridlines at 0/25/50/75/100% -->
                                        @foreach ([0, 25, 50, 75, 100] as $mark)
                                            @php $gy = 160 - ($mark / 100 * 130); @endphp
                                            <line x1="30" y1="{{ $gy }}" x2="390"
                                                y2="{{ $gy }}" stroke="rgba(148,163,184,0.12)"
                                                stroke-width="1" />
                                            <text x="4" y="{{ $gy + 4 }}" font-size="9"
                                                fill="#94a3b8">{{ $mark }}</text>
                                        @endforeach

                                        <polygon points="{{ $polyPoints }} 390,160 30,160" fill="url(#projGrad1)" />
                                        <polyline points="{{ $polyPoints }}" fill="none" stroke="#3b82f6"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />

                                        @foreach ($points as $i => $p)
                                            <circle cx="{{ $p['x'] }}" cy="{{ $p['y'] }}"
                                                r="{{ $i === 6 ? 5 : 3.5 }}"
                                                fill="{{ $i === 6 ? '#3b82f6' : '#fff' }}" stroke="#3b82f6"
                                                stroke-width="2" />
                                            <text x="{{ $p['x'] }}" y="{{ $p['y'] - 10 }}" font-size="10"
                                                font-weight="600" text-anchor="middle"
                                                fill="#1e40af">{{ $p['pct'] }}%</text>
                                            <text x="{{ $p['x'] }}" y="185" font-size="10" text-anchor="middle"
                                                fill="#64748b">{{ $p['label'] }}</text>
                                        @endforeach
                                    </svg>
                                </div>
                            </div>

                            <div class="chart-card w-full border rounded-xl p-4 bg-white shadow-sm">
                                <div class="chart-card-header flex justify-between items-center mb-4">
                                    <h3 class="font-semibold text-lg">Student Attendance</h3>
                                    <span
                                        class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-2.5 py-1 rounded-md">Last
                                        7 Days</span>
                                </div>
                                <div class="chart-canvas tall w-full">
                                    @php
                                        $points2 = collect($studentTrend)->map(function ($pct, $i) use ($trendLabels) {
                                            $x = 30 + $i * 51;
                                            $y = 160 - ($pct / 100) * 130;
                                            return ['x' => $x, 'y' => $y, 'pct' => $pct, 'label' => $trendLabels[$i]];
                                        });
                                        $polyPoints2 = $points2->map(fn($p) => "{$p['x']},{$p['y']}")->implode(' ');
                                    @endphp
                                    <svg viewBox="0 0 400 210" preserveAspectRatio="xMidYMid meet"
                                        class="w-full h-auto">
                                        <defs>
                                            <linearGradient id="projGrad2" x1="0%" y1="0%"
                                                x2="0%" y2="100%">
                                                <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.3" />
                                                <stop offset="100%" style="stop-color:#10b981;stop-opacity:0" />
                                            </linearGradient>
                                        </defs>

                                        @foreach ([0, 25, 50, 75, 100] as $mark)
                                            @php $gy2 = 160 - ($mark / 100 * 130); @endphp
                                            <line x1="30" y1="{{ $gy2 }}" x2="390"
                                                y2="{{ $gy2 }}" stroke="rgba(148,163,184,0.12)"
                                                stroke-width="1" />
                                            <text x="4" y="{{ $gy2 + 4 }}" font-size="9"
                                                fill="#94a3b8">{{ $mark }}</text>
                                        @endforeach

                                        <polygon points="{{ $polyPoints2 }} 390,160 30,160"
                                            fill="url(#projGrad2)" />
                                        <polyline points="{{ $polyPoints2 }}" fill="none" stroke="#10b981"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />

                                        @foreach ($points2 as $i => $p)
                                            <circle cx="{{ $p['x'] }}" cy="{{ $p['y'] }}"
                                                r="{{ $i === 6 ? 5 : 3.5 }}"
                                                fill="{{ $i === 6 ? '#10b981' : '#fff' }}" stroke="#10b981"
                                                stroke-width="2" />
                                            <text x="{{ $p['x'] }}" y="{{ $p['y'] - 10 }}" font-size="10"
                                                font-weight="600" text-anchor="middle"
                                                fill="#047857">{{ $p['pct'] }}%</text>
                                            <text x="{{ $p['x'] }}" y="185" font-size="10" text-anchor="middle"
                                                fill="#64748b">{{ $p['label'] }}</text>
                                        @endforeach
                                    </svg>
                                </div>
                            </div>


                        </div>

                        <!-- Quick Stats Row -->
                        {{-- <div class="quick-stats-row">
                            <div class="quick-stat">
                                <div class="quick-stat-icon"
                                    style="background:rgba(52,211,153,0.1); color:var(--green);">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="quick-stat-info">
                                    <h5>Active Members</h5>
                                    <strong>1,198</strong>
                                </div>
                            </div>
                            <div class="quick-stat">
                                <div class="quick-stat-icon"
                                    style="background:rgba(251,191,36,0.1); color:var(--yellow);">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="quick-stat-info">
                                    <h5>Pending Invites</h5>
                                    <strong>42</strong>
                                </div>
                            </div>
                            <div class="quick-stat">
                                <div class="quick-stat-icon"
                                    style="background:rgba(59,130,246,0.1); color:var(--blue);">
                                    <i class="bi bi-kanban-fill"></i>
                                </div>
                                <div class="quick-stat-info">
                                    <h5>Open Tasks</h5>
                                    <strong>156</strong>
                                </div>
                            </div>
                            <div class="quick-stat">
                                <div class="quick-stat-icon"
                                    style="background:rgba(244,114,182,0.1); color:var(--pink);">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div class="quick-stat-info">
                                    <h5>Productivity</h5>
                                    <strong>94%</strong>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Recent Members Table -->
                        <div class="chart-card">
                            <div class="chart-card-header">
                                <h3>Recent Team Members</h3>
                                <a href="{{ route('admin.faculty') }}"
                                    style="font-size:0.72rem; color:#60a5fa; text-decoration:none; font-weight:600;">View
                                    All →</a>
                            </div>
                            <table class="table-mini">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Role</th>
                                        <th>Class / Section</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentMembers as $member)
                                        <tr>
                                            <td><strong style="color:white;">{{ $member->name }}</strong></td>
                                            <td>{{ ucfirst($member->role) }}</td>
                                            <td>
                                                {{ $member->role === 'teacher' ? $member->assigned_class ?? '—' : ($member->class ? $member->class . ' - ' . $member->section : '—') }}
                                            </td>
                                            <td>
                                                <span class="status-dot-sm" style="background:var(--green);"></span>
                                                Active
                                            </td>
                                            <td style="font-size:0.7rem;">{{ $member->created_at->format('M Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"
                                                style="text-align:center; color:#94a3b8; font-size:0.8rem;">No members
                                                yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Invite Member Modal -->
        <div id="inviteModal" class="modal-overlay" role="dialog" aria-modal="true">
            <div class="modal">
                <div class="modal-header">
                    <h3><i class="bi bi-person-plus" style="color:#3b82f6;"></i> Add New Teacher</h3>
                    <button class="modal-close" onclick="closeModal('inviteModal')"><i
                            class="bi bi-x-lg"></i></button>
                </div>

                <form action="{{ route('admin.add-teacher') }}" method="POST">
                    @csrf

                    <input type="hidden" name="role" value="teacher">

                    <div class="modal-body space-y-4">
                        <div class="form-group">
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Teacher Full Name</label>
                            <input type="text" name="name" placeholder="Prof. Mashood" required
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500 transition">
                        </div>

                        <div class="form-group">
                            <label class="block text-xs font-semibold text-gray-400 mb-1">Email Address</label>
                            <input type="email" name="email" placeholder="teacher@apex.edu" required
                                class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500 transition">
                        </div>

                        <div class="form-row grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="block text-xs font-semibold text-gray-400 mb-1">Security Password</label>
                                <input type="password" name="password" placeholder="••••••••" required
                                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-700 focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <div class="form-group">
                                <label class="block text-xs font-semibold text-gray-400 mb-1">Assigned Classes</label>
                                <select name="assigned_class"
                                    class="w-full bg-[#090d16] border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-gray-400 focus:outline-none focus:border-blue-500 transition">
                                    <option value="">Select Class...</option>
                                    <option value="Class 1">Class 1</option>
                                    <option value="Class 2">Class 2</option>
                                    <option value="Class 3">Class 3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer flex justify-end gap-2 pt-4 border-t border-slate-800/60 mt-4">
                        <button type="button"
                            class="px-4 py-2 rounded-xl bg-slate-900 border border-slate-800 text-gray-400 text-xs font-medium"
                            onclick="closeModal('inviteModal')">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-500 transition shadow-lg shadow-blue-600/10">
                            Register Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- New Project Modal -->
        <div id="projectModal" class="modal-overlay" role="dialog" aria-modal="true">
            <div class="modal">
                <div class="modal-header">
                    <h3><i class="bi bi-plus-lg" style="color:#3b82f6;"></i> Add New Student</h3>
                    <button type="button" class="modal-close" onclick="closeModal('projectModal')"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form action="{{ route('admin.add-student') }}" method="POST">
                    @csrf

                    <input type="hidden" name="role" value="student">

                    <div class="modal-body">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="form-group">
                                <label class="block font-medium mb-1 text-sm text-gray-300">Student Name</label>
                                <input type="text" name="name" placeholder="Enter student name" required
                                    class="w-full bg-[#090d16] border border-slate-800 text-white rounded p-2 text-sm focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="form-group">
                                <label class="block font-medium mb-1 text-sm text-gray-300">Father Name</label>
                                <input type="text" name="father_name" placeholder="Enter father's name" required
                                    class="w-full bg-[#090d16] border border-slate-800 text-white rounded p-2 text-sm focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="form-group">
                                <label class="block font-medium mb-1 text-sm text-gray-300">Student Roll No.</label>
                                <input type="text" name="roll_number" placeholder="Enter roll number" required
                                    class="w-full bg-[#090d16] border border-slate-800 text-white rounded p-2 text-sm focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="form-group">
                                <label class="block font-medium mb-1 text-sm text-gray-300">Class</label>
                                <input type="text" name="class" placeholder="Enter class" required
                                    class="w-full bg-[#090d16] border border-slate-800 text-white rounded p-2 text-sm focus:outline-none focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="block font-medium mb-1 text-sm text-gray-300">Section</label>
                                <input type="text" name="section" placeholder="Enter section" required
                                    class="w-full bg-[#090d16] border border-slate-800 text-white rounded p-2 text-sm focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="form-group">
                                <label class="block font-medium mb-1 text-sm text-gray-300">Password</label>
                                <input type="password" name="password" placeholder="••••••••" required
                                    class="w-full bg-[#090d16] border border-slate-800 text-white rounded p-2 text-sm focus:outline-none focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-cancel"
                            onclick="closeModal('projectModal')">Cancel</button>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-lg"></i> Add Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Sidebar toggle
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show', sidebar.classList.contains('open'));
            }

            function closeSidebar() {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('show');
            }

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) closeSidebar();
            });

            // Modal management
            function openModal(id) {
                document.getElementById(id).classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeModal(id) {
                document.getElementById(id).classList.remove('open');
                const openModals = document.querySelectorAll('.modal-overlay.open');
                if (openModals.length === 0) {
                    document.body.style.overflow = '';
                }
            }

            // Close modals on overlay click
            document.querySelectorAll('.modal-overlay').forEach(overlay => {
                overlay.addEventListener('click', function(e) {
                    if (e.target === this) closeModal(this.id);
                });
            });

            // Escape key
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal-overlay.open').forEach(m => closeModal(m.id));
                }
            });

            // Prevent body scroll when sidebar open on mobile
            const sidebarObserver = new MutationObserver(() => {
                const sidebar = document.getElementById('sidebar');
                if (window.innerWidth < 1024) {
                    document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
                }
            });
            sidebarObserver.observe(document.getElementById('sidebar'), {
                attributes: true,
                attributeFilter: ['class']
            });


            function showToast(message) {
                const toast = document.getElementById('successToast');
                const msg = document.getElementById('successToastMsg');
                msg.textContent = message;
                toast.classList.add('show');

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 2500); // disappears after 2.5s
            }

            @if (session('success'))
                window.addEventListener('DOMContentLoaded', () => {
                    showToast(@json(session('success')));
                });
            @endif
        </script>
    </div>

</x-layout>
