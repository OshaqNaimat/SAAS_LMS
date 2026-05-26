<x-layout>



    <div>
        <!-- SIDEBAR -->
        <x-superadmin-sidebar />

        <!-- SIDEBAR OVERLAY (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- MAIN WRAPPER -->
        <div class="main-wrapper">
            <!-- HEADER -->
            <header class="header">
                <div class="header-left">
                    <button class="hamburger-btn" id="hamburgerBtn">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="header-title">
                        <h1>Platform Overview</h1>
                        <p class="header-subtitle">Welcome back! Here's what's happening.</p>
                    </div>
                </div>

                <div class="header-right">
                    <div class="search-box">
                        <i class="search-icon bi bi-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>

                    <button class="icon-btn" title="Notifications">
                        <i class="bi bi-bell"></i>
                        <span class="notification-badge">5</span>
                    </button>

                    <button class="btn-primary" id="addOrgBtn">
                        <i class="bi bi-plus-lg"></i>
                        <span>Add Organization</span>
                    </button>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main class="main-content">
                <div class="content-grid">
                    <!-- Metrics Section -->
                    <section class="content-section">
                        <div class="metrics-grid">
                            <!-- Total Organizations -->
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon indigo">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <span class="metric-badge">
                                        <i class="bi bi-arrow-up-short"></i>12%
                                    </span>
                                </div>
                                <div>
                                    <div class="metric-value">48</div>
                                    <div class="metric-label">Total Organizations</div>
                                </div>
                            </div>

                            <!-- Active Admins -->
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon cyan">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <span class="metric-badge">
                                        <i class="bi bi-arrow-up-short"></i>8%
                                    </span>
                                </div>
                                <div>
                                    <div class="metric-value">156</div>
                                    <div class="metric-label">Active Admins</div>
                                </div>
                            </div>

                            <!-- Total Users -->
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon emerald">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <span class="metric-badge">
                                        <i class="bi bi-arrow-up-short"></i>23%
                                    </span>
                                </div>
                                <div>
                                    <div class="metric-value">24.5K</div>
                                    <div class="metric-label">Total Users</div>
                                </div>
                            </div>

                            <!-- Monthly Revenue -->
                            <div class="metric-card">
                                <div class="metric-header">
                                    <div class="metric-icon amber">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <span class="metric-badge">
                                        <i class="bi bi-arrow-up-short"></i>18%
                                    </span>
                                </div>
                                <div>
                                    <div class="metric-value">$128K</div>
                                    <div class="metric-label">Monthly Revenue</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Main Grid: Table + Health -->
                    <section class="content-section">
                        <div class="grid-2-1">
                            <!-- Organizations Table -->
                            <div class="table-section">
                                <div class="table-header">
                                    <h2>Recent Organizations</h2>
                                    <a href="#" class="view-all-link">View All</a>
                                </div>
                                <div class="table-wrapper">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Organization</th>
                                                <th>Admin</th>
                                                <th>Users</th>
                                                <th>Plan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="org-cell">
                                                        <div class="org-avatar avatar-s">S</div>
                                                        Stanford University
                                                    </div>
                                                </td>
                                                <td>John Smith</td>
                                                <td style="font-family: monospace;">4,521</td>
                                                <td><span class="plan-badge plan-enterprise">Enterprise</span></td>
                                                <td><span class="status-badge status-active">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="org-cell">
                                                        <div class="org-avatar avatar-m">M</div>
                                                        MIT Academy
                                                    </div>
                                                </td>
                                                <td>Sarah Johnson</td>
                                                <td style="font-family: monospace;">3,892</td>
                                                <td><span class="plan-badge plan-enterprise">Enterprise</span></td>
                                                <td><span class="status-badge status-active">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="org-cell">
                                                        <div class="org-avatar avatar-o">O</div>
                                                        Oxford College
                                                    </div>
                                                </td>
                                                <td>James Wilson</td>
                                                <td style="font-family: monospace;">2,156</td>
                                                <td><span class="plan-badge plan-pro">Pro</span></td>
                                                <td><span class="status-badge status-active">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="org-cell">
                                                        <div class="org-avatar avatar-h">H</div>
                                                        Harvard Institute
                                                    </div>
                                                </td>
                                                <td>Emily Brown</td>
                                                <td style="font-family: monospace;">5,234</td>
                                                <td><span class="plan-badge plan-enterprise">Enterprise</span></td>
                                                <td><span class="status-badge status-trial">Trial</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="org-cell">
                                                        <div class="org-avatar avatar-y">Y</div>
                                                        Yale University
                                                    </div>
                                                </td>
                                                <td>Michael Davis</td>
                                                <td style="font-family: monospace;">1,847</td>
                                                <td><span class="plan-badge plan-pro">Pro</span></td>
                                                <td><span class="status-badge status-active">Active</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- System Health -->
                            <div class="health-panel">
                                <h3 class="health-title">System Health</h3>
                                <div class="health-items">
                                    <div class="health-item">
                                        <div class="health-row">
                                            <span class="health-label">Server Uptime</span>
                                            <span class="health-value progress-emerald"
                                                style="color: var(--accent-emerald);">99.98%</span>
                                        </div>
                                        <div class="progress-bar-bg">
                                            <div class="progress-bar progress-emerald" style="width: 99.98%;"></div>
                                        </div>
                                    </div>

                                    <div class="health-item">
                                        <div class="health-row">
                                            <span class="health-label">API Response</span>
                                            <span class="health-value progress-blue"
                                                style="color: var(--accent-blue);">45ms</span>
                                        </div>
                                        <div class="progress-bar-bg">
                                            <div class="progress-bar progress-blue" style="width: 85%;"></div>
                                        </div>
                                    </div>

                                    <div class="health-item">
                                        <div class="health-row">
                                            <span class="health-label">Database Load</span>
                                            <span class="health-value progress-cyan"
                                                style="color: var(--accent-cyan);">32%</span>
                                        </div>
                                        <div class="progress-bar-bg">
                                            <div class="progress-bar progress-cyan" style="width: 32%;"></div>
                                        </div>
                                    </div>

                                    <div class="health-item">
                                        <div class="health-row">
                                            <span class="health-label">Storage Used</span>
                                            <span class="health-value progress-amber"
                                                style="color: var(--accent-amber);">68%</span>
                                        </div>
                                        <div class="progress-bar-bg">
                                            <div class="progress-bar progress-amber" style="width: 68%;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="health-status">
                                    <div class="status-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="status-text">
                                        <h4>All Systems Operational</h4>
                                        <p>Last checked 2 minutes ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Activity Feed -->
                    <section class="content-section">
                        <div class="activity-section">
                            <h3 class="activity-title">Recent Activity</h3>
                            <div class="activity-items">
                                <div class="activity-item">
                                    <div class="activity-icon icon-building">
                                        <i class="bi bi-building-add"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title-text">New organization registered</div>
                                        <div class="activity-subtitle">Cambridge Academy</div>
                                    </div>
                                    <div class="activity-time">2 min ago</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-icon icon-person">
                                        <i class="bi bi-person-plus"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title-text">Admin account created</div>
                                        <div class="activity-subtitle">MIT Academy</div>
                                    </div>
                                    <div class="activity-time">15 min ago</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-icon icon-upgrade">
                                        <i class="bi bi-arrow-up-circle"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title-text">Subscription upgraded</div>
                                        <div class="activity-subtitle">Stanford University</div>
                                    </div>
                                    <div class="activity-time">1 hour ago</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-icon icon-security">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title-text">Security alert resolved</div>
                                        <div class="activity-subtitle">System</div>
                                    </div>
                                    <div class="activity-time">3 hours ago</div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>

        <!-- MODAL: Add Organization -->
        <div class="modal" id="addOrgModal">
            <div class="modal-overlay" id="modalOverlay"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title-section">
                        <div class="modal-icon">
                            <i class="bi bi-building-add"></i>
                        </div>
                        <div class="modal-title-text">
                            <h3>Add Organization</h3>
                            <p>Setup a new platform branch tenant context</p>
                        </div>
                    </div>
                    <button class="modal-close-btn" id="modalCloseBtn">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form class="modal-body" id="addOrgForm">
                    <div class="form-group">
                        <label>Organization Name</label>
                        <input type="text" placeholder="e.g. Cambridge Academy" required>
                    </div>

                    <div class="form-group">
                        <label>Admin Name</label>
                        <input type="text" placeholder="e.g. John Doe" required>
                    </div>

                    <div class="form-group">
                        <label>Admin Gmail</label>
                        <input type="email" placeholder="e.g. admin@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label>Initial Password</label>
                        <div class="password-input-group">
                            <input type="password" id="passwordInput" placeholder="••••••••" required>
                            <button type="button" class="toggle-password" id="togglePasswordBtn">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button class="btn-secondary" id="modalCancelBtn">Cancel</button>
                    <button class="btn-submit" id="modalSubmitBtn">Save Organization</button>
                </div>
            </div>
        </div>

        <script>
            // ============ SIDEBAR & MOBILE ============
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const hamburgerBtn = document.getElementById('hamburgerBtn');

            function openSidebar() {
                sidebar.classList.remove('mobile-hidden');
                sidebarOverlay.classList.add('visible');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.add('mobile-hidden');
                sidebarOverlay.classList.remove('visible');
                document.body.style.overflow = 'auto';
            }

            hamburgerBtn.addEventListener('click', openSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Close sidebar on escape
            // document.addEventListener('keydown', (e) => {
            //     if (e.key === 'Escape') closeSidebar();
            // });

            // Close sidebar when nav item is clicked
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth <= 768) {
                        closeSidebar();
                    }
                });
            });

            // ============ MODAL: ADD ORGANIZATION ============
            const addOrgBtn = document.getElementById('addOrgBtn');
            const addOrgModal = document.getElementById('addOrgModal');
            const modalOverlay = document.getElementById('modalOverlay');
            const modalCloseBtn = document.getElementById('modalCloseBtn');
            const modalCancelBtn = document.getElementById('modalCancelBtn');
            const modalSubmitBtn = document.getElementById('modalSubmitBtn');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('passwordInput');

            function openModal() {
                addOrgModal.classList.add('visible');
            }

            function closeModal() {
                addOrgModal.classList.remove('visible');
            }

            addOrgBtn.addEventListener('click', openModal);
            modalOverlay.addEventListener('click', closeModal);
            modalCloseBtn.addEventListener('click', closeModal);
            modalCancelBtn.addEventListener('click', closeModal);

            // Toggle password visibility
            togglePasswordBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const icon = togglePasswordBtn.querySelector('i');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.replace('bi-eye', 'bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });

            // Form submission
            modalSubmitBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const form = document.getElementById('addOrgForm');
                if (form.checkValidity()) {
                    console.log('Organization added!');
                    closeModal();
                    form.reset();
                    passwordInput.type = 'password';
                    togglePasswordBtn.querySelector('i').classList.add('bi-eye');
                }
            });

            // Close modal on escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });

            // Close sidebar when window is resized to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });
        </script>
    </div>
</x-layout>
