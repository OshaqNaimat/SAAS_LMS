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
            <a href="/admin-dashboard" class="nav-item active"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a class="nav-item" href="/admin-faculty"><i class="bi bi-people-fill"></i> Faculty
                <span class="nav-badge">1,240</span>
            </a>
            <a class="nav-item" href="/admin-classes-control"><i class="bi bi-mortarboard-fill"></i> Classes <span
                    class="nav-badge">18</span></a>
            <a class="nav-item" href="/admin-attendence-control"><i class="bi bi-calendar-check-fill"></i>
                Attendence</a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Management</div>
            <a class="nav-item" href="/admin-reports-control"><i class="bi bi-bar-chart-fill"></i> Reports</a>
            <a class="nav-item" href="/admin-billings-control"><i class="bi bi-credit-card-fill"></i> Billing</a>
            {{-- <a class="nav-item" href="#"><i class="bi bi-shield-check"></i> Security</a> --}}
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
</x-layout>
