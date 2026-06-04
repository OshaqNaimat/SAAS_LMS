<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon text-emerald-400"><i class="bi bi-building"></i></div>
        <div class="brand-text">
            <span class="org-name">Apex Global Institute</span>
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

        <a href="/teacher-schedules" class="nav-item {{ request()->is('teacher-schedules') ? 'active' : '' }}">
            <i class="bi bi-calendar2-week-fill"></i> My Schedules
            <span class="nav-badge bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">2 Today</span>
        </a>

        <a href="/teacher-attendance" class="nav-item {{ request()->is('teacher-attendance') ? 'active' : '' }}">
            <i class="bi bi-calendar-check-fill"></i> Attendance Registry
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Classrooms</div>

        <a href="/teacher-batches" class="nav-item {{ request()->is('teacher-batches') ? 'active' : '' }}">
            <i class="bi bi-mortarboard-fill"></i> Assigned Batches
            <span class="nav-badge">4</span>
        </a>

        {{-- <a href="/teacher-appraisals" class="nav-item {{ request()->is('teacher-appraisals') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-ruled-fill"></i> Labs & Appraisals
            <span class="nav-badge bg-amber-500/10 text-amber-400 border border-amber-500/20">18 New</span>
        </a> --}}

        <a href="/teacher-announcements" class="nav-item {{ request()->is('teacher-announcements') ? 'active' : '' }}">
            <i class="bi bi-megaphone-fill"></i> Class Noticeboard
        </a>
    </div>

    <div class="sidebar-spacer"></div>

    <div class="sidebar-footer">
        <div
            class="user-card border border-slate-800/60 bg-slate-900/40 p-3 rounded-xl flex items-center justify-between gap-3">
            <div class="flex items-center gap-2.5 min-w-0">
                <div
                    class="user-avatar w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs shrink-0">
                    AM
                </div>
                <div class="user-info truncate">
                    <strong class="block text-xs font-semibold text-white truncate">Alex Mercer</strong>
                    <small class="block text-[10px] text-gray-400 truncate">Senior Professor</small>
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
