<x-layout>

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" onclick="toggleSidebar(false)">
    </div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-logo">
                <div class="logo-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <div class="logo-text">
                    <h2>Super Admin</h2>
                    <p>Platform Control</p>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="#" class="nav-item active">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-building"></i>
                    <span>Organizations</span>
                    <span class="nav-badge">12</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-people"></i>
                    <span>All Admins</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-bar-chart-line"></i>
                    <span>Analytics</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-credit-card"></i>
                    <span>Subscriptions</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-shield-check"></i>
                    <span>Security</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="bi bi-gear"></i>
                    <span>Platform Settings</span>
                </a>
            </nav>
        </div>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-info">
                    <div class="user-avatar">S</div>
                    <div class="user-text">
                        <h4>System Admin</h4>
                        <p>Super Administrator</p>
                    </div>
                </div>
                <button class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </div>
        </div>
    </aside>

</x-layout>
