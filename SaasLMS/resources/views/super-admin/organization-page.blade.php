<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>NEXUS • organization matrix</title>
    <!-- Bootstrap Icons -->
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
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 1.5rem;
        }

        /* main container — exactly as provided but completely restyled */
        .nexus-dashboard {
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
            background: transparent;
        }

        /* header mobile style */
        .mobile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(10, 15, 28, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 1rem 1.5rem;
            border-radius: 2.5rem;
            position: sticky;
            top: 1rem;
            z-index: 40;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.5);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .brand-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, #7c3aed, #4f46e5, #c026d3);
            border-radius: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 0 25px rgba(139, 92, 246, 0.6);
        }

        .brand-name {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            color: white;
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        .menu-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0.7rem 1rem;
            border-radius: 2rem;
            color: #cbd5e1;
            font-size: 1.6rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .menu-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* main content area */
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        /* hero title block */
        .title-section {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 2rem;
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
            gap: 0.5rem;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #a78bfa;
            margin-bottom: 0.5rem;
        }

        .badge-dot {
            width: 0.5rem;
            height: 0.5rem;
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
            font-size: 2.8rem;
            font-weight: 700;
            color: white;
            letter-spacing: -1px;
            line-height: 1.1;
            background: linear-gradient(to right, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @media (min-width: 768px) {
            .title-group h1 {
                font-size: 3.8rem;
            }
        }

        .subtitle {
            color: #94a3b8;
            max-width: 500px;
            margin-top: 0.3rem;
            font-size: 0.95rem;
        }

        .register-btn {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            border: none;
            padding: 0.9rem 2.2rem;
            border-radius: 3rem;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.4);
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            width: fit-content;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            box-shadow: 0 15px 30px rgba(139, 92, 246, 0.6);
            transform: translateY(-2px);
        }

        /* stat cards redesigned */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background: rgba(15, 20, 35, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2.5rem;
            padding: 1.8rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -30%;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            transition: 0.4s;
        }

        .stat-card:hover::before {
            transform: scale(1.3);
            opacity: 0.8;
        }

        .stat-info h4 {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 2px;
            color: #94a3b8;
            margin-bottom: 0.4rem;
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 700;
            color: white;
            line-height: 1;
        }

        .stat-icon {
            width: 3.5rem;
            height: 3.5rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 2;
        }

        /* filters bar */
        .filters-bar {
            background: rgba(15, 22, 37, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2.5rem;
            padding: 1.2rem 1.8rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1.2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .search-box {
            flex: 2;
            min-width: 220px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 1.3rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
        }

        .search-box input {
            width: 100%;
            background: #0f1625;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 2.5rem;
            padding: 0.9rem 1.2rem 0.9rem 2.8rem;
            color: white;
            font-size: 0.9rem;
            outline: none;
            transition: 0.2s;
        }

        .search-box input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.3);
        }

        .select-group {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .custom-select {
            background: #0f1625;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
            padding: 0.9rem 2rem 0.9rem 1.5rem;
            border-radius: 2.5rem;
            font-size: 0.85rem;
            font-weight: 500;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            cursor: pointer;
            outline: none;
        }

        /* table card */
        .table-wrapper {
            background: rgba(15, 22, 37, 0.65);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 2.8rem;
            overflow: hidden;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.6);
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        thead tr {
            background: rgba(20, 27, 45, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        th {
            padding: 1.4rem 1.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1.8px;
            color: #94a3b8;
            text-align: left;
        }

        td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            color: #e2e8f0;
            font-size: 0.9rem;
        }

        .org-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .org-avatar {
            width: 2.8rem;
            height: 2.8rem;
            border-radius: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
        }

        .domain-badge {
            background: rgba(26, 35, 50, 0.8);
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-family: monospace;
            font-size: 0.8rem;
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #cbd5e1;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 1rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
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

        .action-btns {
            display: flex;
            gap: 0.3rem;
            justify-content: flex-end;
        }

        .icon-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #94a3b8;
            padding: 0.5rem 0.7rem;
            border-radius: 1.2rem;
            font-size: 1.1rem;
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
            padding: 1.2rem 1.8rem;
            background: rgba(20, 27, 45, 0.7);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .page-btns {
            display: flex;
            gap: 0.4rem;
        }

        .page-btn {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #cbd5e1;
            padding: 0.5rem 1.1rem;
            border-radius: 2rem;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
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
    </style>
</head>

<body style="background:#0a0f1c; display: block; padding:0; margin:0;">
    <div class="nexus-dashboard" style="padding:1.5rem;">
        <!-- Mobile Header (lg hidden as original but restyled) -->
        <header class="mobile-header">
            <div class="brand">
                <div class="brand-icon"><i class="bi bi-shield-lock-fill"></i></div>
                <span class="brand-name">NEXUS</span>
            </div>
            <button class="menu-btn"><i class="bi bi-list"></i></button>
        </header>

        <main class="main-content">
            <!-- Title & Register -->
            <div class="title-section">
                <div class="title-group">
                    <div class="badge"><span class="badge-dot"></span> CORE REALM v2.4</div>
                    <h1>Organizations</h1>
                    <p class="subtitle">Multi-tenant orchestration • Global policy control • Enterprise infrastructure
                        matrix</p>
                </div>
                <button class="register-btn"><i class="bi bi-plus-lg"></i> REGISTER ORGANIZATION</button>
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
                    <input type="text" placeholder="Search tenants, domains, or admins...">
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
                                <th>Organization Hierarchy</th>
                                <th>Network Domain</th>
                                <th>Administrative Node</th>
                                <th>Registered Users</th>
                                <th>Deployment State</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="org-cell">
                                        <div class="org-avatar"
                                            style="background:linear-gradient(135deg,#3b82f6,#6366f1);">A</div>
                                        <div><strong style="color:white;">Apex Global Institute</strong><br><span
                                                style="font-size:0.7rem; color:#94a3b8;">Added 12 May 2026</span></div>
                                    </div>
                                </td>
                                <td><span class="domain-badge">apex-edu.platform.com</span></td>
                                <td><span style="color:white;">Alex Mercer</span><br><span
                                        style="font-size:0.7rem;">alex@apex-edu.com</span></td>
                                <td style="font-weight:600;">1,240</td>
                                <td><span class="status status-active"><span
                                            style="display:inline-block; width:6px; height:6px; background:#34d399; border-radius:50%;"></span>
                                        Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="icon-btn"><i class="bi bi-sliders"></i></button>
                                        <button class="icon-btn"><i class="bi bi-pencil-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="org-cell">
                                        <div class="org-avatar"
                                            style="background:linear-gradient(135deg,#a855f7,#ec4899);">V</div>
                                        <div><strong style="color:white;">Vanguard Fitness Corp</strong><br><span
                                                style="font-size:0.7rem; color:#94a3b8;">Added 28 Apr 2026</span></div>
                                    </div>
                                </td>
                                <td><span class="domain-badge">vanguard.fit-portal.net</span></td>
                                <td><span style="color:white;">Sarah Jenkins</span><br><span
                                        style="font-size:0.7rem;">s.jenkins@vanguard.com</span></td>
                                <td style="font-weight:600;">342</td>
                                <td><span class="status status-active"><span
                                            style="display:inline-block; width:6px; height:6px; background:#34d399; border-radius:50%;"></span>
                                        Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="icon-btn"><i class="bi bi-sliders"></i></button>
                                        <button class="icon-btn"><i class="bi bi-pencil-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="org-cell">
                                        <div class="org-avatar"
                                            style="background:linear-gradient(135deg,#f59e0b,#f97316);">N</div>
                                        <div><strong style="color:white;">Nexus Systems Lab</strong><br><span
                                                style="font-size:0.7rem; color:#94a3b8;">Added 20 May 2026</span></div>
                                    </div>
                                </td>
                                <td><span class="domain-badge">nexus-lab.internal.io</span></td>
                                <td><span style="color:white;">Zayn Malik</span><br><span
                                        style="font-size:0.7rem;">z.malik@nexus-labs.io</span></td>
                                <td style="font-weight:600;">18</td>
                                <td><span class="status status-eval"><span
                                            style="display:inline-block; width:6px; height:6px; background:#fbbf24; border-radius:50%;"></span>
                                        Evaluation</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="icon-btn"><i class="bi bi-sliders"></i></button>
                                        <button class="icon-btn"><i class="bi bi-pencil-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="org-cell">
                                        <div class="org-avatar"
                                            style="background:linear-gradient(135deg,#ef4444,#f43f5e);">O</div>
                                        <div><strong style="color:white;">OmniRetail Services</strong><br><span
                                                style="font-size:0.7rem; color:#94a3b8;">Added 15 Jan 2026</span></div>
                                    </div>
                                </td>
                                <td><span class="domain-badge">omni-retail.main-app.com</span></td>
                                <td><span style="color:white;">Robert Chen</span><br><span
                                        style="font-size:0.7rem;">robert@omniretail.com</span></td>
                                <td style="font-weight:600;">0</td>
                                <td><span class="status status-revoked"><span
                                            style="display:inline-block; width:6px; height:6px; background:#f87171; border-radius:50%;"></span>
                                        Revoked</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="icon-btn"><i class="bi bi-sliders"></i></button>
                                        <button class="icon-btn"><i class="bi bi-pencil-square"></i></button>
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
        </main>
    </div>
</body>

</html>
