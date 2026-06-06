<x-layout>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="bi bi-building"></i></div>
            <div class="brand-text">
                <span class="org-name">Apex Global Institute</span>
                <span class="org-plan">Enterprise Plan</span>
            </div>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Main</div>
            <a href="/dashboard" class="nav-item"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a class="nav-item" href="/admin-faculty"><i class="bi bi-people-fill"></i> Faculty
                <span class="nav-badge">1,240</span>
            </a>
            <a class="nav-item" href="/admin-classes-control"><i class="bi bi-mortarboard-fill"></i> Classes
                <span class="nav-badge">18</span>
            </a>
            <a class="nav-item" href="/admin-attendence-control"><i class="bi bi-calendar-check-fill"></i>
                Attendance</a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Management</div>
            <a class="nav-item" href="/admin-reports-control"><i class="bi bi-bar-chart-fill"></i> Reports</a>
            <a class="nav-item" href="/admin-billings-control"><i class="bi bi-credit-card-fill"></i> Billing</a>
            <a class="nav-item" href="/admin-setting"><i class="bi bi-gear-fill"></i> Settings</a>
        </div>

        <div class="sidebar-spacer"></div>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">AM</div>
                <div class="user-info">
                    <strong>Alex Mercer</strong>
                    <small>Org Admin</small>
                </div>
                <button class="logout-btn" title="Sign Out"><i class="bi bi-box-arrow-right"></i></button>
            </div>
        </div>
    </aside>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navItems = document.querySelectorAll('.sidebar .nav-item');
            const currentPath = window.location.pathname;

            navItems.forEach(item => {
                // 1. Highlight based on the current active URL page on page load
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }

                // 2. Click event listener to switch classes instantaneously
                item.addEventListener('click', function() {
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</x-layout>
