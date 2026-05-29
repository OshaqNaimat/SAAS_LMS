<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS — Admin Dashboard</title>
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
            --sidebar-width: 250px;
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
            overflow: hidden;
        }

        /* ── LAYOUT ── */
        .app-container {
            display: flex;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            background: var(--bg-surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            flex-shrink: 0;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.2);
            border-radius: 10px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1.4rem 1.2rem 1rem;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .sidebar-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 0 18px rgba(59, 130, 246, 0.4);
        }

        .sidebar-brand .brand-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand .org-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .sidebar-brand .org-plan {
            font-size: 0.6rem;
            color: var(--text-muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .sidebar-section {
            padding: 1rem 0.9rem 0.3rem;
            flex-shrink: 0;
        }

        .sidebar-label {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            text-transform: uppercase;
            padding: 0 0.5rem;
            margin-bottom: 0.3rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 0.8rem;
            border-radius: 8px;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.15s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: rgba(59, 130, 246, 0.08);
            color: var(--text-primary);
        }

        .nav-item.active {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
        }

        .nav-item.active i {
            color: #60a5fa;
        }

        .nav-item i {
            font-size: 1rem;
            width: 18px;
            text-align: center;
        }

        .nav-badge {
            margin-left: auto;
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            font-size: 0.63rem;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-footer {
            padding: 0.8rem;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(59, 130, 246, 0.05);
            border: 1px solid rgba(59, 130, 246, 0.15);
            border-radius: 10px;
            padding: 0.7rem 0.8rem;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-info strong {
            display: block;
            font-size: 0.78rem;
            color: var(--text-primary);
        }

        .user-info small {
            font-size: 0.66rem;
            color: var(--text-muted);
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--text-muted);
            width: 30px;
            height: 30px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.12);
            color: var(--red);
            border-color: rgba(239, 68, 68, 0.3);
        }

        /* ── MAIN ── */
        .main-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        .mobile-header {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 1.2rem;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
            flex-shrink: 0;
        }

        .brand-mobile {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .mini-icon {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: white;
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

        .dashboard-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .dashboard-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .dashboard-scroll::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.25);
            border-radius: 10px;
        }

        .dashboard-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.4);
        }

        .dashboard-content {
            padding: 1.8rem 2rem;
            max-width: 1400px;
            width: 100%;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.8rem;
        }

        .welcome-text h1 {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.2rem;
            letter-spacing: -0.02em;
        }

        .welcome-text p {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .header-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.76rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.2s;
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            opacity: 0.88;
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: rgba(148, 163, 184, 0.06);
            color: var(--text-secondary);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.76rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: rgba(148, 163, 184, 0.12);
            color: var(--text-primary);
            border-color: var(--border-hover);
        }

        /* ── KPI CARDS ── */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 1rem;
            margin-bottom: 1.8rem;
        }

        .kpi-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.3rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .kpi-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .kpi-card::after {
            content: '';
            position: absolute;
            top: -35%;
            right: -25%;
            width: 90px;
            height: 90px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .kpi-info h4 {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
        }

        .kpi-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
        }

        .kpi-change {
            font-size: 0.68rem;
            font-weight: 600;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .kpi-change.up {
            color: var(--green);
        }

        .kpi-change.down {
            color: var(--red);
        }

        .kpi-icon {
            font-size: 1.5rem;
            opacity: 0.7;
            z-index: 1;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* ── CHART GRID ── */
        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
            margin-bottom: 1.8rem;
        }

        .chart-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.4rem 1.5rem;
            transition: border-color 0.2s;
        }

        .chart-card:hover {
            border-color: var(--border-hover);
        }

        .chart-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .chart-card-header h3 {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .chart-card-header select {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            border-radius: 7px;
            padding: 0.3rem 0.6rem;
            font-size: 0.7rem;
            cursor: pointer;
            outline: none;
        }

        .chart-canvas {
            width: 100%;
            height: 200px;
        }

        .chart-canvas.tall {
            height: 250px;
        }

        svg {
            width: 100%;
            height: 100%;
        }

        /* ── ACTIVITY LIST ── */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 0.6rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
            min-width: 0;
        }

        .activity-content p {
            font-size: 0.78rem;
            color: var(--text-secondary);
            line-height: 1.3;
        }

        .activity-content span {
            font-size: 0.66rem;
            color: var(--text-muted);
        }

        /* ── QUICK STATS ── */
        .quick-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1.8rem;
        }

        .quick-stat {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .quick-stat:hover {
            border-color: var(--border-hover);
        }

        .quick-stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .quick-stat-info h5 {
            font-size: 0.63rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin-bottom: 0.15rem;
            text-transform: uppercase;
        }

        .quick-stat-info strong {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* ── TABLE MINI ── */
        .table-mini {
            width: 100%;
            border-collapse: collapse;
        }

        .table-mini thead th {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0.6rem 0.4rem;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .table-mini tbody td {
            padding: 0.6rem 0.4rem;
            font-size: 0.78rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(148, 163, 184, 0.05);
        }

        .table-mini tbody tr:last-child td {
            border-bottom: none;
        }

        .table-mini tbody tr:hover {
            background: rgba(59, 130, 246, 0.03);
        }

        .status-dot-sm {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        /* ── OVERLAY ── */
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

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: #1a2236;
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 16px;
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.6);
            transform: scale(0.96) translateY(10px);
            transition: transform 0.2s;
        }

        .modal-overlay.open .modal {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
            position: sticky;
            top: 0;
            background: #1a2236;
            z-index: 2;
            border-radius: 16px 16px 0 0;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 0.95rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-close {
            background: transparent;
            border: none;
            color: var(--text-muted);
            width: 30px;
            height: 30px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            transition: all 0.15s;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.06);
            color: var(--text-primary);
        }

        .modal-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(148, 163, 184, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 0.6rem;
            position: sticky;
            bottom: 0;
            background: #1a2236;
            border-radius: 0 0 16px 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-size: 0.67rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .form-group input,
        .form-group select {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 9px;
            color: var(--text-primary);
            padding: 0.65rem 0.9rem;
            font-size: 0.83rem;
            outline: none;
            transition: border-color 0.2s;
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: rgba(59, 130, 246, 0.5);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 0.65rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s;
        }

        .btn-submit:hover {
            opacity: 0.85;
        }

        .btn-cancel {
            background: rgba(148, 163, 184, 0.08);
            color: var(--text-secondary);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 9px;
            padding: 0.65rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.15s;
        }

        .btn-cancel:hover {
            background: rgba(148, 163, 184, 0.14);
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
                box-shadow: 10px 0 40px rgba(0, 0, 0, 0.5);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .mobile-header {
                display: flex;
            }

            .dashboard-content {
                padding: 1.3rem 1rem;
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .kpi-grid {
                grid-template-columns: 1fr 1fr;
            }

            .page-header {
                flex-direction: column;
            }

            .header-actions {
                width: 100%;
            }

            .btn-primary,
            .btn-secondary {
                flex: 1;
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
                <a class="nav-item active" href="#"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                <a class="nav-item" href="#"><i class="bi bi-people-fill"></i> Team Members <span
                        class="nav-badge">1,240</span></a>
                <a class="nav-item" href="#"><i class="bi bi-folder-fill"></i> Projects <span
                        class="nav-badge">18</span></a>
                <a class="nav-item" href="#"><i class="bi bi-calendar-check-fill"></i> Tasks</a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-label">Management</div>
                <a class="nav-item" href="#"><i class="bi bi-bar-chart-fill"></i> Reports</a>
                <a class="nav-item" href="#"><i class="bi bi-credit-card-fill"></i> Billing</a>
                <a class="nav-item" href="#"><i class="bi bi-shield-check"></i> Security</a>
                <a class="nav-item" href="#"><i class="bi bi-gear-fill"></i> Settings</a>
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

        <!-- Main Content -->
        <div class="main-wrapper">
            <!-- Mobile Header -->
            <header class="mobile-header">
                <div class="brand-mobile">
                    <div class="mini-icon"><i class="bi bi-building"></i></div>
                    <span>Apex Global</span>
                </div>
                <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Menu"><i
                        class="bi bi-list"></i></button>
            </header>

            <!-- Dashboard Scroll -->
            <div class="dashboard-scroll">
                <div class="dashboard-content">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="welcome-text">
                            <h1>Welcome back, Alex 👋</h1>
                            <p>Here's what's happening with your organization today.</p>
                        </div>
                        <div class="header-actions">
                            <button class="btn-secondary" onclick="openModal('inviteModal')"><i
                                    class="bi bi-person-plus"></i> Invite Member</button>
                            <button class="btn-primary" onclick="openModal('projectModal')"><i
                                    class="bi bi-plus-lg"></i> New Project</button>
                        </div>
                    </div>

                    <!-- KPI Cards -->
                    <div class="kpi-grid">
                        <div class="kpi-card">
                            <div class="kpi-info">
                                <h4>Team Members</h4>
                                <div class="kpi-value">1,240</div>
                                <div class="kpi-change up"><i class="bi bi-arrow-up-short"></i> 12 this week</div>
                            </div>
                            <div class="kpi-icon" style="color:#60a5fa;"><i class="bi bi-people-fill"></i></div>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-info">
                                <h4>Active Projects</h4>
                                <div class="kpi-value">18</div>
                                <div class="kpi-change up"><i class="bi bi-arrow-up-short"></i> 3 new</div>
                            </div>
                            <div class="kpi-icon" style="color:var(--green);"><i class="bi bi-folder-fill"></i></div>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-info">
                                <h4>Tasks Completed</h4>
                                <div class="kpi-value">842</div>
                                <div class="kpi-change up"><i class="bi bi-arrow-up-short"></i> 85% completion</div>
                            </div>
                            <div class="kpi-icon" style="color:var(--yellow);"><i class="bi bi-check2-circle"></i>
                            </div>
                        </div>
                        <div class="kpi-card">
                            <div class="kpi-info">
                                <h4>Storage Used</h4>
                                <div class="kpi-value">487 GB</div>
                                <div class="kpi-change down"><i class="bi bi-arrow-down-short"></i> 62% of 1 TB</div>
                            </div>
                            <div class="kpi-icon" style="color:var(--pink);"><i class="bi bi-cloud-fill"></i></div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="chart-grid">
                        <!-- Project Progress Chart -->
                        <div class="chart-card">
                            <div class="chart-card-header">
                                <h3>Project Progress</h3>
                                <select>
                                    <option>This Month</option>
                                    <option>Last Month</option>
                                    <option>Last Quarter</option>
                                </select>
                            </div>
                            <div class="chart-canvas tall">
                                <svg viewBox="0 0 400 200" preserveAspectRatio="xMidYMid meet">
                                    <defs>
                                        <linearGradient id="projGrad" x1="0%" y1="0%" x2="0%"
                                            y2="100%">
                                            <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.3" />
                                            <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:0" />
                                        </linearGradient>
                                    </defs>
                                    <line x1="30" y1="160" x2="390" y2="160"
                                        stroke="rgba(148,163,184,0.08)" stroke-width="1" />
                                    <polygon
                                        points="30,130 70,115 110,120 150,95 190,100 230,75 270,85 310,60 350,70 390,50 390,160 30,160"
                                        fill="url(#projGrad)" />
                                    <polyline
                                        points="30,130 70,115 110,120 150,95 190,100 230,75 270,85 310,60 350,70 390,50"
                                        fill="none" stroke="#3b82f6" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <circle cx="310" cy="60" r="4" fill="#3b82f6" />
                                    <circle cx="390" cy="50" r="4" fill="#3b82f6" />
                                </svg>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="chart-card">
                            <div class="chart-card-header">
                                <h3>Recent Activity</h3>
                                <span style="font-size:0.65rem; color:var(--text-muted);">Live</span>
                            </div>
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-dot" style="background:var(--green);"></div>
                                    <div class="activity-content">
                                        <p><strong style="color:white;">Emma Brooks</strong> completed task <strong
                                                style="color:white;">Q4 Report</strong></p>
                                        <span>5 minutes ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-dot" style="background:var(--blue);"></div>
                                    <div class="activity-content">
                                        <p><strong style="color:white;">James Wilson</strong> joined <strong
                                                style="color:white;">Marketing Project</strong></p>
                                        <span>22 minutes ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-dot" style="background:var(--yellow);"></div>
                                    <div class="activity-content">
                                        <p><strong style="color:white;">3 new members</strong> invited by Sarah Jenkins
                                        </p>
                                        <span>1 hour ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-dot" style="background:var(--accent);"></div>
                                    <div class="activity-content">
                                        <p><strong style="color:white;">Storage alert:</strong> 62% capacity reached
                                        </p>
                                        <span>3 hours ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Row -->
                    <div class="quick-stats-row">
                        <div class="quick-stat">
                            <div class="quick-stat-icon" style="background:rgba(52,211,153,0.1); color:var(--green);">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="quick-stat-info">
                                <h5>Active Members</h5>
                                <strong>1,198</strong>
                            </div>
                        </div>
                        <div class="quick-stat">
                            <div class="quick-stat-icon"
                                style="background:rgba(251,191,36,0.1); color:var(--yellow);">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div class="quick-stat-info">
                                <h5>Pending Invites</h5>
                                <strong>42</strong>
                            </div>
                        </div>
                        <div class="quick-stat">
                            <div class="quick-stat-icon" style="background:rgba(59,130,246,0.1); color:var(--blue);">
                                <i class="bi bi-kanban-fill"></i>
                            </div>
                            <div class="quick-stat-info">
                                <h5>Open Tasks</h5>
                                <strong>156</strong>
                            </div>
                        </div>
                        <div class="quick-stat">
                            <div class="quick-stat-icon" style="background:rgba(244,114,182,0.1); color:var(--pink);">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div class="quick-stat-info">
                                <h5>Productivity</h5>
                                <strong>94%</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Members Table -->
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h3>Recent Team Members</h3>
                            <a href="#"
                                style="font-size:0.72rem; color:#60a5fa; text-decoration:none; font-weight:600;">View
                                All →</a>
                        </div>
                        <table class="table-mini">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Role</th>
                                    <th>Project</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong style="color:white;">Emma Brooks</strong></td>
                                    <td>Manager</td>
                                    <td>Q4 Initiative</td>
                                    <td><span class="status-dot-sm" style="background:var(--green);"></span> Active
                                    </td>
                                    <td style="font-size:0.7rem;">Dec 2025</td>
                                </tr>
                                <tr>
                                    <td><strong style="color:white;">James Wilson</strong></td>
                                    <td>Developer</td>
                                    <td>Marketing Site</td>
                                    <td><span class="status-dot-sm" style="background:var(--green);"></span> Active
                                    </td>
                                    <td style="font-size:0.7rem;">Jan 2026</td>
                                </tr>
                                <tr>
                                    <td><strong style="color:white;">Lisa Chen</strong></td>
                                    <td>Designer</td>
                                    <td>Brand Refresh</td>
                                    <td><span class="status-dot-sm" style="background:var(--yellow);"></span> On Leave
                                    </td>
                                    <td style="font-size:0.7rem;">Mar 2026</td>
                                </tr>
                                <tr>
                                    <td><strong style="color:white;">Mark Davis</strong></td>
                                    <td>Analyst</td>
                                    <td>Data Migration</td>
                                    <td><span class="status-dot-sm" style="background:var(--green);"></span> Active
                                    </td>
                                    <td style="font-size:0.7rem;">Apr 2026</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Invite Member Modal -->
    <div id="inviteModal" class="modal-overlay" role="dialog" aria-modal="true">
        <div class="modal">
            <div class="modal-header">
                <h3><i class="bi bi-person-plus" style="color:#3b82f6;"></i> Invite Team Member</h3>
                <button class="modal-close" onclick="closeModal('inviteModal')" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="colleague@example.com">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Role</label>
                        <select>
                            <option>Member</option>
                            <option>Manager</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Project</label>
                        <select>
                            <option>Select project...</option>
                            <option>Q4 Initiative</option>
                            <option>Marketing Site</option>
                            <option>Brand Refresh</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Message (optional)</label>
                    <input type="text" placeholder="Add a personal message...">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('inviteModal')">Cancel</button>
                <button class="btn-submit" onclick="closeModal('inviteModal')"><i class="bi bi-send"></i> Send
                    Invite</button>
            </div>
        </div>
    </div>

    <!-- New Project Modal -->
    <div id="projectModal" class="modal-overlay" role="dialog" aria-modal="true">
        <div class="modal">
            <div class="modal-header">
                <h3><i class="bi bi-plus-lg" style="color:#3b82f6;"></i> Create New Project</h3>
                <button class="modal-close" onclick="closeModal('projectModal')" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" placeholder="Enter project name">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" placeholder="Brief description of the project">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date">
                    </div>
                    <div class="form-group">
                        <label>Team Lead</label>
                        <select>
                            <option>Alex Mercer</option>
                            <option>Emma Brooks</option>
                            <option>James Wilson</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('projectModal')">Cancel</button>
                <button class="btn-submit" onclick="closeModal('projectModal')"><i class="bi bi-check-lg"></i> Create
                    Project</button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
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

        // Modal management
        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            const openModals = document.querySelectorAll('.modal-overlay.open');
            if (openModals.length === 0) {
                document.body.style.overflow = '';
            }
        }

        // Close modals on overlay click
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) closeModal(this.id);
            });
        });

        // Escape key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.open').forEach(m => closeModal(m.id));
            }
        });

        // Prevent body scroll when sidebar open on mobile
        const sidebarObserver = new MutationObserver(() => {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth < 1024) {
                document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
            }
        });
        sidebarObserver.observe(document.getElementById('sidebar'), {
            attributes: true,
            attributeFilter: ['class']
        });
    </script>
</body>

</html>
