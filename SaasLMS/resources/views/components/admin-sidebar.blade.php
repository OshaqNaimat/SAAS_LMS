<aside class="sidebar h-screen flex flex-col bg-[#0f172a]" id="sidebar">
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

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden"
                    style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</aside>

<style>
    /* ─── Mobile Sidebar ─── */
    @media (max-width: 1023px) {
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            z-index: 50;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.4);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(9, 13, 22, 0.65);
            backdrop-filter: blur(4px);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }
    }

    /* ─── Desktop Sidebar ─── */
    @media (min-width: 1024px) {
        .sidebar {
            position: relative;
            transform: translateX(0) !important;
            width: 260px;
            flex-shrink: 0;
        }

        .sidebar-overlay {
            display: none !important;
        }

        .mobile-menu-btn {
            display: none !important;
        }
    }
</style>

<script>
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
