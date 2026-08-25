<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon text-emerald-400"><i class="bi bi-building"></i></div>
        <div class="brand-text">
            <span class="org-name">School Name</span>
            <span
                class="org-plan border border-emerald-500/30 text-emerald-400 bg-emerald-500/5 px-1.5 py-0.5 rounded text-[10px]">Faculty
                Portal</span>
        </div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Academic Core</div>

        <a href="/teacher-dashboard" class="nav-item {{ request()->is('teacher-dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i> Faculty Console
        </a>

        <a href="/teacher-timetable" class="nav-item {{ request()->is('teacher-timetable') ? 'active' : '' }}">
            <i class="bi bi-calendar2-week-fill"></i> My Schedules
        </a>

        <a href="/teacher-attendance" class="nav-item {{ request()->is('teacher-attendance') ? 'active' : '' }}">
            <i class="bi bi-calendar-check-fill"></i> Attendance Registry
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Classrooms</div>

        <a href="/teacher-classes" class="nav-item {{ request()->is('teacher-classes') ? 'active' : '' }}">
            <i class="bi bi-mortarboard-fill"></i> Assigned Batches
        </a>

        <a href="/teacher-announcements" class="nav-item {{ request()->is('teacher-announcements') ? 'active' : '' }}">
            <i class="bi bi-megaphone-fill"></i> Class Noticeboard
        </a>
    </div>

    <div class="sidebar-spacer"></div>

    <div class="sidebar-footer">
        <div
            class="user-card border border-slate-800/60 bg-slate-900/40 p-3 rounded-xl flex items-center justify-between gap-3">
            <div class="flex items-center gap-2.5 min-w-0">
                @php
                    $teacherName = Auth::user()->name ?? 'Teacher';
                    $words = explode(' ', $teacherName);
                    $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                @endphp

                <div
                    class="user-avatar w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs shrink-0">
                    {{ $initials }}
                </div>
                <div class="user-info truncate">
                    <strong class="block text-xs font-semibold text-white truncate">{{ $teacherName }}</strong>
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
<nav class="teacher-bottom-nav" id="teacherBottomNav">
    <a href="/teacher-dashboard" class="teacher-bottom-item {{ request()->is('teacher-dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill"></i>
        <span>Home</span>
    </a>

    <a href="/teacher-timetable" class="teacher-bottom-item {{ request()->is('teacher-timetable') ? 'active' : '' }}">
        <i class="bi bi-calendar2-week-fill"></i>
        <span>Schedule</span>
    </a>

    <a href="/teacher-attendance" class="teacher-bottom-item {{ request()->is('teacher-attendance') ? 'active' : '' }}">
        <i class="bi bi-calendar-check-fill"></i>
        <span>Attendance</span>
    </a>

    <a href="/teacher-classes" class="teacher-bottom-item {{ request()->is('teacher-classes') ? 'active' : '' }}">
        <i class="bi bi-mortarboard-fill"></i>
        <span>Classes</span>
    </a>

    <a href="/teacher-announcements"
        class="teacher-bottom-item {{ request()->is('teacher-announcements') ? 'active' : '' }}">
        <i class="bi bi-megaphone-fill"></i>
        <span>Notices</span>
    </a>

    <form action="/logout" method="POST" class="teacher-bottom-item logout-item">
        @csrf
        <button type="submit">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </button>
    </form>
</nav>

<style>
    /* ─── Mobile Bottom Nav ─── */
    .teacher-bottom-nav {
        display: none;
    }

    @media (max-width: 1023px) {

        /* Hide desktop sidebar */
        #sidebar,
        .sidebar {
            display: none !important;
        }

        /* Show bottom nav */
        .teacher-bottom-nav {
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

        .teacher-bottom-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            color: #64748b;
            font-size: 9px;
            font-weight: 600;
            text-decoration: none;
            height: 100%;
            min-width: 0;
            transition: color 0.15s;
            letter-spacing: 0.02em;
        }

        .teacher-bottom-item i {
            font-size: 17px;
            line-height: 1;
        }

        .teacher-bottom-item span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            padding: 0 2px;
        }

        .teacher-bottom-item.active {
            color: #34d399;
        }

        .teacher-bottom-item.logout-item {
            margin: 0;
            padding: 0;
            background: none;
            border: none;
        }

        .teacher-bottom-item.logout-item button {
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

        /* Push main content up so it doesn't hide behind bottom nav */
        main,
        .main-wrapper {
            padding-bottom: 70px !important;
        }

        /* Hide sidebar overlay — no slide-in sidebar anymore */
        .sidebar-overlay {
            display: none !important;
        }
    }

    /* ─── Desktop: sidebar visible, bottom nav hidden ─── */
    @media (min-width: 1024px) {
        .teacher-bottom-nav {
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
