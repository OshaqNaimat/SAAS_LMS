<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS — Settings</title>
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
            background: rgba(251, 191, 36, 0.1);
            border: 1px solid rgba(251, 191, 36, 0.25);
            color: var(--yellow);
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
            background: var(--yellow);
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

        .save-btn {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.7rem 1.4rem;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.2s;
            flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
        }

        .save-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.45);
        }

        /* ── SETTINGS TABS ── */
        .settings-tabs {
            display: flex;
            gap: 4px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 5px;
            margin-bottom: 2rem;
            overflow-x: auto;
            flex-wrap: nowrap;
        }

        .settings-tabs::-webkit-scrollbar {
            height: 3px;
        }

        .settings-tabs::-webkit-scrollbar-track {
            background: transparent;
        }

        .settings-tabs::-webkit-scrollbar-thumb {
            background: var(--border-hover);
            border-radius: 2px;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 0.55rem 1rem;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            white-space: nowrap;
            border: none;
            background: transparent;
            transition: all 0.2s;
            letter-spacing: 0.03em;
        }

        .tab-btn:hover {
            color: var(--text-secondary);
            background: rgba(148, 163, 184, 0.06);
        }

        .tab-btn.active {
            background: rgba(124, 58, 237, 0.18);
            color: #a78bfa;
        }

        .tab-btn i {
            font-size: 0.95rem;
        }

        /* ── SETTINGS SECTIONS ── */
        .settings-panel {
            display: none;
        }

        .settings-panel.active {
            display: block;
        }

        /* ── SECTION CARD ── */
        .section-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            transition: border-color 0.2s;
        }

        .section-card:hover {
            border-color: var(--border-hover);
        }

        .section-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .section-card-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-card-title i {
            font-size: 1rem;
            color: var(--accent);
        }

        .section-card-subtitle {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ── FORM CONTROLS ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .form-grid.cols-3 {
            grid-template-columns: 1fr 1fr 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="url"],
        select,
        textarea {
            background: var(--bg-input);
            border: 1px solid var(--border);
            color: var(--text-primary);
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.82rem;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: rgba(124, 58, 237, 0.5);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--text-muted);
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.9rem center;
        }

        select option {
            background: var(--bg-surface);
        }

        /* ── TOGGLE SWITCH ── */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        }

        .toggle-row:last-child {
            border-bottom: none;
        }

        .toggle-info {
            flex: 1;
            padding-right: 1.5rem;
        }

        .toggle-info strong {
            display: block;
            font-size: 0.82rem;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .toggle-info span {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .toggle {
            position: relative;
            width: 44px;
            height: 24px;
            flex-shrink: 0;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            inset: 0;
            background: rgba(148, 163, 184, 0.15);
            border-radius: 24px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            left: 3px;
            top: 3px;
            background: var(--text-muted);
            border-radius: 50%;
            transition: transform 0.2s, background 0.2s;
        }

        .toggle input:checked+.toggle-slider {
            background: rgba(124, 58, 237, 0.35);
        }

        .toggle input:checked+.toggle-slider::before {
            transform: translateX(20px);
            background: #a78bfa;
        }

        /* ── BADGE / STATUS ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .status-badge.active {
            background: rgba(52, 211, 153, 0.12);
            color: var(--green);
        }

        .status-badge.warning {
            background: rgba(251, 191, 36, 0.12);
            color: var(--yellow);
        }

        .status-badge.danger {
            background: rgba(248, 113, 113, 0.12);
            color: var(--red);
        }

        .status-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        /* ── PLAN CARDS ── */
        .plan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .plan-card {
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 1.2rem;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .plan-card:hover {
            border-color: var(--border-hover);
        }

        .plan-card.selected {
            border-color: var(--accent);
            background: rgba(124, 58, 237, 0.06);
        }

        .plan-card .plan-check {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--accent);
            display: none;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 11px;
        }

        .plan-card.selected .plan-check {
            display: flex;
        }

        .plan-name {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .plan-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 6px;
        }

        .plan-price span {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        .plan-desc {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        /* ── DANGER ZONE ── */
        .danger-zone {
            background: rgba(248, 113, 113, 0.04);
            border: 1px solid rgba(248, 113, 113, 0.2);
            border-radius: 14px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
        }

        .danger-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--red);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.2rem;
        }

        .danger-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(248, 113, 113, 0.08);
        }

        .danger-row:last-child {
            border-bottom: none;
        }

        .danger-info strong {
            display: block;
            font-size: 0.82rem;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .danger-info span {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .btn-danger {
            background: rgba(248, 113, 113, 0.1);
            color: var(--red);
            border: 1px solid rgba(248, 113, 113, 0.25);
            border-radius: 8px;
            padding: 0.55rem 1.1rem;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-danger:hover {
            background: rgba(248, 113, 113, 0.18);
            border-color: rgba(248, 113, 113, 0.4);
        }

        /* ── SMALL BUTTON ── */
        .btn-sm {
            background: rgba(148, 163, 184, 0.08);
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-sm:hover {
            background: rgba(148, 163, 184, 0.14);
            color: var(--text-primary);
        }

        .btn-sm.accent {
            background: rgba(124, 58, 237, 0.12);
            color: #a78bfa;
            border-color: rgba(124, 58, 237, 0.2);
        }

        .btn-sm.accent:hover {
            background: rgba(124, 58, 237, 0.2);
        }

        /* ── COLOR PICKERS ── */
        .color-row {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .color-swatch {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .color-swatch.active {
            border-color: white;
            transform: scale(1.1);
        }

        .color-input-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.4rem 0.75rem;
            flex: 1;
            min-width: 130px;
        }

        .color-input-wrap input[type="color"] {
            width: 24px;
            height: 24px;
            border: none;
            background: none;
            cursor: pointer;
            padding: 0;
            border-radius: 4px;
        }

        .color-input-wrap input[type="text"] {
            border: none;
            background: none;
            padding: 0;
            font-size: 0.8rem;
            flex: 1;
        }

        .color-input-wrap input[type="text"]:focus {
            box-shadow: none;
        }

        /* ── ROLE TABLE ── */
        .role-table {
            width: 100%;
            border-collapse: collapse;
        }

        .role-table th {
            font-size: 0.63rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0.7rem 0.75rem;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .role-table td {
            padding: 0.85rem 0.75rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
            border-bottom: 1px solid rgba(148, 163, 184, 0.05);
        }

        .role-table tr:last-child td {
            border-bottom: none;
        }

        .role-table tr:hover td {
            background: rgba(139, 92, 246, 0.03);
        }

        .perm-check {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .perm-check i.yes {
            color: var(--green);
        }

        .perm-check i.no {
            color: var(--text-muted);
        }

        /* ── INTEGRATION CARDS ── */
        .integration-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
        }

        .int-card {
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.1rem;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: border-color 0.2s;
        }

        .int-card:hover {
            border-color: var(--border-hover);
        }

        .int-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .int-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .int-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .int-desc {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .int-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
        }

        /* ── AUDIT LOG ── */
        .audit-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        }

        .audit-item:last-child {
            border-bottom: none;
        }

        .audit-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .audit-body {
            flex: 1;
        }

        .audit-action {
            font-size: 0.8rem;
            color: var(--text-primary);
            font-weight: 600;
        }

        .audit-meta {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .audit-time {
            font-size: 0.68rem;
            color: var(--text-muted);
            white-space: nowrap;
        }

        /* ── SIDEBAR OVERLAY MOBILE ── */
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
        @media(max-width:1023px) {
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-grid.cols-3 {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:600px) {
            .title-section {
                flex-direction: column;
            }

            .save-btn {
                width: 100%;
                justify-content: center;
            }

            .form-grid.cols-3 {
                grid-template-columns: 1fr;
            }

            .settings-tabs {
                gap: 2px;
            }

            .tab-btn {
                padding: 0.5rem 0.7rem;
                font-size: 0.72rem;
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
                    <div class="mini-icon"><i class="bi bi-shield-lock-fill" style="color:white;font-size:13px;"></i>
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
                            <div class="badge-tag"><span class="badge-dot"></span> SYSTEM CONFIG</div>
                            <h1>Settings</h1>
                            <p class="subtitle">Platform configuration • LMS preferences • Roles & integrations</p>
                        </div>
                        <button class="save-btn" onclick="saveSettings()">
                            <i class="bi bi-check2-circle"></i> SAVE CHANGES
                        </button>
                    </div>

                    <!-- Tabs -->
                    <div class="settings-tabs">
                        <button class="tab-btn active" onclick="switchTab('general',this)"><i class="bi bi-sliders"></i>
                            General</button>
                        <button class="tab-btn" onclick="switchTab('lms',this)"><i class="bi bi-mortarboard-fill"></i>
                            LMS</button>
                        <button class="tab-btn" onclick="switchTab('appearance',this)"><i
                                class="bi bi-palette-fill"></i> Appearance</button>
                        <button class="tab-btn" onclick="switchTab('security',this)"><i
                                class="bi bi-shield-lock-fill"></i> Security</button>
                        <button class="tab-btn" onclick="switchTab('roles',this)"><i
                                class="bi bi-person-badge-fill"></i> Roles</button>
                        <button class="tab-btn" onclick="switchTab('integrations',this)"><i
                                class="bi bi-puzzle-fill"></i> Integrations</button>
                        <button class="tab-btn" onclick="switchTab('email',this)"><i class="bi bi-envelope-fill"></i>
                            Email</button>
                        <button class="tab-btn" onclick="switchTab('billing',this)"><i
                                class="bi bi-credit-card-fill"></i> Billing</button>
                        <button class="tab-btn" onclick="switchTab('audit',this)"><i class="bi bi-journal-text"></i>
                            Audit Log</button>
                    </div>

                    <!-- ═══════════════════════════ GENERAL ═══════════════════════════ -->
                    <div class="settings-panel active" id="panel-general">
                        <!-- Platform Info -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-building-gear"></i> Platform
                                        Information</div>
                                    <div class="section-card-subtitle">Basic details visible across the platform</div>
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Platform Name</label>
                                    <input type="text" value="NEXUS LMS" placeholder="Platform Name">
                                </div>
                                <div class="form-group">
                                    <label>Support Email</label>
                                    <input type="email" value="support@nexus.io" placeholder="support@yourdomain.com">
                                </div>
                                <div class="form-group">
                                    <label>Platform URL</label>
                                    <input type="url" value="https://app.nexus.io" placeholder="https://...">
                                </div>
                                <div class="form-group">
                                    <label>Admin Email</label>
                                    <input type="email" value="admin@nexus.io" placeholder="admin@yourdomain.com">
                                </div>
                                <div class="form-group full">
                                    <label>Platform Description</label>
                                    <textarea placeholder="Describe your LMS platform...">Enterprise learning management system powering Nexus Core Realm. Serving 12 organizations and 1,248 active learners across multiple domains.</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Localization -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-globe2"></i> Localization & Region
                                    </div>
                                    <div class="section-card-subtitle">Timezone, language and date formatting</div>
                                </div>
                            </div>
                            <div class="form-grid cols-3">
                                <div class="form-group">
                                    <label>Default Language</label>
                                    <select>
                                        <option>English (US)</option>
                                        <option>English (UK)</option>
                                        <option>Arabic</option>
                                        <option>French</option>
                                        <option>Spanish</option>
                                        <option>German</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Timezone</label>
                                    <select>
                                        <option>UTC+0:00 — London</option>
                                        <option>UTC+5:00 — Karachi</option>
                                        <option selected>UTC+5:30 — New Delhi</option>
                                        <option>UTC-5:00 — New York</option>
                                        <option>UTC-8:00 — Los Angeles</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date Format</label>
                                    <select>
                                        <option>DD / MM / YYYY</option>
                                        <option selected>MM / DD / YYYY</option>
                                        <option>YYYY-MM-DD</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select>
                                        <option>USD — US Dollar</option>
                                        <option>EUR — Euro</option>
                                        <option>GBP — British Pound</option>
                                        <option>PKR — Pakistani Rupee</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Time Format</label>
                                    <select>
                                        <option selected>12-hour (AM/PM)</option>
                                        <option>24-hour</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Week Starts On</label>
                                    <select>
                                        <option>Sunday</option>
                                        <option selected>Monday</option>
                                        <option>Saturday</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Feature Toggles -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-toggles"></i> Feature Flags</div>
                                    <div class="section-card-subtitle">Enable or disable global platform features</div>
                                </div>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Maintenance Mode</strong><span>Take the platform
                                        offline for all non-admin users</span></div>
                                <label class="toggle"><input type="checkbox"><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>User Self-Registration</strong><span>Allow new users
                                        to sign up without an invitation</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Organization
                                        Self-Enrollment</strong><span>Organizations can add their own members</span>
                                </div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Public Course Catalog</strong><span>Show available
                                        courses to unauthenticated visitors</span></div>
                                <label class="toggle"><input type="checkbox"><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>API Access</strong><span>Allow organizations to use
                                        the Nexus REST API</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ LMS ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-lms">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-mortarboard-fill"></i> Learning
                                        Defaults</div>
                                    <div class="section-card-subtitle">Global defaults for courses and enrollments
                                    </div>
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Default Course Visibility</label>
                                    <select>
                                        <option>Private — Invite Only</option>
                                        <option selected>Organization Members</option>
                                        <option>Public</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Completion Threshold (%)</label>
                                    <input type="number" value="80" min="0" max="100">
                                </div>
                                <div class="form-group">
                                    <label>Max Enrollments per User</label>
                                    <input type="number" value="20" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Default Course Language</label>
                                    <select>
                                        <option selected>English</option>
                                        <option>Arabic</option>
                                        <option>French</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Certificate Provider</label>
                                    <select>
                                        <option selected>Nexus Built-in</option>
                                        <option>Accredible</option>
                                        <option>Badgr</option>
                                        <option>Custom</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Video Storage Provider</label>
                                    <select>
                                        <option>Nexus CDN</option>
                                        <option selected>AWS S3 + CloudFront</option>
                                        <option>Vimeo</option>
                                        <option>Bunny.net</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-ui-checks"></i> Assessment &
                                        Grading</div>
                                    <div class="section-card-subtitle">Quiz, exam and grading-related settings</div>
                                </div>
                            </div>
                            <div class="form-grid cols-3">
                                <div class="form-group">
                                    <label>Max Quiz Attempts</label>
                                    <input type="number" value="3" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Quiz Time Limit (mins)</label>
                                    <input type="number" value="60" min="5">
                                </div>
                                <div class="form-group">
                                    <label>Passing Score (%)</label>
                                    <input type="number" value="70" min="0" max="100">
                                </div>
                                <div class="form-group">
                                    <label>Grading Scale</label>
                                    <select>
                                        <option selected>Percentage (0–100%)</option>
                                        <option>Letter Grade (A–F)</option>
                                        <option>Points</option>
                                        <option>Pass / Fail</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Leaderboard Visibility</label>
                                    <select>
                                        <option selected>Organization-wide</option>
                                        <option>Global</option>
                                        <option>Hidden</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Discussion Forums</label>
                                    <select>
                                        <option selected>Enabled (Moderated)</option>
                                        <option>Enabled (Open)</option>
                                        <option>Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top:1.25rem;">
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Show Correct Answers After
                                            Submission</strong><span>Display correct answers once a quiz is
                                            submitted</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Randomize Question Order</strong><span>Shuffle
                                            questions each time a quiz is taken</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>AI-Powered Learning
                                            Recommendations</strong><span>Suggest courses based on learner activity
                                            patterns</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Gamification (Badges & XP)</strong><span>Award
                                            badges and experience points for course milestones</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-cloud-arrow-up-fill"></i> Content
                                        & Storage</div>
                                    <div class="section-card-subtitle">File upload limits and allowed content types
                                    </div>
                                </div>
                            </div>
                            <div class="form-grid cols-3">
                                <div class="form-group">
                                    <label>Max File Upload (MB)</label>
                                    <input type="number" value="512" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Max Video Duration (mins)</label>
                                    <input type="number" value="120" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Storage per Org (GB)</label>
                                    <input type="number" value="50" min="1">
                                </div>
                            </div>
                            <div style="margin-top:1.25rem;">
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>SCORM 1.2 Support</strong><span>Allow SCORM 1.2
                                            packages to be uploaded and tracked</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>SCORM 2004 / xAPI Support</strong><span>Enable Tin
                                            Can / xAPI learning record statements</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Auto-Transcode Videos</strong><span>Automatically
                                            compress and transcode uploaded videos</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ APPEARANCE ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-appearance">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-brush-fill"></i> Branding</div>
                                    <div class="section-card-subtitle">Customize how the platform looks to users</div>
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Platform Logo</label>
                                    <div style="display:flex;gap:10px;align-items:center;">
                                        <div
                                            style="width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,#7c3aed,#4f46e5);display:flex;align-items:center;justify-content:center;font-size:20px;color:white;flex-shrink:0;">
                                            <i class="bi bi-shield-lock-fill"></i>
                                        </div>
                                        <button class="btn-sm"><i class="bi bi-upload"></i> Upload Logo</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Favicon</label>
                                    <div style="display:flex;gap:10px;align-items:center;">
                                        <div
                                            style="width:32px;height:32px;border-radius:6px;background:linear-gradient(135deg,#7c3aed,#4f46e5);display:flex;align-items:center;justify-content:center;font-size:14px;color:white;flex-shrink:0;">
                                            <i class="bi bi-shield-lock-fill"></i>
                                        </div>
                                        <button class="btn-sm"><i class="bi bi-upload"></i> Upload Favicon</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Primary Accent Color</label>
                                    <div class="color-row">
                                        <div class="color-swatch active" style="background:#7c3aed;"
                                            onclick="selectColor(this,'#7c3aed')"></div>
                                        <div class="color-swatch" style="background:#2563eb;"
                                            onclick="selectColor(this,'#2563eb')"></div>
                                        <div class="color-swatch" style="background:#059669;"
                                            onclick="selectColor(this,'#059669')"></div>
                                        <div class="color-swatch" style="background:#dc2626;"
                                            onclick="selectColor(this,'#dc2626')"></div>
                                        <div class="color-swatch" style="background:#d97706;"
                                            onclick="selectColor(this,'#d97706')"></div>
                                        <div class="color-input-wrap">
                                            <input type="color" value="#7c3aed" id="accentColor"
                                                oninput="syncColor(this)">
                                            <input type="text" value="#7c3aed" id="accentHex"
                                                oninput="syncHex(this)" maxlength="7">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Default Theme</label>
                                    <select>
                                        <option selected>Dark (Default)</option>
                                        <option>Light</option>
                                        <option>System Preference</option>
                                    </select>
                                </div>
                                <div class="form-group full">
                                    <label>Custom CSS (Advanced)</label>
                                    <textarea style="font-family:monospace;font-size:0.75rem;"
                                        placeholder="/* Add custom CSS overrides here */
:root {
  --accent: #7c3aed;
}"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-layout-text-sidebar-reverse"></i>
                                        Layout Preferences</div>
                                    <div class="section-card-subtitle">Control navigation and UI behavior</div>
                                </div>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Collapsible Sidebar</strong><span>Allow users to
                                        collapse the navigation sidebar</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Show Breadcrumbs</strong><span>Display navigation
                                        breadcrumbs across all pages</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Compact Mode</strong><span>Reduce padding and spacing
                                        for denser content</span></div>
                                <label class="toggle"><input type="checkbox"><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Animated Transitions</strong><span>Enable page and
                                        component transition animations</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ SECURITY ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-security">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-shield-lock-fill"></i>
                                        Authentication</div>
                                    <div class="section-card-subtitle">Login methods and session management</div>
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Session Timeout (minutes)</label>
                                    <input type="number" value="120" min="5">
                                </div>
                                <div class="form-group">
                                    <label>Max Login Attempts</label>
                                    <input type="number" value="5" min="1">
                                </div>
                                <div class="form-group">
                                    <label>Lockout Duration (minutes)</label>
                                    <input type="number" value="30" min="1">
                                </div>
                                <div class="form-group">
                                    <label>JWT Token Expiry (hours)</label>
                                    <input type="number" value="24" min="1">
                                </div>
                            </div>
                            <div style="margin-top:1.25rem;">
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Two-Factor Authentication
                                            (2FA)</strong><span>Require 2FA for all Super Admin logins</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Single Sign-On (SSO)</strong><span>Enable SAML 2.0
                                            / OIDC SSO for organizations</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Google OAuth Login</strong><span>Allow users to
                                            sign in with Google accounts</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Microsoft Azure AD Login</strong><span>Allow users
                                            to sign in with Microsoft accounts</span></div>
                                    <label class="toggle"><input type="checkbox"><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>IP Allowlisting</strong><span>Restrict admin panel
                                            access to specific IP ranges</span></div>
                                    <label class="toggle"><input type="checkbox"><span
                                            class="toggle-slider"></span></label>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-key-fill"></i> Password Policy
                                    </div>
                                    <div class="section-card-subtitle">Enforce strong passwords for all users</div>
                                </div>
                            </div>
                            <div class="form-grid cols-3">
                                <div class="form-group">
                                    <label>Minimum Length</label>
                                    <input type="number" value="12" min="6">
                                </div>
                                <div class="form-group">
                                    <label>Password Expiry (days)</label>
                                    <input type="number" value="90" min="0">
                                </div>
                                <div class="form-group">
                                    <label>Prevent Last N Passwords</label>
                                    <input type="number" value="5" min="0">
                                </div>
                            </div>
                            <div style="margin-top:1.25rem;">
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Require Uppercase Letters</strong><span>At least
                                            one uppercase character required</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Require Numbers</strong><span>At least one numeric
                                            digit required</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Require Special Characters</strong><span>At least
                                            one special character (!@#$...) required</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Danger Zone -->
                        <div class="danger-zone">
                            <div class="danger-title"><i class="bi bi-exclamation-triangle-fill"></i> Danger Zone
                            </div>
                            <div class="danger-row">
                                <div class="danger-info"><strong>Force Logout All Users</strong><span>Immediately
                                        invalidate all active sessions platform-wide</span></div>
                                <button class="btn-danger">Force Logout</button>
                            </div>
                            <div class="danger-row">
                                <div class="danger-info"><strong>Revoke All API Keys</strong><span>Revoke every API key
                                        across all organizations</span></div>
                                <button class="btn-danger">Revoke All Keys</button>
                            </div>
                            <div class="danger-row">
                                <div class="danger-info"><strong>Reset All 2FA Devices</strong><span>Force all users to
                                        re-enroll their 2FA devices</span></div>
                                <button class="btn-danger">Reset 2FA</button>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ ROLES ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-roles">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-person-badge-fill"></i> Role &
                                        Permission Matrix</div>
                                    <div class="section-card-subtitle">Define what each role can do across the platform
                                    </div>
                                </div>
                                <button class="btn-sm accent"><i class="bi bi-plus-lg"></i> New Role</button>
                            </div>
                            <div style="overflow-x:auto;">
                                <table class="role-table">
                                    <thead>
                                        <tr>
                                            <th style="min-width:160px;">Permission</th>
                                            <th style="text-align:center;">Super Admin</th>
                                            <th style="text-align:center;">Org Admin</th>
                                            <th style="text-align:center;">Instructor</th>
                                            <th style="text-align:center;">Learner</th>
                                            <th style="text-align:center;">Guest</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Manage Platform</td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Manage Organizations
                                            </td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Manage Users</td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Create / Edit
                                                Courses</td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Enroll Learners</td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">View Analytics</td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Take Courses</td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">View Public Catalog
                                            </td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Issue Certificates
                                            </td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                        <tr>
                                            <td style="color:var(--text-primary);font-weight:600;">Billing &
                                                Subscriptions</td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-check-circle-fill yes"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                            <td class="perm-check"><i class="bi bi-x-circle no"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ INTEGRATIONS ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-integrations">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-puzzle-fill"></i> Connected
                                        Integrations</div>
                                    <div class="section-card-subtitle">Third-party services connected to NEXUS</div>
                                </div>
                                <button class="btn-sm accent"><i class="bi bi-plus-lg"></i> Browse
                                    Marketplace</button>
                            </div>
                            <div class="integration-grid">
                                <div class="int-card">
                                    <div class="int-header">
                                        <div class="int-icon"
                                            style="background:rgba(52,211,153,0.12);color:var(--green);"><i
                                                class="bi bi-stripe"></i></div>
                                        <div>
                                            <div class="int-name">Stripe</div><span class="status-badge active"><span
                                                    class="status-dot"></span>Connected</span>
                                        </div>
                                    </div>
                                    <div class="int-desc">Payment processing for subscriptions and one-time purchases.
                                    </div>
                                    <div class="int-footer"><button class="btn-sm"><i class="bi bi-gear"></i>
                                            Configure</button><button class="btn-sm"
                                            style="color:var(--red);border-color:rgba(248,113,113,0.2);">Disconnect</button>
                                    </div>
                                </div>
                                <div class="int-card">
                                    <div class="int-header">
                                        <div class="int-icon"
                                            style="background:rgba(96,165,250,0.12);color:var(--blue);"><i
                                                class="bi bi-zoom-in"></i></div>
                                        <div>
                                            <div class="int-name">Zoom</div><span class="status-badge active"><span
                                                    class="status-dot"></span>Connected</span>
                                        </div>
                                    </div>
                                    <div class="int-desc">Live virtual classroom sessions and webinars.</div>
                                    <div class="int-footer"><button class="btn-sm"><i class="bi bi-gear"></i>
                                            Configure</button><button class="btn-sm"
                                            style="color:var(--red);border-color:rgba(248,113,113,0.2);">Disconnect</button>
                                    </div>
                                </div>
                                <div class="int-card">
                                    <div class="int-header">
                                        <div class="int-icon" style="background:rgba(124,58,237,0.12);color:#a78bfa;">
                                            <i class="bi bi-slack"></i>
                                        </div>
                                        <div>
                                            <div class="int-name">Slack</div><span class="status-badge warning"><span
                                                    class="status-dot"></span>Pending</span>
                                        </div>
                                    </div>
                                    <div class="int-desc">Notifications and learner activity alerts to Slack channels.
                                    </div>
                                    <div class="int-footer"><button class="btn-sm accent"><i
                                                class="bi bi-link-45deg"></i> Connect</button></div>
                                </div>
                                <div class="int-card">
                                    <div class="int-header">
                                        <div class="int-icon"
                                            style="background:rgba(251,191,36,0.12);color:var(--yellow);"><i
                                                class="bi bi-google"></i></div>
                                        <div>
                                            <div class="int-name">Google Workspace</div><span
                                                class="status-badge active"><span
                                                    class="status-dot"></span>Connected</span>
                                        </div>
                                    </div>
                                    <div class="int-desc">SSO and Google Drive content import support.</div>
                                    <div class="int-footer"><button class="btn-sm"><i class="bi bi-gear"></i>
                                            Configure</button><button class="btn-sm"
                                            style="color:var(--red);border-color:rgba(248,113,113,0.2);">Disconnect</button>
                                    </div>
                                </div>
                                <div class="int-card">
                                    <div class="int-header">
                                        <div class="int-icon"
                                            style="background:rgba(34,211,238,0.12);color:var(--cyan);"><i
                                                class="bi bi-mailbox-flag"></i></div>
                                        <div>
                                            <div class="int-name">Mailchimp</div><span
                                                class="status-badge danger"><span
                                                    class="status-dot"></span>Disconnected</span>
                                        </div>
                                    </div>
                                    <div class="int-desc">Email marketing campaigns and learner newsletters.</div>
                                    <div class="int-footer"><button class="btn-sm accent"><i
                                                class="bi bi-link-45deg"></i> Connect</button></div>
                                </div>
                                <div class="int-card">
                                    <div class="int-header">
                                        <div class="int-icon"
                                            style="background:rgba(251,146,60,0.12);color:var(--orange);"><i
                                                class="bi bi-fire"></i></div>
                                        <div>
                                            <div class="int-name">HubSpot CRM</div><span
                                                class="status-badge danger"><span
                                                    class="status-dot"></span>Disconnected</span>
                                        </div>
                                    </div>
                                    <div class="int-desc">Sync learners and organizations to HubSpot CRM.</div>
                                    <div class="int-footer"><button class="btn-sm accent"><i
                                                class="bi bi-link-45deg"></i> Connect</button></div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-code-slash"></i> Webhooks</div>
                                    <div class="section-card-subtitle">Push real-time events to external endpoints
                                    </div>
                                </div>
                                <button class="btn-sm accent"><i class="bi bi-plus-lg"></i> Add Webhook</button>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Endpoint URL</label>
                                    <input type="url" placeholder="https://your-server.com/webhook">
                                </div>
                                <div class="form-group">
                                    <label>Trigger Events</label>
                                    <select>
                                        <option>All Events</option>
                                        <option>User Enrolled</option>
                                        <option>Course Completed</option>
                                        <option>Certificate Issued</option>
                                        <option>Payment Received</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Secret Key</label>
                                    <input type="password" placeholder="Webhook signing secret">
                                </div>
                                <div class="form-group">
                                    <label>Retry Policy</label>
                                    <select>
                                        <option selected>3 retries with backoff</option>
                                        <option>5 retries with backoff</option>
                                        <option>No retries</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ EMAIL ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-email">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-send-fill"></i> SMTP Configuration
                                    </div>
                                    <div class="section-card-subtitle">Outgoing email server settings</div>
                                </div>
                                <button class="btn-sm"><i class="bi bi-send"></i> Send Test Email</button>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>SMTP Host</label>
                                    <input type="text" value="smtp.sendgrid.net" placeholder="smtp.example.com">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Port</label>
                                    <input type="number" value="587">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Username</label>
                                    <input type="text" value="apikey" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label>SMTP Password</label>
                                    <input type="password" value="•••••••••••••••••" placeholder="password">
                                </div>
                                <div class="form-group">
                                    <label>From Name</label>
                                    <input type="text" value="NEXUS LMS" placeholder="Your Platform Name">
                                </div>
                                <div class="form-group">
                                    <label>From Email</label>
                                    <input type="email" value="noreply@nexus.io"
                                        placeholder="noreply@yourdomain.com">
                                </div>
                                <div class="form-group">
                                    <label>Encryption</label>
                                    <select>
                                        <option selected>TLS</option>
                                        <option>SSL</option>
                                        <option>None</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email Provider</label>
                                    <select>
                                        <option selected>SendGrid</option>
                                        <option>Mailgun</option>
                                        <option>AWS SES</option>
                                        <option>Postmark</option>
                                        <option>Custom SMTP</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-envelope-open-fill"></i> Email
                                        Notifications</div>
                                    <div class="section-card-subtitle">Control which automated emails are sent</div>
                                </div>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Welcome Email on Signup</strong><span>Send a welcome
                                        email when a new user registers</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Course Enrollment Confirmation</strong><span>Notify
                                        learners when they enroll in a course</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Course Completion Certificate</strong><span>Send
                                        certificate email on course completion</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Assignment Due Reminders</strong><span>Remind learners
                                        of upcoming assignment deadlines</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Instructor Graded Feedback</strong><span>Notify
                                        learner when an instructor grades their submission</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>New Announcements</strong><span>Email learners when a
                                        course instructor posts an announcement</span></div>
                                <label class="toggle"><input type="checkbox"><span
                                        class="toggle-slider"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div class="toggle-info"><strong>Admin Security Alerts</strong><span>Notify super admin
                                        of suspicious login attempts</span></div>
                                <label class="toggle"><input type="checkbox" checked><span
                                        class="toggle-slider"></span></label>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ BILLING ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-billing">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-credit-card-fill"></i>
                                        Subscription Plans</div>
                                    <div class="section-card-subtitle">Define plans available to organizations</div>
                                </div>
                                <button class="btn-sm accent"><i class="bi bi-plus-lg"></i> New Plan</button>
                            </div>
                            <div class="plan-grid">
                                <div class="plan-card">
                                    <div class="plan-check"><i class="bi bi-check-lg"></i></div>
                                    <div class="plan-name">Trial</div>
                                    <div class="plan-price">$0<span> / 14 days</span></div>
                                    <div class="plan-desc">Up to 10 users, 5 courses, no certificate issuance.</div>
                                </div>
                                <div class="plan-card">
                                    <div class="plan-check"><i class="bi bi-check-lg"></i></div>
                                    <div class="plan-name">Starter</div>
                                    <div class="plan-price">$49<span> / mo</span></div>
                                    <div class="plan-desc">Up to 50 users, unlimited courses, basic analytics.</div>
                                </div>
                                <div class="plan-card selected">
                                    <div class="plan-check"><i class="bi bi-check-lg"></i></div>
                                    <div class="plan-name">Professional</div>
                                    <div class="plan-price">$149<span> / mo</span></div>
                                    <div class="plan-desc">Up to 500 users, SCORM, SSO, advanced analytics.</div>
                                </div>
                                <div class="plan-card">
                                    <div class="plan-check"><i class="bi bi-check-lg"></i></div>
                                    <div class="plan-name">Enterprise</div>
                                    <div class="plan-price">Custom<span></span></div>
                                    <div class="plan-desc">Unlimited users, white-label, dedicated support, SLA.</div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-receipt"></i> Billing Settings
                                    </div>
                                    <div class="section-card-subtitle">Invoice and payment preferences</div>
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Billing Cycle</label>
                                    <select>
                                        <option selected>Monthly</option>
                                        <option>Annual (save 20%)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tax Rate (%)</label>
                                    <input type="number" value="0" min="0" max="100"
                                        step="0.1">
                                </div>
                                <div class="form-group">
                                    <label>Invoice Prefix</label>
                                    <input type="text" value="NX-INV-" placeholder="INV-">
                                </div>
                                <div class="form-group">
                                    <label>Payment Gateway</label>
                                    <select>
                                        <option selected>Stripe</option>
                                        <option>PayPal</option>
                                        <option>Razorpay</option>
                                        <option>Manual</option>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top:1.25rem;">
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Auto-renew
                                            Subscriptions</strong><span>Automatically charge at the end of each billing
                                            cycle</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Send Invoice Emails</strong><span>Email PDF
                                            invoices to organization billing contacts</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div class="toggle-info"><strong>Failed Payment Retry</strong><span>Retry failed
                                            payments up to 3 times over 7 days</span></div>
                                    <label class="toggle"><input type="checkbox" checked><span
                                            class="toggle-slider"></span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ═══════════════════════════ AUDIT LOG ═══════════════════════════ -->
                    <div class="settings-panel" id="panel-audit">
                        <div class="section-card">
                            <div class="section-card-header">
                                <div>
                                    <div class="section-card-title"><i class="bi bi-journal-text"></i> Audit Log</div>
                                    <div class="section-card-subtitle">Recent admin actions across the platform</div>
                                </div>
                                <button class="btn-sm"><i class="bi bi-download"></i> Export CSV</button>
                            </div>

                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(52,211,153,0.12);color:var(--green);">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>
                                <div class="audit-body">
                                    <div class="audit-action">User Enrolled — Jane Cooper added to "Advanced React
                                        2026"</div>
                                    <div class="audit-meta">By <strong style="color:var(--text-secondary);">Org Admin,
                                            Apex Global</strong> · IP 102.44.21.5</div>
                                </div>
                                <div class="audit-time">2 min ago</div>
                            </div>
                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(96,165,250,0.12);color:var(--blue);"><i
                                        class="bi bi-gear-fill"></i></div>
                                <div class="audit-body">
                                    <div class="audit-action">Settings Updated — SMTP configuration changed</div>
                                    <div class="audit-meta">By <strong style="color:var(--text-secondary);">Super
                                            Admin</strong> · IP 192.168.1.1</div>
                                </div>
                                <div class="audit-time">18 min ago</div>
                            </div>
                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(251,191,36,0.12);color:var(--yellow);">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <div class="audit-body">
                                    <div class="audit-action">Certificate Issued — Ahmed Khan completed "Data Science
                                        Bootcamp"</div>
                                    <div class="audit-meta">By <strong
                                            style="color:var(--text-secondary);">System</strong> · Automated</div>
                                </div>
                                <div class="audit-time">1 hr ago</div>
                            </div>
                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(244,114,182,0.12);color:var(--pink);">
                                    <i class="bi bi-credit-card-fill"></i>
                                </div>
                                <div class="audit-body">
                                    <div class="audit-action">Plan Upgraded — TechVantage Solutions → Professional Plan
                                    </div>
                                    <div class="audit-meta">By <strong style="color:var(--text-secondary);">Billing
                                            System</strong> · Stripe charge #ch_3Pxm...</div>
                                </div>
                                <div class="audit-time">3 hr ago</div>
                            </div>
                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(248,113,113,0.12);color:var(--red);"><i
                                        class="bi bi-shield-exclamation"></i></div>
                                <div class="audit-body">
                                    <div class="audit-action">Failed Login Attempt — 5 consecutive failures for user
                                        m.ali@vanguard.io</div>
                                    <div class="audit-meta">Account temporarily locked · IP 41.33.122.88</div>
                                </div>
                                <div class="audit-time">5 hr ago</div>
                            </div>
                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(34,211,238,0.12);color:var(--cyan);"><i
                                        class="bi bi-building-add"></i></div>
                                <div class="audit-body">
                                    <div class="audit-action">Organization Created — "EduPrime Academy" registered on
                                        Starter plan</div>
                                    <div class="audit-meta">By <strong style="color:var(--text-secondary);">Super
                                            Admin</strong> · IP 192.168.1.1</div>
                                </div>
                                <div class="audit-time">Yesterday</div>
                            </div>
                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(124,58,237,0.12);color:#a78bfa;"><i
                                        class="bi bi-file-earmark-plus-fill"></i></div>
                                <div class="audit-body">
                                    <div class="audit-action">Course Published — "Introduction to Machine Learning"
                                        made live</div>
                                    <div class="audit-meta">By <strong
                                            style="color:var(--text-secondary);">Instructor, Dr. Sarah Lee</strong> ·
                                        Apex Global</div>
                                </div>
                                <div class="audit-time">Yesterday</div>
                            </div>
                            <div class="audit-item">
                                <div class="audit-icon" style="background:rgba(251,146,60,0.12);color:var(--orange);">
                                    <i class="bi bi-person-x-fill"></i>
                                </div>
                                <div class="audit-body">
                                    <div class="audit-action">User Suspended — account@spammer.io flagged and suspended
                                    </div>
                                    <div class="audit-meta">By <strong style="color:var(--text-secondary);">Super
                                            Admin</strong> · Abuse report #182</div>
                                </div>
                                <div class="audit-time">2 days ago</div>
                            </div>
                        </div>
                    </div>

                </div><!-- /dashboard-content -->
            </div><!-- /dashboard-scroll -->
        </div><!-- /main-wrapper -->
    </div><!-- /app-container -->

    <script>
        /* ── SIDEBAR ── */
        function toggleSidebar() {
            const s = document.getElementById('sidebar'),
                o = document.getElementById('sidebarOverlay');
            s.classList.toggle('open');
            o.classList.toggle('show', s.classList.contains('open'));
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('show');
        }
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });

        /* ── TABS ── */
        function switchTab(panelId, btn) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.settings-panel').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('panel-' + panelId).classList.add('active');
        }

        /* ── COLOR PICKERS ── */
        function selectColor(el, hex) {
            document.querySelectorAll('.color-swatch').forEach(s => s.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('accentColor').value = hex;
            document.getElementById('accentHex').value = hex;
        }

        function syncColor(input) {
            document.getElementById('accentHex').value = input.value;
        }

        function syncHex(input) {
            const v = input.value;
            if (/^#[0-9A-Fa-f]{6}$/.test(v)) document.getElementById('accentColor').value = v;
        }

        /* ── PLAN SELECTION ── */
        document.querySelectorAll('.plan-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
            });
        });

        /* ── SAVE TOAST ── */
        function saveSettings() {
            const btn = document.querySelector('.save-btn');
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check2-all"></i> SAVED!';
            btn.style.background = 'linear-gradient(135deg,#059669,#047857)';
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.style.background = '';
            }, 2200);
        }
    </script>
</body>

</html>
