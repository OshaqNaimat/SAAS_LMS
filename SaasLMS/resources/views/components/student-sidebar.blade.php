<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon text-blue-400"><i class="bi bi-mortarboard-fill"></i></div>
        <div class="brand-text">
            <span class="org-name">Apex College</span>
            <span
                class="org-plan border border-blue-500/30 text-blue-400 bg-blue-500/5 px-1.5 py-0.5 rounded text-[10px]">Student
                Portal</span>
        </div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Navigation</div>
        <a href="/student-dashboard" class="nav-item {{ request()->is('student-dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> My Dashboard
        </a>
        <a href="/student-attendance" class="nav-item {{ request()->is('student-attendance') ? 'active' : '' }}">
            <i class="bi bi-calendar3"></i> Timetable & Attendance
        </a>
    </div>

    <div class="sidebar-spacer"></div>

    <div class="sidebar-footer">
        <div
            class="user-card border border-slate-800/60 bg-slate-900/40 p-3 rounded-xl flex items-center justify-between gap-3">
            <div class="flex items-center gap-2.5 min-w-0">
                @php
                    $studentName = Auth::user()->name ?? 'Student';
                    $rollNumber = Auth::user()->roll_number ?? 'N/A';
                    $words = explode(' ', $studentName);
                    $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                @endphp

                <div
                    class="user-avatar w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center font-bold text-xs shrink-0">
                    {{ $initials }}
                </div>
                <div class="user-info truncate">
                    <strong class="block text-xs font-semibold text-white truncate">{{ $studentName }}</strong>
                    <small class="block text-[10px] text-gray-400 truncate">Roll No: {{ $rollNumber }}</small>
                </div>
            </div>
            <form action="/logout" method="POST" class="m-0 flex items-center">
                @csrf
                <button type="submit" class="logout-btn p-1.5 text-gray-500 hover:text-rose-400 rounded-lg transition"
                    title="Sign Out">
                    <i class="bi bi-box-arrow-right text-sm"></i>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- ════════════════════════════════════════
     MOBILE BOTTOM NAVIGATION
     ════════════════════════════════════════ -->
<nav class="student-bottom-nav" id="studentBottomNav">
    <a href="/student-dashboard" class="student-bottom-item {{ request()->is('student-dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Dashboard</span>
    </a>

    <a href="/student-attendance" class="student-bottom-item {{ request()->is('student-attendance') ? 'active' : '' }}">
        <i class="bi bi-calendar3"></i>
        <span>Timetable</span>
    </a>

    <form action="/logout" method="POST" class="student-bottom-item logout-item">
        @csrf
        <button type="submit">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </button>
    </form>
</nav>

<style>
    /* ─── Mobile Bottom Nav ─── */
    .student-bottom-nav {
        display: none;
    }

    @media (max-width: 1023px) {

        #sidebar,
        .sidebar {
            display: none !important;
        }

        .student-bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: #0f172a;
            border-top: 1px solid rgba(148, 163, 184, 0.1);
            z-index: 100;
            justify-content: space-around;
            align-items: center;
            padding-bottom: env(safe-area-inset-bottom);
        }

        .student-bottom-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            color: #64748b;
            font-size: 10px;
            font-weight: 600;
            text-decoration: none;
            height: 100%;
            min-width: 0;
            transition: color 0.15s;
            letter-spacing: 0.02em;
        }

        .student-bottom-item i {
            font-size: 18px;
            line-height: 1;
        }

        .student-bottom-item span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            padding: 0 2px;
        }

        .student-bottom-item.active {
            color: #60a5fa;
        }

        .student-bottom-item.logout-item {
            margin: 0;
            padding: 0;
            background: none;
            border: none;
        }

        .student-bottom-item.logout-item button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            width: 100%;
            height: 100%;
            background: none;
            border: none;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-weight: inherit;
            cursor: pointer;
            padding: 0;
        }

        main,
        .main-wrapper {
            padding-bottom: 70px !important;
        }

        .sidebar-overlay {
            display: none !important;
        }
    }

    @media (min-width: 1024px) {
        .student-bottom-nav {
            display: none !important;
        }

        #sidebar,
        .sidebar {
            display: flex !important;
        }

        main,
        .main-wrapper {
            padding-bottom: 0 !important;
        }
    }
</style>
