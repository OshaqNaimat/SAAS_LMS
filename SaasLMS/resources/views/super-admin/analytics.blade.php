<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS — Analytics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            --cyan: #22d3ee;
            --orange: #fb923c;
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
            background: rgba(34, 211, 238, 0.1);
            border: 1px solid rgba(34, 211, 238, 0.25);
            color: var(--cyan);
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
            background: var(--cyan);
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

        .export-btn {
            background: rgba(148, 163, 184, 0.08);
            color: var(--text-secondary);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 10px;
            padding: 0.7rem 1.25rem;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .export-btn:hover {
            background: rgba(148, 163, 184, 0.14);
            color: var(--text-primary);
            border-color: var(--border-hover);
        }

        /* ── KPI CARDS ── */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .kpi-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.4rem;
            transition: all 0.2s;
        }

        .kpi-card:hover {
            border-color: var(--border-hover);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .kpi-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .kpi-label {
            font-size: 0.63rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .kpi-icon-box {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .kpi-value {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
        }

        .kpi-change {
            font-size: 0.72rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .kpi-change.up {
            color: var(--green);
        }

        .kpi-change.down {
            color: var(--red);
        }

        /* ── CHART GRID ── */
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

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
            margin-bottom: 1.2rem;
        }

        .chart-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .chart-subtitle {
            font-size: 0.68rem;
            color: var(--text-muted);
        }

        .chart-select {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            border-radius: 8px;
            padding: 0.35rem 0.7rem;
            font-size: 0.7rem;
            cursor: pointer;
            outline: none;
        }

        .chart-canvas {
            width: 100%;
            height: 250px;
        }

        .chart-canvas.tall {
            height: 300px;
        }

        svg {
            width: 100%;
            height: 100%;
        }

        /* ── TABLE MINI ── */
        .table-mini {
            width: 100%;
            border-collapse: collapse;
        }

        .table-mini thead th {
            font-size: 0.63rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0.7rem 0.5rem;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .table-mini tbody td {
            padding: 0.7rem 0.5rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(148, 163, 184, 0.05);
        }

        .table-mini tbody tr:last-child td {
            border-bottom: none;
        }

        .table-mini tbody tr:hover {
            background: rgba(139, 92, 246, 0.03);
        }

        .progress-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .progress-mini {
            width: 80px;
            height: 5px;
            background: rgba(148, 163, 184, 0.1);
            border-radius: 3px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .progress-mini-fill {
            height: 100%;
            border-radius: 3px;
        }

        /* ── METRIC ROW ── */
        .metric-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        }

        .metric-row:last-child {
            border-bottom: none;
        }

        .metric-name {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .metric-value {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-primary);
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

            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .kpi-grid {
                grid-template-columns: 1fr 1fr;
            }

            .title-section {
                flex-direction: column;
            }

            .export-btn {
                width: 100%;
                justify-content: center;
            }
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

            <!-- Dashboard Scroll -->
            <div class="dashboard-scroll">
                <div class="dashboard-content">
                    <!-- Title Section -->
                    <div class="title-section">
                        <div class="title-group">
                            <div class="badge-tag"><span class="badge-dot"></span> REAL-TIME DATA</div>
                            <h1>Analytics</h1>
                            <p class="subtitle">Cross-platform metrics • Performance insights • Usage trends &
                                forecasting</p>
                        </div>
                        <button class="export-btn">
                            <i class="bi bi-download"></i> EXPORT REPORT
                        </button>
                    </div>

                    <!-- KPI Cards -->
                    <div class="kpi-grid">
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <span class="kpi-label">Total Revenue</span>
                                <div class="kpi-icon-box" style="background:rgba(96,165,250,0.12); color:var(--blue);">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                            <div class="kpi-value">Rs. {{ number_format($totalRevenue) }}</div>
                            <span class="kpi-change {{ $revenueGrowthPct >= 0 ? 'up' : 'down' }}">
                                <i class="bi bi-arrow-{{ $revenueGrowthPct >= 0 ? 'up' : 'down' }}-short"></i>
                                {{ $revenueGrowthPct >= 0 ? '+' : '' }}{{ $revenueGrowthPct }}% vs last month
                            </span>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <span class="kpi-label">Active Users</span>
                                <div class="kpi-icon-box" style="background:rgba(52,211,153,0.12); color:var(--green);">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                            <div class="kpi-value">{{ number_format($totalUsers) }}</div>
                            <span class="kpi-change {{ $userGrowthPct >= 0 ? 'up' : 'down' }}">
                                <i class="bi bi-arrow-{{ $userGrowthPct >= 0 ? 'up' : 'down' }}-short"></i>
                                {{ $userGrowthPct >= 0 ? '+' : '' }}{{ $userGrowthPct }}% this week
                            </span>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <span class="kpi-label">Avg Users / Org</span>
                                <div class="kpi-icon-box"
                                    style="background:rgba(251,191,36,0.12); color:var(--yellow);">
                                    <i class="bi bi-diagram-3-fill"></i>
                                </div>
                            </div>
                            <div class="kpi-value">{{ $avgUsersPerOrg }}</div>
                            <span class="kpi-change up"><i class="bi bi-building"></i> across {{ $totalOrgs }}
                                orgs</span>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-header">
                                <span class="kpi-label">Trial Conversion</span>
                                <div class="kpi-icon-box" style="background:rgba(244,114,182,0.12); color:var(--pink);">
                                    <i class="bi bi-arrow-up-right-circle"></i>
                                </div>
                            </div>
                            <div class="kpi-value">{{ $trialConversionPct }}%</div>
                            <span class="kpi-change up"><i class="bi bi-check-circle"></i> off trial plan</span>
                        </div>
                    </div>

                    <!-- Charts Row 1 -->
                    <div class="chart-grid">
                        <!-- Revenue Trend -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">Revenue Trend</div>
                                    <div class="chart-subtitle">Last 12 months</div>
                                </div>
                                <select class="chart-select">
                                    <option>12 Months</option>
                                    <option>6 Months</option>
                                    <option>30 Days</option>
                                </select>
                            </div>
                            <div class="chart-canvas"><canvas id="revenueTrendChart"></canvas></div>
                        </div>

                        <!-- User Acquisition -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">User Acquisition</div>
                                    <div class="chart-subtitle">Monthly new sign-ups</div>
                                </div>
                                <select class="chart-select">
                                    <option>2026</option>
                                    <option>2025</option>
                                </select>
                            </div>
                            <div class="chart-canvas"><canvas id="userAcquisitionChart"></canvas></div>
                        </div>
                    </div>

                    <!-- Charts Row 2 -->
                    <div class="chart-grid">
                        <!-- Organization Distribution -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">Organization by Plan</div>
                                    <div class="chart-subtitle">Subscription distribution</div>
                                </div>
                            </div>
                            <div class="chart-canvas">
                                <svg viewBox="0 0 400 200" preserveAspectRatio="xMidYMid meet">
                                    @php $colors = ['enterprise' => 'rgba(124,58,237,0.7)', 'standard' => 'rgba(96,165,250,0.7)', 'basic' => 'rgba(52,211,153,0.7)', 'trial' => 'rgba(251,191,36,0.7)']; @endphp
                                    @foreach ($planDistribution as $i => $p)
                                        @php
                                            $y = 40 + $i * 38;
                                            $width = max(30, ($p['pct'] / 100) * 340);
                                        @endphp
                                        <rect x="30" y="{{ $y }}" width="{{ $width }}"
                                            height="28" rx="6" fill="{{ $colors[$p['plan']] }}" />
                                        <text x="40" y="{{ $y + 19 }}" fill="white" font-size="11"
                                            font-weight="600">{{ ucfirst($p['plan']) }}</text>
                                        <text x="{{ 30 + $width - 5 }}" y="{{ $y + 19 }}" fill="white"
                                            font-size="10" font-weight="700"
                                            text-anchor="end">{{ $p['pct'] }}%</text>
                                    @endforeach
                                </svg>
                            </div>
                        </div>

                        <!-- Top Organizations -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">Top Organizations</div>
                                    <div class="chart-subtitle">By active users</div>
                                </div>
                            </div>
                            <table class="table-mini">
                                <thead>
                                    <tr>
                                        <th>Organization</th>
                                        <th>Users</th>
                                        <th>Plan</th>
                                        <th>Capacity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topOrganizations as $org)
                                        <tr>
                                            <td><strong style="color:white;">{{ $org['name'] }}</strong></td>
                                            <td>{{ number_format($org['users_count']) }}</td>
                                            <td><span style="color:var(--cyan);">{{ ucfirst($org['plan']) }}</span>
                                            </td>
                                            <td>
                                                <div class="progress-cell">
                                                    <div class="progress-mini">
                                                        <div class="progress-mini-fill"
                                                            style="width:{{ $org['usage_pct'] }}%; background:var(--accent);">
                                                        </div>
                                                    </div>
                                                    <span style="font-size:0.7rem;">{{ $org['usage_pct'] }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align:center; color:var(--text-muted);">No
                                                organizations yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

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
        new Chart(document.getElementById('revenueTrendChart'), {
            type: 'line',
            data: {
                labels: @json($revenueTrendLabels),
                datasets: [{
                    data: @json($revenueTrend),
                    borderColor: '#7c3aed',
                    backgroundColor: 'rgba(124,58,237,0.15)',
                    fill: true,
                    tension: 0.35,
                    pointRadius: 3,
                    pointBackgroundColor: '#7c3aed',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(148,163,184,0.1)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('userAcquisitionChart'), {
            type: 'bar',
            data: {
                labels: @json($revenueTrendLabels),
                datasets: [{
                    data: @json($userAcquisitionTrend),
                    backgroundColor: '#60a5fa',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(148,163,184,0.1)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
