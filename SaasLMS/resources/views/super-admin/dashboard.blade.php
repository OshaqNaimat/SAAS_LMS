<x-layout>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --sidebar-width: 260px;
            --bg-base: #0b0f1a;
            --bg-surface: #111827;
            --bg-card: #1a2236;
            --bg-input: rgba(15, 23, 42, 0.7);
            --border: rgba(148, 163, 184, 0.12);
            --border-hover: rgba(148, 163, 184, 0.25);
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #475569;
            --accent: #7c3aed;
            --accent2: #4f46e5;
            --green: #34d399;
            --yellow: #fbbf24;
            --pink: #f472b6;
            --red: #f87171;
            --blue: #60a5fa;
            --purple-dark: #6d28d9;
        }

        html,
        body {
            height: 100%;
            background: var(--bg-base);
            color: var(--text-primary);
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 14px;
            overflow-x: hidden;
        }

        /* ── LAYOUT ── */
        .app-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            background: var(--bg-surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            flex-shrink: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand .brand-icon {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
        }

        .sidebar-brand span {
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            background: linear-gradient(90deg, #a78bfa, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-brand small {
            display: block;
            font-size: 0.6rem;
            color: var(--text-muted);
            letter-spacing: 0.08em;
            margin-top: 1px;
            -webkit-text-fill-color: var(--text-muted);
        }

        .sidebar-section {
            padding: 1.2rem 1rem 0.5rem;
        }

        .sidebar-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            text-transform: uppercase;
            padding: 0 0.5rem;
            margin-bottom: 0.4rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 0.82rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: rgba(139, 92, 246, 0.08);
            color: var(--text-primary);
        }

        .nav-item.active {
            background: rgba(139, 92, 246, 0.15);
            color: #a78bfa;
        }

        .nav-item.active i {
            color: #a78bfa;
        }

        .nav-item i {
            font-size: 1rem;
            width: 18px;
            text-align: center;
        }

        .nav-badge {
            margin-left: auto;
            background: rgba(139, 92, 246, 0.2);
            color: #a78bfa;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid var(--border);
        }

        .admin-card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(139, 92, 246, 0.06);
            border: 1px solid rgba(139, 92, 246, 0.15);
            border-radius: 10px;
            padding: 0.75rem;
        }

        .admin-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .admin-info {
            flex: 1;
            min-width: 0;
        }

        .admin-info strong {
            display: block;
            font-size: 0.78rem;
            color: var(--text-primary);
        }

        .admin-info small {
            font-size: 0.68rem;
            color: var(--text-muted);
        }

        /* ── MAIN ── */
        .main-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .mobile-header {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 0.9rem 1.25rem;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .brand-mobile {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
        }

        .mini-icon {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .hamburger-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-secondary);
            width: 36px;
            height: 36px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: background 0.15s;
        }

        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
        }

        .dashboard-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .dashboard-content {
            padding: 2rem 2.5rem;
            max-width: 100%;
        }

        /* ── TITLE SECTION ── */
        .title-section {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(139, 92, 246, 0.1);
            border: 1px solid rgba(139, 92, 246, 0.25);
            color: #a78bfa;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 0.6rem;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #34d399;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.4
            }
        }

        .title-group h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.3rem;
        }

        .subtitle {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* ── STATS GRID ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            opacity: 0.03;
            pointer-events: none;
        }

        .stat-card:hover {
            border-color: var(--border-hover);
            box-shadow: 0 8px 24px rgba(139, 92, 246, 0.06);
        }

        .stat-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .stat-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-icon-box.blue {
            background: rgba(96, 165, 250, 0.1);
            color: var(--blue);
        }

        .stat-icon-box.green {
            background: rgba(52, 211, 153, 0.1);
            color: var(--green);
        }

        .stat-icon-box.yellow {
            background: rgba(251, 191, 36, 0.1);
            color: var(--yellow);
        }

        .stat-icon-box.pink {
            background: rgba(244, 114, 182, 0.1);
            color: var(--pink);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .stat-change.positive {
            color: var(--green);
        }

        .stat-change.negative {
            color: var(--red);
        }

        /* ── GRID LAYOUTS ── */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        /* ── CHART CARD ── */
        .chart-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            transition: border-color 0.2s;
        }

        .chart-card:hover {
            border-color: var(--border-hover);
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .chart-subtitle {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .chart-menu {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-muted);
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            transition: background 0.15s;
        }

        .chart-menu:hover {
            background: rgba(139, 92, 246, 0.1);
            color: #a78bfa;
        }

        .chart-canvas {
            width: 100%;
            height: 280px;
        }

        svg {
            width: 100%;
            height: 100%;
        }

        /* ── ACTIVITY FEED ── */
        .activity-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            max-height: 500px;
            overflow-y: auto;
            transition: border-color 0.2s;
        }

        .activity-card:hover {
            border-color: var(--border-hover);
        }

        .activity-header {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            margin-left: -0.5rem;
            margin-right: -0.5rem;
            border-radius: 8px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background: rgba(139, 92, 246, 0.04);
        }

        .activity-avatar {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
            min-width: 0;
        }

        .activity-title {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .activity-description {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .activity-time {
            font-size: 0.65rem;
            color: var(--text-muted);
            text-align: right;
            white-space: nowrap;
        }

        /* ── SYSTEM STATUS ── */
        .status-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            border-radius: 8px;
            transition: background 0.15s;
        }

        .status-item:hover {
            background: rgba(139, 92, 246, 0.04);
        }

        .status-item:last-child {
            border-bottom: none;
        }

        .status-name {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-indicator.online {
            background: var(--green);
            box-shadow: 0 0 8px rgba(52, 211, 153, 0.5);
        }

        .status-indicator.warning {
            background: var(--yellow);
        }

        .status-indicator.offline {
            background: var(--red);
        }

        .status-text {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .status-value {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .status-usage {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .progress-bar {
            width: 80px;
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            border-radius: 2px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                transform: translateX(-100%);
                transition: transform 0.28s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .mobile-header {
                display: flex;
            }

            .dashboard-content {
                padding: 1.5rem 1.25rem;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .title-section {
                flex-direction: column;
            }

            .grid-3 {
                grid-template-columns: 1fr;
            }
        }

        /* ── SIDEBAR OVERLAY (MOBILE) ── */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
            z-index: 90;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
        }

        .sidebar-overlay.show {
            opacity: 1;
            pointer-events: all;
        }
    </style>
    </head>

    <body>
        <div class="app-container">
            <!-- Sidebar Overlay -->
            <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

            <!-- Sidebar -->
            <x-superadmin-sidebar />

            <!-- Main Content -->
            <div class="main-wrapper">
                <!-- Mobile Header -->
                <header class="mobile-header">
                    <div class="brand-mobile">
                        <div class="mini-icon"><i class="bi bi-shield-lock-fill" style="color:white; font-size:13px;"></i>
                        </div>
                        <span>NEXUS</span>
                    </div>
                    <button class="hamburger-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
                </header>

                <!-- Dashboard -->
                <div class="dashboard-scroll">
                    <div class="dashboard-content">
                        <!-- Title -->
                        <div class="title-section">
                            <div class="title-group">
                                <div class="badge-tag"><span class="badge-dot"></span> SYSTEM ONLINE</div>
                                <h1>Dashboard</h1>
                                <p class="subtitle">Real-time infrastructure monitoring • Performance analytics • System
                                    health status</p>
                            </div>
                        </div>

                        <!-- Top Stats -->
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-header">
                                    <div class="stat-label">Total Revenue</div>
                                    <div class="stat-icon-box blue"><i class="bi bi-currency-dollar"></i></div>
                                </div>
                                <div class="stat-value">$2,847.50</div>
                                <span class="stat-change positive"><i class="bi bi-arrow-up-short"></i> +12.5% vs last
                                    month</span>
                            </div>

                            <div class="stat-card">
                                <div class="stat-header">
                                    <div class="stat-label">Active Users</div>
                                    <div class="stat-icon-box green"><i class="bi bi-people-fill"></i></div>
                                </div>
                                <div class="stat-value">12,483</div>
                                <span class="stat-change positive"><i class="bi bi-arrow-up-short"></i> +5.2% this
                                    week</span>
                            </div>

                            <div class="stat-card">
                                <div class="stat-header">
                                    <div class="stat-label">System Uptime</div>
                                    <div class="stat-icon-box green"><i class="bi bi-check-circle-fill"></i></div>
                                </div>
                                <div class="stat-value">99.98%</div>
                                <span class="stat-change positive"><i class="bi bi-arrow-up-short"></i> +0.02% from
                                    yesterday</span>
                            </div>

                            <div class="stat-card">
                                <div class="stat-header">
                                    <div class="stat-label">Avg Response Time</div>
                                    <div class="stat-icon-box pink"><i class="bi bi-lightning-fill"></i></div>
                                </div>
                                <div class="stat-value">124ms</div>
                                <span class="stat-change negative"><i class="bi bi-arrow-down-short"></i> -2.1%
                                    improvement</span>
                            </div>
                        </div>

                        <!-- Charts Section -->
                        <div class="grid-2">
                            <!-- Revenue Chart -->
                            <div class="chart-card">
                                <div class="chart-header">
                                    <div>
                                        <div class="chart-title">Revenue Trend</div>
                                        <div class="chart-subtitle">Last 7 days</div>
                                    </div>
                                    <button class="chart-menu"><i class="bi bi-three-dots"></i></button>
                                </div>
                                <div class="chart-canvas">
                                    <svg viewBox="0 0 400 200" preserveAspectRatio="xMidYMid meet">
                                        <!-- Grid -->
                                        <line x1="30" y1="20" x2="30" y2="160"
                                            stroke="rgba(148, 163, 184, 0.1)" stroke-width="1" />
                                        <line x1="30" y1="160" x2="390" y2="160"
                                            stroke="rgba(148, 163, 184, 0.1)" stroke-width="1" />

                                        <!-- Area gradient -->
                                        <defs>
                                            <linearGradient id="revenueGradient" x1="0%" y1="0%"
                                                x2="0%" y2="100%">
                                                <stop offset="0%" style="stop-color:#7c3aed;stop-opacity:0.3" />
                                                <stop offset="100%" style="stop-color:#7c3aed;stop-opacity:0" />
                                            </linearGradient>
                                        </defs>

                                        <!-- Area -->
                                        <polygon
                                            points="30,130 80,90 130,110 180,60 230,80 280,40 330,70 380,50 380,160 30,160"
                                            fill="url(#revenueGradient)" />

                                        <!-- Line -->
                                        <polyline points="30,130 80,90 130,110 180,60 230,80 280,40 330,70 380,50"
                                            fill="none" stroke="#7c3aed" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <!-- Points -->
                                        <circle cx="30" cy="130" r="3" fill="#7c3aed" />
                                        <circle cx="80" cy="90" r="3" fill="#7c3aed" />
                                        <circle cx="130" cy="110" r="3" fill="#7c3aed" />
                                        <circle cx="180" cy="60" r="3" fill="#7c3aed" />
                                        <circle cx="230" cy="80" r="3" fill="#7c3aed" />
                                        <circle cx="280" cy="40" r="3" fill="#7c3aed" />
                                        <circle cx="330" cy="70" r="3" fill="#7c3aed" />
                                        <circle cx="380" cy="50" r="3" fill="#7c3aed" />
                                    </svg>
                                </div>
                            </div>

                            <!-- User Growth Chart -->
                            <div class="chart-card">
                                <div class="chart-header">
                                    <div>
                                        <div class="chart-title">User Growth</div>
                                        <div class="chart-subtitle">Monthly comparison</div>
                                    </div>
                                    <button class="chart-menu"><i class="bi bi-three-dots"></i></button>
                                </div>
                                <div class="chart-canvas">
                                    <svg viewBox="0 0 400 200" preserveAspectRatio="xMidYMid meet">
                                        <!-- Grid -->
                                        <line x1="30" y1="20" x2="30" y2="160"
                                            stroke="rgba(148, 163, 184, 0.1)" stroke-width="1" />
                                        <line x1="30" y1="160" x2="390" y2="160"
                                            stroke="rgba(148, 163, 184, 0.1)" stroke-width="1" />

                                        <!-- Bars -->
                                        <rect x="45" y="100" width="25" height="60"
                                            fill="rgba(96, 165, 250, 0.6)" rx="3" />
                                        <rect x="85" y="85" width="25" height="75"
                                            fill="rgba(96, 165, 250, 0.8)" rx="3" />
                                        <rect x="125" y="70" width="25" height="90" fill="#60a5fa"
                                            rx="3" />
                                        <rect x="165" y="55" width="25" height="105"
                                            fill="rgba(96, 165, 250, 0.8)" rx="3" />
                                        <rect x="205" y="45" width="25" height="115" fill="#60a5fa"
                                            rx="3" />
                                        <rect x="245" y="35" width="25" height="125"
                                            fill="rgba(96, 165, 250, 0.9)" rx="3" />
                                        <rect x="285" y="50" width="25" height="110" fill="#60a5fa"
                                            rx="3" />
                                        <rect x="325" y="65" width="25" height="95"
                                            fill="rgba(96, 165, 250, 0.8)" rx="3" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Activity & Status Section -->
                        <div class="grid-2">
                            <!-- Recent Activity -->
                            <div class="activity-card">
                                <div class="activity-header">
                                    <i class="bi bi-clock-history" style="color:#60a5fa;"></i>
                                    Recent Activity
                                </div>

                                <div class="activity-item">
                                    <div class="activity-avatar"
                                        style="background:linear-gradient(135deg,#3b82f6,#6366f1);">AC</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Apex Global added 150 users</div>
                                        <div class="activity-description">Organization enrollment spike</div>
                                    </div>
                                    <div class="activity-time">2 min ago</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-avatar"
                                        style="background:linear-gradient(135deg,#a855f7,#ec4899);">VF</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Vanguard Fitness renewed subscription</div>
                                        <div class="activity-description">Enterprise plan extended to 2025</div>
                                    </div>
                                    <div class="activity-time">14 min ago</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-avatar"
                                        style="background:linear-gradient(135deg,#f59e0b,#f97316);">NS</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Nexus Systems completed evaluation</div>
                                        <div class="activity-description">Transitioned to active plan</div>
                                    </div>
                                    <div class="activity-time">32 min ago</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-avatar"
                                        style="background:linear-gradient(135deg,#ef4444,#f43f5e);">OM</div>
                                    <div class="activity-content">
                                        <div class="activity-title">OmniRetail Services suspended</div>
                                        <div class="activity-description">Non-payment notification sent</div>
                                    </div>
                                    <div class="activity-time">1 hour ago</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-avatar"
                                        style="background:linear-gradient(135deg,#06b6d4,#0891b2);">TC</div>
                                    <div class="activity-content">
                                        <div class="activity-title">System backup completed</div>
                                        <div class="activity-description">All data synchronized to replicas</div>
                                    </div>
                                    <div class="activity-time">3 hours ago</div>
                                </div>
                            </div>

                            <!-- System Status -->
                            <div class="chart-card">
                                <div class="chart-header">
                                    <div>
                                        <div class="chart-title">System Status</div>
                                        <div class="chart-subtitle">Infrastructure health</div>
                                    </div>
                                    <button class="chart-menu"><i class="bi bi-three-dots"></i></button>
                                </div>

                                <div class="status-item">
                                    <div class="status-name">
                                        <div class="status-indicator online"></div>
                                        <div>
                                            <div class="status-text">API Servers</div>
                                            <div class="status-value">12 nodes operational</div>
                                        </div>
                                    </div>
                                    <div class="status-usage">
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width:68%;"></div>
                                        </div>
                                        <span
                                            style="font-size:0.75rem; color:var(--text-muted); min-width:30px;">68%</span>
                                    </div>
                                </div>

                                <div class="status-item">
                                    <div class="status-name">
                                        <div class="status-indicator online"></div>
                                        <div>
                                            <div class="status-text">Database Cluster</div>
                                            <div class="status-value">3 replicas synchronized</div>
                                        </div>
                                    </div>
                                    <div class="status-usage">
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width:42%;"></div>
                                        </div>
                                        <span
                                            style="font-size:0.75rem; color:var(--text-muted); min-width:30px;">42%</span>
                                    </div>
                                </div>

                                <div class="status-item">
                                    <div class="status-name">
                                        <div class="status-indicator online"></div>
                                        <div>
                                            <div class="status-text">Cache Layer</div>
                                            <div class="status-value">Redis cluster healthy</div>
                                        </div>
                                    </div>
                                    <div class="status-usage">
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width:85%;"></div>
                                        </div>
                                        <span
                                            style="font-size:0.75rem; color:var(--text-muted); min-width:30px;">85%</span>
                                    </div>
                                </div>

                                <div class="status-item">
                                    <div class="status-name">
                                        <div class="status-indicator online"></div>
                                        <div>
                                            <div class="status-text">Message Queue</div>
                                            <div class="status-value">RabbitMQ running</div>
                                        </div>
                                    </div>
                                    <div class="status-usage">
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width:35%;"></div>
                                        </div>
                                        <span
                                            style="font-size:0.75rem; color:var(--text-muted); min-width:30px;">35%</span>
                                    </div>
                                </div>

                                <div class="status-item">
                                    <div class="status-name">
                                        <div class="status-indicator warning"></div>
                                        <div>
                                            <div class="status-text">Storage Capacity</div>
                                            <div class="status-value">78% utilization</div>
                                        </div>
                                    </div>
                                    <div class="status-usage">
                                        <div class="progress-bar">
                                            <div class="progress-fill"
                                                style="width:78%; background: linear-gradient(90deg, var(--yellow), var(--yellow));">
                                            </div>
                                        </div>
                                        <span
                                            style="font-size:0.75rem; color:var(--text-muted); min-width:30px;">78%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Sidebar
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
        </script>
    </body>

</x-layout>
