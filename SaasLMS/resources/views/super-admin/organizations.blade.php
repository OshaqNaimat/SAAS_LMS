<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS — Organizations</title>
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
            background: #a78bfa;
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

        .register-btn {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.7rem 1.25rem;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: opacity 0.2s, transform 0.15s;
            flex-shrink: 0;
        }

        .register-btn:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        /* ── STATS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: border-color 0.2s;
        }

        .stat-card:hover {
            border-color: var(--border-hover);
        }

        .stat-info h4 {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
        }

        .stat-number {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-icon {
            font-size: 1.5rem;
            opacity: 0.7;
        }

        /* ── FILTERS ── */
        .filters-bar {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }

        .search-box {
            flex: 1;
            min-width: 200px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0 0.9rem;
            transition: border-color 0.2s;
        }

        .search-box:focus-within {
            border-color: rgba(139, 92, 246, 0.4);
        }

        .search-box i {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .search-box input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            color: var(--text-primary);
            font-size: 0.82rem;
            padding: 0.65rem 0;
        }

        .search-box input::placeholder {
            color: var(--text-muted);
        }

        .select-group {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .custom-select {
            background: var(--bg-card);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            border-radius: 10px;
            padding: 0.6rem 0.9rem;
            font-size: 0.78rem;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s;
        }

        .custom-select:hover,
        .custom-select:focus {
            border-color: var(--border-hover);
            color: var(--text-primary);
        }

        /* ── TABLE ── */
        .table-wrapper {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 560px;
        }

        thead tr {
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 0.9rem 1.25rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(139, 92, 246, 0.04);
        }

        td {
            padding: 0.9rem 1.25rem;
            color: var(--text-secondary);
            vertical-align: middle;
        }

        .org-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .org-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .status-active {
            background: rgba(52, 211, 153, 0.1);
            color: var(--green);
            border: 1px solid rgba(52, 211, 153, 0.2);
        }

        .status-eval {
            background: rgba(251, 191, 36, 0.1);
            color: var(--yellow);
            border: 1px solid rgba(251, 191, 36, 0.2);
        }

        .status-revoked {
            background: rgba(248, 113, 113, 0.1);
            color: var(--red);
            border: 1px solid rgba(248, 113, 113, 0.2);
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .icon-btn {
            background: rgba(148, 163, 184, 0.06);
            border: 1px solid var(--border);
            color: var(--text-muted);
            width: 34px;
            height: 34px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        .icon-btn:hover {
            background: rgba(139, 92, 246, 0.12);
            color: #a78bfa;
            border-color: rgba(139, 92, 246, 0.3);
        }

        /* ── PAGINATION ── */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.9rem 1.25rem;
            border-top: 1px solid var(--border);
            font-size: 0.78rem;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .page-btns {
            display: flex;
            gap: 0.3rem;
        }

        .page-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-muted);
            width: 32px;
            height: 32px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 0.78rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, color 0.15s;
        }

        .page-btn:hover:not(:disabled) {
            background: rgba(139, 92, 246, 0.1);
            color: #a78bfa;
            border-color: rgba(139, 92, 246, 0.3);
        }

        .page-btn.active {
            background: rgba(139, 92, 246, 0.15);
            color: #a78bfa;
            border-color: rgba(139, 92, 246, 0.4);
        }

        .page-btn:disabled {
            opacity: 0.35;
            cursor: default;
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
            max-width: 560px;
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
            transition: background 0.15s, color 0.15s;
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
        }

        /* ── FORM ── */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .form-group input,
        .form-group select {
            background: rgba(15, 23, 42, 0.6);
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
            border-color: rgba(139, 92, 246, 0.5);
        }

        .form-group input::placeholder {
            color: var(--text-muted);
        }

        .form-group select option {
            background: #1a2236;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* ── BUTTONS ── */
        .btn-submit {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
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

        .btn-warn {
            background: rgba(251, 191, 36, 0.1);
            border: 1px solid rgba(251, 191, 36, 0.25);
            color: var(--yellow);
            border-radius: 9px;
            padding: 0.65rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s;
        }

        .btn-warn:hover {
            background: rgba(251, 191, 36, 0.18);
        }

        .btn-danger {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.25);
            color: var(--red);
            border-radius: 9px;
            padding: 0.65rem 1.25rem;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s;
        }

        .btn-danger:hover {
            background: rgba(248, 113, 113, 0.18);
        }

        .btn-full {
            width: 100%;
            justify-content: center;
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

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .title-section {
                flex-direction: column;
            }

            .register-btn {
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
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon"><i class="bi bi-shield-lock-fill"></i></div>
                <div>
                    <span>NEXUS</span>
                    <small>CORE REALM v2.4</small>
                </div>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-label">Overview</div>
                <a class="nav-item" href="#"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                <a class="nav-item active" href="#"><i class="bi bi-building"></i> Organizations <span
                        class="nav-badge">12</span></a>
                <a class="nav-item" href="#"><i class="bi bi-people-fill"></i> Users</a>
                <a class="nav-item" href="#"><i class="bi bi-cpu-fill"></i> Nodes</a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-label">System</div>
                <a class="nav-item" href="#"><i class="bi bi-bar-chart-fill"></i> Analytics</a>
                <a class="nav-item" href="#"><i class="bi bi-bell-fill"></i> Notifications</a>
                <a class="nav-item" href="#"><i class="bi bi-shield-check"></i> Security</a>
                <a class="nav-item" href="#"><i class="bi bi-gear-fill"></i> Settings</a>
            </div>
            <div class="sidebar-footer">
                <div class="admin-card">
                    <div class="admin-avatar">SA</div>
                    <div class="admin-info">
                        <strong>Super Admin</strong>
                        <small>admin@nexus.io</small>
                    </div>
                    <i class="bi bi-three-dots-vertical" style="color:var(--text-muted); cursor:pointer;"></i>
                </div>
            </div>
        </aside>

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
                            <div class="badge-tag"><span class="badge-dot"></span> CORE REALM v2.4</div>
                            <h1>Organizations</h1>
                            <p class="subtitle">Multi-tenant orchestration • Global policy control • Enterprise
                                infrastructure matrix</p>
                        </div>
                        <button class="register-btn" onclick="openModal('addOrgModal')">
                            <i class="bi bi-plus-lg"></i> REGISTER ORGANIZATION
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-info">
                                <h4>CONNECTED SITES</h4>
                                <div class="stat-number">12</div>
                            </div>
                            <div class="stat-icon" style="color:#a78bfa;"><i class="bi bi-building"></i></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h4>ACTIVE SECTORS</h4>
                                <div class="stat-number" style="color:var(--green);">10</div>
                            </div>
                            <div class="stat-icon" style="color:var(--green);"><i class="bi bi-patch-check"></i></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h4>TRIAL ACCOUNTS</h4>
                                <div class="stat-number" style="color:var(--yellow);">02</div>
                            </div>
                            <div class="stat-icon" style="color:var(--yellow);"><i class="bi bi-hourglass-split"></i>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h4>LOADED NODES</h4>
                                <div class="stat-number" style="color:var(--pink);">48</div>
                            </div>
                            <div class="stat-icon" style="color:var(--pink);"><i class="bi bi-cpu-fill"></i></div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="filters-bar">
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" placeholder="Search tenants or admins...">
                        </div>
                        <div class="select-group">
                            <select class="custom-select">
                                <option>Status: All</option>
                                <option>Active</option>
                                <option>Evaluation</option>
                                <option>Revoked</option>
                            </select>
                            <select class="custom-select">
                                <option>Sort: Newest</option>
                                <option>Most Users</option>
                            </select>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-wrapper">
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Organization</th>
                                        <th>Admin</th>
                                        <th>Users</th>
                                        <th>Status</th>
                                        <th style="text-align:right;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="org-cell">
                                                <div class="org-avatar"
                                                    style="background:linear-gradient(135deg,#3b82f6,#6366f1);">A</div>
                                                <div>
                                                    <strong style="color:white; font-size:0.85rem;">Apex Global
                                                        Institute</strong>
                                                    <br><span style="font-size:0.7rem; color:var(--text-muted);">Added
                                                        12 May 2026</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span style="color:white; font-size:0.83rem;">Alex Mercer</span>
                                            <br><span style="font-size:0.7rem;">alex@apex-edu.com</span>
                                        </td>
                                        <td style="font-weight:600; color:var(--text-primary);">1,240</td>
                                        <td><span class="status status-active"><span class="status-dot"
                                                    style="background:var(--green);"></span> Active</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditModal('Apex Global Institute','Alex Mercer','alex@apex-edu.com','active')"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button class="icon-btn" title="Manage Actions"
                                                    onclick="openActionsModal('Apex Global Institute')"><i
                                                        class="bi bi-sliders"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="org-cell">
                                                <div class="org-avatar"
                                                    style="background:linear-gradient(135deg,#a855f7,#ec4899);">V</div>
                                                <div>
                                                    <strong style="color:white; font-size:0.85rem;">Vanguard Fitness
                                                        Corp</strong>
                                                    <br><span style="font-size:0.7rem; color:var(--text-muted);">Added
                                                        28 Apr 2026</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span style="color:white; font-size:0.83rem;">Sarah Jenkins</span>
                                            <br><span style="font-size:0.7rem;">s.jenkins@vanguard.com</span>
                                        </td>
                                        <td style="font-weight:600; color:var(--text-primary);">342</td>
                                        <td><span class="status status-active"><span class="status-dot"
                                                    style="background:var(--green);"></span> Active</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditModal('Vanguard Fitness Corp','Sarah Jenkins','s.jenkins@vanguard.com','active')"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button class="icon-btn" title="Manage Actions"
                                                    onclick="openActionsModal('Vanguard Fitness Corp')"><i
                                                        class="bi bi-sliders"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="org-cell">
                                                <div class="org-avatar"
                                                    style="background:linear-gradient(135deg,#f59e0b,#f97316);">N</div>
                                                <div>
                                                    <strong style="color:white; font-size:0.85rem;">Nexus Systems
                                                        Lab</strong>
                                                    <br><span style="font-size:0.7rem; color:var(--text-muted);">Added
                                                        20 May 2026</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span style="color:white; font-size:0.83rem;">Zayn Malik</span>
                                            <br><span style="font-size:0.7rem;">z.malik@nexus-labs.io</span>
                                        </td>
                                        <td style="font-weight:600; color:var(--text-primary);">18</td>
                                        <td><span class="status status-eval"><span class="status-dot"
                                                    style="background:var(--yellow);"></span> Evaluation</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditModal('Nexus Systems Lab','Zayn Malik','z.malik@nexus-labs.io','evaluation')"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button class="icon-btn" title="Manage Actions"
                                                    onclick="openActionsModal('Nexus Systems Lab')"><i
                                                        class="bi bi-sliders"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="org-cell">
                                                <div class="org-avatar"
                                                    style="background:linear-gradient(135deg,#ef4444,#f43f5e);">O</div>
                                                <div>
                                                    <strong style="color:white; font-size:0.85rem;">OmniRetail
                                                        Services</strong>
                                                    <br><span style="font-size:0.7rem; color:var(--text-muted);">Added
                                                        15 Jan 2026</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span style="color:white; font-size:0.83rem;">Robert Chen</span>
                                            <br><span style="font-size:0.7rem;">robert@omniretail.com</span>
                                        </td>
                                        <td style="font-weight:600; color:var(--text-primary);">0</td>
                                        <td><span class="status status-revoked"><span class="status-dot"
                                                    style="background:var(--red);"></span> Revoked</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditModal('OmniRetail Services','Robert Chen','robert@omniretail.com','revoked')"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button class="icon-btn" title="Manage Actions"
                                                    onclick="openActionsModal('OmniRetail Services')"><i
                                                        class="bi bi-sliders"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            <div>Showing <span style="color:white; font-weight:600;">1–4</span> of <span
                                    style="color:white; font-weight:600;">12</span> organizations</div>
                            <div class="page-btns">
                                <button class="page-btn" disabled><i class="bi bi-chevron-left"></i></button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── ADD ORG MODAL ── -->
    <div id="addOrgModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="addOrgTitle">
        <div class="modal">
            <div class="modal-header">
                <h3 id="addOrgTitle"><i class="bi bi-plus-lg" style="color:#8b5cf6;"></i> Register Organization</h3>
                <button class="modal-close" onclick="closeModal('addOrgModal')" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Organization Name</label>
                    <input type="text" placeholder="Enter organization name">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Admin Name</label>
                        <input type="text" placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" placeholder="admin@org.com">
                    </div>
                </div>
                <div class="form-group">
                    <label>Domain</label>
                    <input type="text" placeholder="org.platform.com">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Plan</label>
                        <select>
                            <option>Enterprise</option>
                            <option>Professional</option>
                            <option>Starter</option>
                            <option>Trial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>User Limit</label>
                        <input type="number" placeholder="e.g. 500">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('addOrgModal')">Cancel</button>
                <button class="btn-submit" onclick="closeModal('addOrgModal')"><i class="bi bi-check-lg"></i>
                    Register</button>
            </div>
        </div>
    </div>

    <!-- ── EDIT ORG MODAL ── -->
    <div id="editOrgModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="editOrgTitle">
        <div class="modal">
            <div class="modal-header">
                <h3 id="editOrgTitle"><i class="bi bi-pencil-square" style="color:#f59e0b;"></i> Edit Organization
                </h3>
                <button class="modal-close" onclick="closeModal('editOrgModal')" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Organization Name</label>
                    <input type="text" id="editOrgName" placeholder="Organization name">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Admin Name</label>
                        <input type="text" id="editAdminName" placeholder="Admin name">
                    </div>
                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" id="editAdminEmail" placeholder="admin@org.com">
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select id="editOrgStatus">
                        <option value="active">Active</option>
                        <option value="evaluation">Evaluation</option>
                        <option value="revoked">Revoked</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('editOrgModal')">Cancel</button>
                <button class="btn-submit" onclick="closeModal('editOrgModal')"><i class="bi bi-check-lg"></i> Save
                    Changes</button>
            </div>
        </div>
    </div>

    <!-- ── ACTIONS MODAL ── -->
    <div id="actionsModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="actionsTitle">
        <div class="modal" style="max-width:430px;">
            <div class="modal-header">
                <h3 id="actionsTitle"><i class="bi bi-sliders" style="color:#a78bfa;"></i> Actions: <span
                        id="actionOrgName" style="color:#e2e8f0;"></span></h3>
                <button class="modal-close" onclick="closeModal('actionsModal')" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body" style="gap:0.6rem;">
                <button class="btn-submit btn-full" onclick="closeModal('actionsModal')">
                    <i class="bi bi-arrow-repeat"></i> Renew Subscription
                </button>
                <button class="btn-warn" onclick="closeModal('actionsModal')">
                    <i class="bi bi-pause-circle"></i> Suspend Organization
                </button>
                <button class="btn-cancel btn-full" onclick="closeModal('actionsModal')">
                    <i class="bi bi-envelope"></i> Send Notification
                </button>
                <button class="btn-danger" onclick="closeModal('actionsModal')">
                    <i class="bi bi-trash"></i> Delete Organization
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal('actionsModal')">Close</button>
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

        // Generic modal open/close
        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }

        // Edit modal with pre-fill
        function openEditModal(orgName, adminName, adminEmail, status) {
            document.getElementById('editOrgName').value = orgName;
            document.getElementById('editAdminName').value = adminName;
            document.getElementById('editAdminEmail').value = adminEmail;
            document.getElementById('editOrgStatus').value = status;
            openModal('editOrgModal');
        }

        // Actions modal
        function openActionsModal(orgName) {
            document.getElementById('actionOrgName').textContent = orgName;
            openModal('actionsModal');
        }

        // Click overlay to close
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
    </script>
</body>

</html>
