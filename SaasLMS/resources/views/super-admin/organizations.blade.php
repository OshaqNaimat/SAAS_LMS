<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>NEXUS • organization matrix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #0a0f1c;
            overflow: hidden;
            height: 100vh;
        }

        /* ========== LAYOUT STRUCTURE ========== */
        .app-container {
            display: flex;
            height: 100vh;
            position: relative;
        }

        /* ========== SIDEBAR OVERLAY (mobile) ========== */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 40;
            display: none;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 260px;
            min-width: 260px;
            background: #080c16;
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 50;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.4);
        }

        .sidebar-content {
            flex: 1;
            padding: 1.5rem 1.1rem;
            display: flex;
            flex-direction: column;
            gap: 1.8rem;
            overflow-y: auto;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding-bottom: 1.3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, #7c3aed, #4f46e5, #c026d3);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
            flex-shrink: 0;
        }

        .logo-text h2 {
            color: white;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .logo-text p {
            color: #94a3b8;
            font-size: 0.65rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.7rem 0.9rem;
            border-radius: 1rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-item i {
            font-size: 1.1rem;
            width: 1.3rem;
            text-align: center;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.04);
            color: #e2e8f0;
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.25), rgba(79, 70, 229, 0.15));
            color: white;
            border: 1px solid rgba(139, 92, 246, 0.3);
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.2);
        }

        .nav-badge {
            margin-left: auto;
            background: rgba(139, 92, 246, 0.3);
            color: #c4b5fd;
            padding: 0.15rem 0.55rem;
            border-radius: 2rem;
            font-size: 0.68rem;
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 1rem 1.1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            flex-shrink: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .user-avatar {
            width: 2.2rem;
            height: 2.2rem;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            border-radius: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .user-text h4 {
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .user-text p {
            color: #64748b;
            font-size: 0.65rem;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #94a3b8;
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        /* ========== MAIN CONTENT AREA ========== */
        .main-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            background: #0a0f1c;
        }

        /* Mobile header */
        .mobile-header {
            display: none;
            align-items: center;
            justify-content: space-between;
            background: rgba(10, 15, 28, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 0.8rem 1.3rem;
            position: sticky;
            top: 0;
            z-index: 35;
            flex-shrink: 0;
        }

        .brand-mobile {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .brand-mobile .mini-icon {
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            border-radius: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.5);
        }

        .brand-mobile span {
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
            letter-spacing: -0.5px;
        }

        .hamburger-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            padding: 0.4rem 0.7rem;
            border-radius: 1rem;
            font-size: 1.4rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        /* Scrollable dashboard content */
        .dashboard-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        .dashboard-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .dashboard-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .dashboard-scroll::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.3);
            border-radius: 10px;
        }

        .dashboard-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 92, 246, 0.5);
        }

        .dashboard-content {
            padding: 1.5rem;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.8rem;
        }

        @media (min-width: 768px) {
            .dashboard-content {
                padding: 2rem;
            }
        }

        /* Title block */
        .title-section {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .title-section {
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
            }
        }

        .title-group .badge {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #a78bfa;
            margin-bottom: 0.4rem;
        }

        .badge-dot {
            width: 0.45rem;
            height: 0.45rem;
            background: #8b5cf6;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 10px #8b5cf6;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.6;
            }
        }

        .title-group h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -1px;
            line-height: 1.1;
            background: linear-gradient(to right, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @media (min-width: 768px) {
            .title-group h1 {
                font-size: 3rem;
            }
        }

        .subtitle {
            color: #94a3b8;
            max-width: 500px;
            margin-top: 0.2rem;
            font-size: 0.85rem;
        }

        .register-btn {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 2.5rem;
            color: white;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.4);
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.15);
            white-space: nowrap;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            box-shadow: 0 15px 30px rgba(139, 92, 246, 0.6);
            transform: translateY(-2px);
        }

        /* Stats cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background: rgba(15, 20, 35, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2rem;
            padding: 1.4rem 1.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.4);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -30%;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            transition: 0.4s;
            pointer-events: none;
        }

        .stat-card:hover::before {
            transform: scale(1.3);
            opacity: 0.8;
        }

        .stat-info h4 {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: #94a3b8;
            margin-bottom: 0.3rem;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: white;
            line-height: 1;
        }

        .stat-icon {
            width: 2.8rem;
            height: 2.8rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 2;
        }

        /* Filters */
        .filters-bar {
            background: rgba(15, 22, 37, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2.2rem;
            padding: 0.9rem 1.3rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.8rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .search-box {
            flex: 2;
            min-width: 180px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.95rem;
        }

        .search-box input {
            width: 100%;
            background: #0f1625;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 2.2rem;
            padding: 0.7rem 1rem 0.7rem 2.3rem;
            color: white;
            font-size: 0.85rem;
            outline: none;
            transition: 0.2s;
        }

        .search-box input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.3);
        }

        .select-group {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .custom-select {
            background: #0f1625;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
            padding: 0.7rem 1.8rem 0.7rem 1.1rem;
            border-radius: 2.2rem;
            font-size: 0.8rem;
            font-weight: 500;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            cursor: pointer;
            outline: none;
        }

        /* Table */
        .table-wrapper {
            background: rgba(15, 22, 37, 0.65);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 2.2rem;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        thead tr {
            background: rgba(20, 27, 45, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        th {
            padding: 1rem 1.1rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.3px;
            color: #94a3b8;
            text-align: left;
        }

        td {
            padding: 1rem 1.1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            color: #e2e8f0;
            font-size: 0.83rem;
        }

        .org-cell {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .org-avatar {
            width: 2.3rem;
            height: 2.3rem;
            border-radius: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            color: white;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
            flex-shrink: 0;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.8rem;
            border-radius: 2rem;
            font-size: 0.7rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(52, 211, 153, 0.3);
        }

        .status-eval {
            background: rgba(251, 191, 36, 0.12);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .status-revoked {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.3);
        }

        .status-dot {
            display: inline-block;
            width: 5px;
            height: 5px;
            border-radius: 50%;
        }

        .action-btns {
            display: flex;
            gap: 0.25rem;
            justify-content: flex-end;
        }

        .icon-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #94a3b8;
            padding: 0.4rem 0.6rem;
            border-radius: 0.9rem;
            font-size: 0.95rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .icon-btn:hover {
            background: rgba(139, 92, 246, 0.2);
            color: #c4b5fd;
            border-color: #8b5cf6;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.3rem;
            background: rgba(20, 27, 45, 0.7);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.78rem;
            color: #94a3b8;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .page-btns {
            display: flex;
            gap: 0.3rem;
        }

        .page-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #cbd5e1;
            padding: 0.4rem 0.9rem;
            border-radius: 2rem;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.78rem;
        }

        .page-btn.active {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            border-color: transparent;
            color: white;
            box-shadow: 0 6px 15px rgba(124, 58, 237, 0.5);
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* ========== MODAL STYLES ========== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(6px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal {
            background: #111827;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 2rem;
            width: 100%;
            max-width: 550px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.7);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem 1.8rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .modal-header h3 {
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .modal-close {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            width: 2.3rem;
            height: 2.3rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            font-size: 1.1rem;
        }

        .modal-close:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .modal-body {
            padding: 1.5rem 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group label {
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            background: #0f1625;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.2rem;
            padding: 0.8rem 1.1rem;
            color: white;
            font-size: 0.88rem;
            outline: none;
            transition: 0.2s;
            font-family: inherit;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.2);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
            padding: 1.2rem 1.8rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            padding: 0.7rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.82rem;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .btn-submit {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            border: none;
            padding: 0.7rem 1.8rem;
            border-radius: 2rem;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.82rem;
            box-shadow: 0 8px 20px rgba(124, 58, 237, 0.4);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            box-shadow: 0 12px 25px rgba(139, 92, 246, 0.6);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 0.7rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.82rem;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.5);
        }

        .hidden {
            display: none !important;
        }

        /* ========== RESPONSIVE BEHAVIOR ========== */
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                transform: translateX(-100%);
                z-index: 50;
                width: 260px;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .mobile-header {
                display: flex;
            }

            .main-wrapper {
                margin-left: 0;
            }
        }

        @media (min-width: 1024px) {
            .mobile-header {
                display: none;
            }

            .sidebar-overlay {
                display: none !important;
            }

            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="app-container">
        <!-- Sidebar Overlay -->
        <div id="sidebarOverlay" class="sidebar-overlay hidden" onclick="closeSidebar()"></div>

        <!-- Sidebar -->
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
                    <a href="#" class="nav-item">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="nav-item active">
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

        <!-- Main Content -->
        <div class="main-wrapper">
            <!-- Mobile Header -->
            <header class="mobile-header">
                <div class="brand-mobile">
                    <div class="mini-icon"><i class="bi bi-shield-lock-fill"></i></div>
                    <span>NEXUS</span>
                </div>
                <button class="hamburger-btn" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
            </header>

            <!-- Scrollable Dashboard Content -->
            <div class="dashboard-scroll">
                <div class="dashboard-content">
                    <!-- Title Section -->
                    <div class="title-section">
                        <div class="title-group">
                            <div class="badge"><span class="badge-dot"></span> CORE REALM v2.4</div>
                            <h1>Organizations</h1>
                            <p class="subtitle">Multi-tenant orchestration • Global policy control • Enterprise
                                infrastructure matrix</p>
                        </div>
                        <button class="register-btn" onclick="openAddOrgModal()"><i class="bi bi-plus-lg"></i> REGISTER
                            ORGANIZATION</button>
                    </div>

                    <!-- Stats Grid -->
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
                                <div class="stat-number" style="color:#34d399;">10</div>
                            </div>
                            <div class="stat-icon" style="color:#34d399;"><i class="bi bi-patch-check"></i></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h4>TRIAL ACCOUNTS</h4>
                                <div class="stat-number" style="color:#fbbf24;">02</div>
                            </div>
                            <div class="stat-icon" style="color:#fbbf24;"><i class="bi bi-hourglass-split"></i></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-info">
                                <h4>LOADED NODES</h4>
                                <div class="stat-number" style="color:#f472b6;">48</div>
                            </div>
                            <div class="stat-icon" style="color:#f472b6;"><i class="bi bi-cpu-fill"></i></div>
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
                                                <div><strong style="color:white;">Apex Global
                                                        Institute</strong><br><span
                                                        style="font-size:0.7rem; color:#94a3b8;">Added 12 May
                                                        2026</span></div>
                                            </div>
                                        </td>
                                        <td><span style="color:white;">Alex Mercer</span><br><span
                                                style="font-size:0.7rem;">alex@apex-edu.com</span></td>
                                        <td style="font-weight:600;">1,240</td>
                                        <td><span class="status status-active"><span class="status-dot"
                                                    style="background:#34d399;"></span> Active</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditOrgModal('Apex Global Institute', 'Alex Mercer', 'alex@apex-edu.com', 'active')"><i
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
                                                <div><strong style="color:white;">Vanguard Fitness
                                                        Corp</strong><br><span
                                                        style="font-size:0.7rem; color:#94a3b8;">Added 28 Apr
                                                        2026</span></div>
                                            </div>
                                        </td>
                                        <td><span style="color:white;">Sarah Jenkins</span><br><span
                                                style="font-size:0.7rem;">s.jenkins@vanguard.com</span></td>
                                        <td style="font-weight:600;">342</td>
                                        <td><span class="status status-active"><span class="status-dot"
                                                    style="background:#34d399;"></span> Active</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditOrgModal('Vanguard Fitness Corp', 'Sarah Jenkins', 's.jenkins@vanguard.com', 'active')"><i
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
                                                <div><strong style="color:white;">Nexus Systems Lab</strong><br><span
                                                        style="font-size:0.7rem; color:#94a3b8;">Added 20 May
                                                        2026</span></div>
                                            </div>
                                        </td>
                                        <td><span style="color:white;">Zayn Malik</span><br><span
                                                style="font-size:0.7rem;">z.malik@nexus-labs.io</span></td>
                                        <td style="font-weight:600;">18</td>
                                        <td><span class="status status-eval"><span class="status-dot"
                                                    style="background:#fbbf24;"></span> Evaluation</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditOrgModal('Nexus Systems Lab', 'Zayn Malik', 'z.malik@nexus-labs.io', 'evaluation')"><i
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
                                                <div><strong style="color:white;">OmniRetail Services</strong><br><span
                                                        style="font-size:0.7rem; color:#94a3b8;">Added 15 Jan
                                                        2026</span></div>
                                            </div>
                                        </td>
                                        <td><span style="color:white;">Robert Chen</span><br><span
                                                style="font-size:0.7rem;">robert@omniretail.com</span></td>
                                        <td style="font-weight:600;">0</td>
                                        <td><span class="status status-revoked"><span class="status-dot"
                                                    style="background:#f87171;"></span> Revoked</span></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="icon-btn" title="Edit Organization"
                                                    onclick="openEditOrgModal('OmniRetail Services', 'Robert Chen', 'robert@omniretail.com', 'revoked')"><i
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
                            <div>Showing <span style="color:white; font-weight:600;">1-4</span> of <span
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

    <!-- Add Organization Modal -->
    <div id="addOrgModal" class="modal-overlay hidden">
        <div class="modal">
            <div class="modal-header">
                <h3><i class="bi bi-plus-lg" style="color:#8b5cf6; margin-right:0.5rem;"></i>Register Organization
                </h3>
                <button class="modal-close" onclick="closeAddOrgModal()"><i class="bi bi-x-lg"></i></button>
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
                <button class="btn-cancel" onclick="closeAddOrgModal()">Cancel</button>
                <button class="btn-submit" onclick="closeAddOrgModal()"><i class="bi bi-check-lg"></i>
                    Register</button>
            </div>
        </div>
    </div>

    <!-- Edit Organization Modal -->
    <div id="editOrgModal" class="modal-overlay hidden">
        <div class="modal">
            <div class="modal-header">
                <h3><i class="bi bi-pencil-square" style="color:#f59e0b; margin-right:0.5rem;"></i>Edit Organization
                </h3>
                <button class="modal-close" onclick="closeEditOrgModal()"><i class="bi bi-x-lg"></i></button>
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
                <button class="btn-cancel" onclick="closeEditOrgModal()">Cancel</button>
                <button class="btn-submit" onclick="closeEditOrgModal()"><i class="bi bi-check-lg"></i> Save
                    Changes</button>
            </div>
        </div>
    </div>

    <!-- Actions Modal -->
    <div id="actionsModal" class="modal-overlay hidden">
        <div class="modal" style="max-width: 450px;">
            <div class="modal-header">
                <h3><i class="bi bi-sliders" style="color:#a78bfa; margin-right:0.5rem;"></i>Actions: <span
                        id="actionOrgName" style="color:#e2e8f0;"></span></h3>
                <button class="modal-close" onclick="closeActionsModal()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body" style="gap: 0.8rem;">
                <button class="btn-submit" style="width:100%; justify-content:center; display:flex;"
                    onclick="closeActionsModal()">
                    <i class="bi bi-arrow-repeat"></i> Renew Subscription
                </button>
                <button class="btn-cancel"
                    style="width:100%; justify-content:center; display:flex; background:rgba(251,191,36,0.1); border-color:rgba(251,191,36,0.3); color:#fbbf24;"
                    onclick="closeActionsModal()">
                    <i class="bi bi-pause-circle"></i> Suspend Organization
                </button>
                <button class="btn-cancel" style="width:100%; justify-content:center; display:flex;"
                    onclick="closeActionsModal()">
                    <i class="bi bi-envelope"></i> Send Notification
                </button>
                <button class="btn-danger" style="width:100%; justify-content:center; display:flex;"
                    onclick="closeActionsModal()">
                    <i class="bi bi-trash"></i> Delete Organization
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeActionsModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            if (sidebar.classList.contains('open')) {
                overlay.classList.remove('hidden');
                overlay.classList.add('show');
            } else {
                overlay.classList.add('hidden');
                overlay.classList.remove('show');
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
            overlay.classList.remove('show');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });

        // Add Organization Modal
        function openAddOrgModal() {
            document.getElementById('addOrgModal').classList.remove('hidden');
        }

        function closeAddOrgModal() {
            document.getElementById('addOrgModal').classList.add('hidden');
        }

        // Edit Organization Modal
        function openEditOrgModal(orgName, adminName, adminEmail, status) {
            document.getElementById('editOrgName').value = orgName;
            document.getElementById('editAdminName').value = adminName;
            document.getElementById('editAdminEmail').value = adminEmail;
            document.getElementById('editOrgStatus').value = status;
            document.getElementById('editOrgModal').classList.remove('hidden');
        }

        function closeEditOrgModal() {
            document.getElementById('editOrgModal').classList.add('hidden');
        }

        // Actions Modal
        function openActionsModal(orgName) {
            document.getElementById('actionOrgName').textContent = orgName;
            document.getElementById('actionsModal').classList.remove('hidden');
        }

        function closeActionsModal() {
            document.getElementById('actionsModal').classList.add('hidden');
        }

        // Close modals on overlay click
        document.getElementById('addOrgModal').addEventListener('click', function(e) {
            if (e.target === this) closeAddOrgModal();
        });
        document.getElementById('editOrgModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditOrgModal();
        });
        document.getElementById('actionsModal').addEventListener('click', function(e) {
            if (e.target === this) closeActionsModal();
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAddOrgModal();
                closeEditOrgModal();
                closeActionsModal();
            }
        });
    </script>
</body>

</html>
