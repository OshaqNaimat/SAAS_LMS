<header class="mobile-header">
    <div class="brand-mobile">
        <div class="mini-icon"><i class="bi bi-building" style="color:white; font-size:13px;"></i></div>
        <span>{{ $organization->name ?? 'LMS' }}</span>
    </div>
    <button class="hamburger-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
</header>

<div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-building"></i></div>
        <div class="brand-text">
            <span class="org-name">{{ $organization->name ?? 'Unknown Institute' }}</span>
            <span class="org-plan">{{ $organization ? ucfirst($organization->plan) . ' Plan' : '' }}</span>
        </div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Main</div>
        <a href="/dashboard" class="nav-item"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
        <a class="nav-item" href="/admin-faculty"><i class="bi bi-people-fill"></i> Faculty</a>
        <a class="nav-item" href="/admin-classes-control"><i class="bi bi-mortarboard-fill"></i> Classes</a>
        <a class="nav-item" href="/admin-attendence-control"><i class="bi bi-calendar-check-fill"></i> Attendance</a>
        <a class="nav-item" href="/admin-schedule-control"><i class="bi bi-calendar2-week-fill"></i> Schedule</a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Management</div>
        <a class="nav-item" href="/admin-billings-control"><i class="bi bi-credit-card-fill"></i> Billing</a>
        <a class="nav-item" href="/admin-setting"><i class="bi bi-gear-fill"></i> Settings</a>
    </div>

    <div class="sidebar-spacer"></div>

    <div class="sidebar-footer">
        <div class="user-card">
            @php
                $adminName = Auth::user()->name ?? 'Admin';
                $words = explode(' ', $adminName);
                $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
            @endphp

            <div class="user-avatar">{{ $initials }}</div>
            <div class="user-info">
                <strong>{{ Auth::user()->name }}</strong>
                <small>{{ ucfirst(Auth::user()->role) }}</small>
            </div>
            <div class="logout-wrapper">
                <button type="button" class="logout-btn" title="Sign Out"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</aside>

<script>
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

    document.addEventListener('DOMContentLoaded', () => {
        const navItems = document.querySelectorAll('.sidebar .nav-item');
        const currentPath = window.location.pathname;

        navItems.forEach(item => {
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('active');
            }
            item.addEventListener('click', function() {
                navItems.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
