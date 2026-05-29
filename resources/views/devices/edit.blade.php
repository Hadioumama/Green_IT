<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier {{ $device->nom }} — Green IT</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
    :root {
        --green-primary:   #10b981;
        --green-bright:    #34d399;
        --green-dark:      #059669;
        --green-glow:      rgba(16,185,129,0.35);
        --text-1: #f0fdf4;
        --text-2: #a7f3d0;
        --text-3: #8dc9a8;
        --glass-border: rgba(255, 255, 255, 0.08);
        --sidebar-width: 200px;
        --sidebar-collapsed: 48px;
    }

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

    html, body {
        font-family: 'Inter', sans-serif;
        color: var(--text-1);
        min-height: 100vh;
        overflow-x: hidden;
        overflow-y: auto;
        background-image: url('{{ asset("images/img.jfif") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    body::before {
        content: '';
        position: fixed; inset: 0;
        background: linear-gradient(135deg,
            rgba(2,18,12,0.45) 0%,
            rgba(3,24,18,0.35) 50%,
            rgba(2,15,25,0.50) 100%
        );
        z-index: 0;
        pointer-events: none;
    }

    /* ── GRAND CADRE ── */
    .master-frame {
        position: relative;
        z-index: 1;
        max-width: 1180px;
        margin: 10px auto;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(40px) saturate(140%);
        -webkit-backdrop-filter: blur(40px) saturate(140%);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow:
            0 32px 80px rgba(0,0,0,0.40),
            0 0 60px rgba(16,185,129,0.06) inset,
            0 1px 0 rgba(255,255,255,0.08) inset;
        overflow: hidden;
        animation: frameIn 0.9s cubic-bezier(.4,0,.2,1) both;
    }

    @keyframes frameIn {
        from { opacity:0; transform:scale(0.96) translateY(20px); }
        to   { opacity:1; transform:scale(1) translateY(0); }
    }

    /* ── FRAME HEADER ── */
    .frame-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 22px;
        background: rgba(255, 255, 255, 0.04);
        border-bottom: 1px solid var(--glass-border);
        backdrop-filter: blur(20px);
    }

    .frame-brand { display: flex; align-items: center; gap: 10px; }

    .frame-brand-icon {
        width: 32px; height: 32px;
        background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; color: #fff;
        box-shadow: 0 0 14px var(--green-glow);
    }

    .frame-brand-text h1 {
        font-family: 'Rajdhani', sans-serif;
        font-size: 17px; font-weight: 700;
        color: #ffffff;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        text-shadow: 0 0 16px rgba(52,211,153,0.4);
    }

    .frame-brand-text span { font-size: 9px; color: #7ecfaa; letter-spacing: 0.08em; }

    .frame-date {
        display: flex; align-items: center; gap: 6px;
        padding: 5px 12px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(52,211,153,0.10);
        border-radius: 8px;
        font-size: 11px; color: var(--text-2);
    }
    .frame-date i { color: var(--green-bright); }

    /* ── BODY ── */
    .frame-body { display: flex; min-height: calc(100vh - 140px); }

    /* ── SIDEBAR ── */
    .sidebar {
        width: var(--sidebar-width);
        min-width: var(--sidebar-width);
        background: rgba(4, 1, 0, 0.45);
        border-right: 1px solid var(--glass-border);
        display: flex; flex-direction: column;
        padding: 0;
        transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
        overflow: hidden;
    }

    .sidebar.collapsed { width: var(--sidebar-collapsed); min-width: var(--sidebar-collapsed); }

    .sidebar-toggle {
        width: 100%; height: 32px;
        background: rgba(16,185,129,0.08);
        border: none;
        border-bottom: 1px solid rgba(52,211,153,0.12);
        display: flex; align-items: center; justify-content: flex-end;
        padding: 0 10px;
        cursor: pointer; color: var(--green-bright); font-size: 12px;
        transition: all 0.2s; gap: 6px; flex-shrink: 0;
    }
    .sidebar-toggle:hover { background: rgba(16,185,129,0.15); }
    .sidebar-toggle-label { font-size: 9px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.08em; white-space: nowrap; }
    .sidebar.collapsed .sidebar-toggle { justify-content: center; padding: 0; }
    .sidebar.collapsed .sidebar-toggle-label { display: none; }
    .sidebar.collapsed .sidebar-toggle i { transform: rotate(180deg); }
    .sidebar.collapsed .nav-section-title,
    .sidebar.collapsed .nav-item span,
    .sidebar.collapsed .sidebar-footer { opacity:0; pointer-events:none; width:0; overflow:hidden; }
    .sidebar.collapsed .nav-item { justify-content:center; padding:9px 6px; margin:0 3px; }
    .sidebar.collapsed .nav-item i { width:auto; font-size:18px; }
    .sidebar.collapsed .user-chip,
    .sidebar.collapsed .btn-logout span { display:none; }
    .sidebar.collapsed .btn-logout { padding:9px 4px; margin:0 4px; }

    .sidebar-nav { flex:1; padding:10px 0; overflow:hidden; }
    .nav-section { padding:0 10px; margin-bottom:4px; }
    .nav-section-title {
        font-size: 9px; font-weight: 700; color: #6ee7b7;
        text-transform: uppercase; letter-spacing: 0.14em;
        padding: 0 8px; margin-bottom: 5px;
        text-shadow: 0 0 8px rgba(52,211,153,0.4);
    }

    .nav-item {
        display: flex; align-items: center; gap: 8px;
        padding: 7px 10px; border-radius: 8px;
        color: var(--text-2); font-size: 11px; font-weight: 500;
        text-decoration: none; transition: all 0.25s;
        margin-bottom: 2px; white-space: nowrap;
    }
    .nav-item:hover { background: rgba(16,185,129,0.10); color: var(--green-bright); transform: translateX(3px); }
    .nav-item.active { background: rgba(16,185,129,0.15); color: var(--green-bright); border-left: 3px solid var(--green-primary); border-top-left-radius:0; border-bottom-left-radius:0; }
    .nav-item i { font-size:16px; width:20px; text-align:center; flex-shrink:0; }

    .sidebar-footer { padding:10px; border-top:1px solid var(--glass-border); }
    .user-chip { display:flex; align-items:center; gap:7px; margin-bottom:8px; }
    .user-avatar {
        width:28px; height:28px;
        background: linear-gradient(135deg,#3b82f6,#8b5cf6);
        border-radius:7px; display:flex; align-items:center; justify-content:center;
        font-size:11px; font-weight:700; color:#fff; flex-shrink:0;
    }
    .user-info { display:flex; flex-direction:column; }
    .user-name { font-size:10px; font-weight:600; color:var(--text-1); }
    .user-role { font-size:8px; color:var(--green-bright); }
    .btn-logout {
        display:flex; align-items:center; justify-content:center; gap:5px;
        width:100%; padding:7px; border-radius:7px; border:none;
        background: rgba(239,68,68,0.12); color:#f87171;
        font-size:10px; font-weight:600; cursor:pointer; transition:all 0.2s; white-space:nowrap;
    }
    .btn-logout:hover { background:rgba(239,68,68,0.22); transform:translateY(-1px); }

    /* ── CONTENT ZONE ── */
    .content-zone { flex:1; padding:16px 22px; overflow-y:auto; }
    .content-zone::-webkit-scrollbar { width:3px; }
    .content-zone::-webkit-scrollbar-track { background:transparent; }
    .content-zone::-webkit-scrollbar-thumb { background:rgba(16,185,129,0.25); border-radius:2px; }

    /* ── PAGE HEADER ── */
    .page-header {
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 14px; margin-bottom: 14px; padding-bottom: 12px;
        border-bottom: 1px solid rgba(52,211,153,0.10);
    }

    .btn-back {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px; border-radius: 7px;
        background: rgba(16,185,129,0.08); border: 1px solid rgba(52,211,153,0.15);
        color: #34d399; font-size: 10px; font-weight: 600;
        text-decoration: none; transition: all 0.25s; margin-bottom: 6px;
    }
    .btn-back:hover { background:rgba(16,185,129,0.15); transform:translateX(-3px); }

    .header-title h2 {
        font-family: 'Rajdhani', sans-serif;
        font-size: 28px; font-weight: 700; color: #ffffff;
        letter-spacing: -0.01em;
        text-shadow: 0 2px 20px rgba(0,0,0,0.5), 0 0 40px rgba(16,185,129,0.15);
    }

    .header-subtitle { font-size: 12px; color: var(--text-3); margin-top: 4px; }

    /* ── STATS GRID ── */
    .stats-row {
        display: grid; grid-template-columns: repeat(4,1fr);
        gap: 10px; margin-bottom: 14px;
    }

    .stat-card {
        display: flex; align-items: center; gap: 10px; padding: 12px;
        background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px; backdrop-filter: blur(16px); transition: all 0.25s;
    }
    .stat-card:hover { background:rgba(255,255,255,0.06); transform:translateY(-2px); border-color:rgba(52,211,153,0.18); }

    .stat-icon {
        width: 36px; height: 36px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; flex-shrink: 0;
        background: rgba(16,185,129,0.12); color: #6ee7b7;
    }
    .stat-content { display:flex; flex-direction:column; gap:2px; }
    .stat-value { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text-1); line-height:1; }
    .stat-unit { font-size:9px; color:var(--text-3); text-transform:uppercase; letter-spacing:0.08em; font-weight:600; }

    /* ── GLASS CARD ── */
    .glass-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        backdrop-filter: blur(20px) saturate(120%);
        -webkit-backdrop-filter: blur(20px) saturate(120%);
        overflow: hidden;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }
    .glass-card:hover { border-color:rgba(52,211,153,0.18); }

    .card-header {
        display: flex; align-items: center; gap: 7px;
        padding: 9px 14px;
        background: rgba(26, 194, 138, 0.37);
        border-bottom: 1px solid rgba(52,211,153,0.12);
    }
    .card-header i { font-size:16px; color:#6ee7b7; filter:drop-shadow(0 0 4px rgba(52,211,153,0.6)); }
    .card-header h3 {
        font-family: 'Rajdhani', sans-serif;
        font-size: 13px; font-weight: 700; color: #6ee7b7;
        text-transform: uppercase; letter-spacing: 0.10em;
        text-shadow: 0 0 12px rgba(52,211,153,0.5);
    }

    .card-body { padding: 14px; }

    /* ── FORM GRID ── */
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
    .form-group { display:flex; flex-direction:column; gap:5px; margin-bottom:12px; }
    .form-group:last-child { margin-bottom:0; }

    /* ── LABELS ── */
    .form-label {
        display: flex; align-items: center; gap: 6px;
        font-size: 11px; font-weight: 600; color: #69ba8e;
        text-transform: uppercase; letter-spacing: 0.07em;
    }
    .form-label i { font-size: 14px; color: #6ee7b7; }
    .required { color: #f87171; margin-left: 2px; }

    /* ── INPUTS ── */
    .form-control,
    .form-select {
        width: 100%; padding: 9px 13px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.10);
        border-radius: 8px;
        font-size: 12px; font-family:'Inter',sans-serif;
        color: var(--text-1);
        transition: all 0.2s;
        outline: none;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: rgba(52,211,153,0.50);
        background: rgba(16,185,129,0.06);
        box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
    }
    .form-control::placeholder { color: var(--text-3); }
    .form-control:hover:not(:focus),
    .form-select:hover:not(:focus) { border-color: rgba(255,255,255,0.18); }

    .form-select {
        cursor: pointer; appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%238dc9a8' viewBox='0 0 256 256'%3E%3Cpath d='M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 36px;
    }

    /* dark mode option fix */
    .form-select option { background: #0a1a10; color: var(--text-1); }

    .input-group { position:relative; display:flex; }
    .input-suffix {
        position:absolute; right:12px; top:50%; transform:translateY(-50%);
        font-size:11px; font-weight:600; color:var(--green-bright); pointer-events:none;
    }
    .input-group .form-control { padding-right:46px; }

    textarea.form-control { resize:vertical; min-height:80px; }

    .readonly-field {
        background: rgba(255,255,255,0.02) !important;
        color: var(--text-3) !important;
        cursor: not-allowed;
        border-color: rgba(255,255,255,0.06) !important;
    }

    .hint-text { font-size:10px; color:var(--text-3); margin-top:4px; }

    /* ── INFO HINT ── */
    .info-hint {
        display: flex; align-items: flex-start; gap: 7px;
        margin-top: 8px; padding: 9px 12px;
        background: rgba(16,185,129,0.07);
        border: 1px solid rgba(52,211,153,0.15);
        border-radius: 8px; font-size: 11px; color: var(--text-2);
    }
    .info-hint i { font-size:13px; color:var(--green-bright); flex-shrink:0; margin-top:1px; }

    /* ── VALIDATION ── */
    .is-invalid { border-color: rgba(239,68,68,0.5) !important; }
    .error-msg {
        display:flex; align-items:center; gap:5px;
        margin-top:4px; font-size:11px; color:#f87171; font-weight:500;
    }
    .error-msg i { font-size:12px; }

    /* ── ALERT FLASH ── */
    .alert-flash {
        display: flex; align-items: center; gap: 8px;
        padding: 10px 14px; border-radius: 8px;
        font-size: 12px; font-weight: 600; margin-bottom: 12px;
    }
    .alert-flash i { font-size: 16px; }
    .alert-success { background:rgba(16,185,129,0.12); color:#34d399; border:1px solid rgba(16,185,129,0.25); }
    .alert-danger  { background:rgba(239,68,68,0.12); color:#f87171; border:1px solid rgba(239,68,68,0.25); }

    /* ── DELETE SECTION ── */
    .delete-section {
        margin-top: 14px; padding-top: 14px;
        border-top: 1px dashed rgba(255,255,255,0.08);
    }

    .btn-delete-trigger {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 16px; border-radius: 8px;
        background: rgba(8, 1, 1, 0.87);
        border: 1px solid rgba(239,68,68,0.20);
        color: #f87171; font-family:'Inter',sans-serif;
        font-size: 11px; font-weight: 600; cursor: pointer; transition: all 0.2s;
    }
    .btn-delete-trigger:hover { background:rgba(239,68,68,0.16); border-color:rgba(239,68,68,0.40); transform:translateY(-1px); }
    .btn-delete-trigger i { font-size:14px; }

    .delete-confirm {
        display: none; margin-top: 12px; padding: 14px;
        background: rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.20);
        border-radius: 10px; animation: fadeIn 0.2s ease;
    }
    .delete-confirm.show { display:block; }

    @keyframes fadeIn { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }

    .delete-confirm-text {
        display: flex; align-items: flex-start; gap: 10px;
        margin-bottom: 12px; font-size: 12px; color: #fca5a5; line-height: 1.6;
    }
    .delete-confirm-text i { font-size:18px; color:#f87171; flex-shrink:0; margin-top:2px; }
    .delete-confirm-text strong { color:#fecaca; font-weight:700; }

    .delete-actions { display:flex; gap:8px; flex-wrap:wrap; }

    .btn-danger {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 16px; border-radius:8px; border:none;
        background: rgba(239,68,68,0.80); color:#fff;
        font-family:'Inter',sans-serif; font-size:11px; font-weight:600;
        cursor:pointer; transition:all 0.2s;
    }
    .btn-danger:hover { background:rgba(220,38,38,0.90); transform:translateY(-1px); box-shadow:0 4px 14px rgba(239,68,68,0.25); }

    .btn-ghost {
        display:inline-flex; align-items:center; gap:6px;
        padding:8px 16px; border-radius:8px;
        background:rgba(255,255,255,0.05); color:var(--text-2);
        border:1px solid rgba(255,255,255,0.10);
        font-family:'Inter',sans-serif; font-size:11px; font-weight:500;
        cursor:pointer; transition:all 0.2s;
    }
    .btn-ghost:hover { background:rgba(255,255,255,0.09); border-color:rgba(255,255,255,0.18); }

    /* ── FORM ACTIONS ── */
    .form-actions {
        display: flex; align-items: center; gap: 10px;
        margin-top: 16px; padding-top: 14px;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    .btn-primary {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 20px; border-radius: 9px; border: none;
        background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
        color: #fff; font-family:'Inter',sans-serif; font-size: 12px; font-weight: 700;
        cursor: pointer; text-decoration: none; transition: all 0.25s;
        box-shadow: 0 4px 16px rgba(16,185,129,0.30);
    }
    .btn-primary:hover { background:linear-gradient(135deg,var(--green-bright),var(--green-primary)); transform:translateY(-2px); box-shadow:0 6px 20px rgba(16,185,129,0.40); }

    .btn-secondary {
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        padding: 9px 18px; border-radius: 9px;
        background: rgba(255,255,255,0.05); color: var(--text-2);
        border: 1px solid rgba(255,255,255,0.10);
        font-family:'Inter',sans-serif; font-size: 12px; font-weight: 500;
        cursor: pointer; text-decoration: none; transition: all 0.2s;
    }
    .btn-secondary:hover { background:rgba(255,255,255,0.09); border-color:rgba(255,255,255,0.18); transform:translateY(-1px); }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
        .master-frame { margin:0; border-radius:0; }
        .frame-body { flex-direction:column; }
        .sidebar { width:100%; border-right:none; border-bottom:1px solid var(--glass-border); }
        .sidebar.collapsed { width:100%; min-width:100%; }
        .sidebar-toggle { display:none; }
        .content-zone { padding:14px; }
        .form-row { grid-template-columns:1fr; }
        .stats-row { grid-template-columns:repeat(2,1fr); }
        .form-actions { flex-direction:column; }
        .btn-primary, .btn-secondary { width:100%; }
    }

    @media (max-width: 480px) {
        .stats-row { grid-template-columns:1fr; }
    }
    </style>
</head>
<body>

<div class="master-frame">

    <!-- HEADER -->
    <div class="frame-header">
        <div class="frame-brand">
            <div class="frame-brand-icon"><i class="ph ph-leaf"></i></div>
            <div class="frame-brand-text">
                <h1>Green IT</h1>
               
            </div>
        </div>
        <div class="frame-date">
            <i class="ph ph-calendar-blank"></i>
            <span>{{ now()->format('d M Y') }}</span>
        </div>
    </div>

    <!-- BODY -->
    <div class="frame-body">

        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <button class="sidebar-toggle" id="sidebarToggle" title="Réduire/Développer">
                <span class="sidebar-toggle-label">Réduire</span>
                <i class="ph ph-caret-left"></i>
            </button>
            <div class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Navigation</div>
                    <nav>
                        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="ph ph-squares-four"></i><span>Dashboard</span>
                        </a>
                        <a href="{{ route('devices.index') }}" class="nav-item active">
                            <i class="ph ph-desktop"></i><span>Parc informatique</span>
                        </a>
                        <a href="{{ route('energy.index') }}" class="nav-item {{ request()->routeIs('energy.*') ? 'active' : '' }}">
                            <i class="ph ph-lightning"></i><span>Consommation</span>
                        </a>
                        <a href="{{ route('devices.remplacer') }}" class="nav-item {{ request()->routeIs('devices.remplacer') ? 'active' : '' }}">
                            <i class="ph ph-warning"></i><span>Alertes</span>
                        </a>
                    </nav>
                </div>
            </div>
            <div class="sidebar-footer">
                <div class="user-chip">
                    <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="user-role">Administrateur</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="ph ph-sign-out"></i><span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTENT -->
        <main class="content-zone">

            <!-- Page header -->
            <div class="page-header">
                <div>
                    <a href="{{ route('devices.show', $device) }}" class="btn-back">
                        <i class="ph ph-arrow-left"></i> Retour aux détails
                    </a>
                    <div class="header-title">
                        <h2>Modifier l'équipement</h2>
                        <div class="header-subtitle">{{ $device->nom }} — {{ $device->type }}</div>
                    </div>
                </div>
            </div>

            <!-- Alertes flash -->
            @if(session('success'))
                <div class="alert-flash alert-success">
                    <i class="ph ph-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert-flash alert-danger">
                    <i class="ph ph-warning-circle"></i> Veuillez corriger les erreurs ci-dessous.
                </div>
            @endif

            <!-- Stats -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon"><i class="ph ph-lightning"></i></div>
                    <div class="stat-content">
                        <div class="stat-value">{{ number_format($device->conso_annuelle_kwh, 2) }}</div>
                        <div class="stat-unit">kWh/an</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ph ph-cloud-arrow-up"></i></div>
                    <div class="stat-content">
                        <div class="stat-value">{{ number_format($device->emission_co2_kg, 2) }}</div>
                        <div class="stat-unit">kg CO₂/an</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ph ph-factory"></i></div>
                    <div class="stat-content">
                        <div class="stat-value">{{ number_format($device->empreinte_carbone_fab, 2) }}</div>
                        <div class="stat-unit">kg CO₂ fab.</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ph ph-coin"></i></div>
                    <div class="stat-content">
                        <div class="stat-value">{{ number_format($device->cout_energie_annuel, 2) }}</div>
                        <div class="stat-unit">MAD/an</div>
                    </div>
                </div>
            </div>

            <!-- FORMULAIRE -->
            <form action="{{ route('devices.update', $device) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Identification -->
                <div class="glass-card">
                    <div class="card-header">
                        <i class="ph ph-cpu"></i>
                        <h3>Identification</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="nom">
                                 <i class="ph ph-pencil-simple"></i>Nom <span class="required">*</span>
                                </label>
                                <input type="text" name="nom" id="nom"
                                       class="form-control @error('nom') is-invalid @enderror"
                                       value="{{ old('nom', $device->nom) }}" required>
                                @error('nom')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="type">
                                    <i class="ph ph-tag"></i> Type <span class="required">*</span>
                                </label>
                                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                    @foreach(['PC','Serveur','Switch','Routeur','Imprimante','Écran','Onduleur','Autre'] as $type)
                                        <option value="{{ $type }}" {{ old('type',$device->type)==$type?'selected':'' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="marque"><i class="ph ph-trademark"></i> Marque</label>
                                <input type="text" name="marque" id="marque"
                                       class="form-control @error('marque') is-invalid @enderror"
                                       value="{{ old('marque',$device->marque) }}">
                                @error('marque')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="modele"><i class="ph ph-cube"></i> Modèle</label>
                                <input type="text" name="modele" id="modele"
                                       class="form-control @error('modele') is-invalid @enderror"
                                       value="{{ old('modele',$device->modele) }}">
                                @error('modele')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="numero_serie"><i class="ph ph-hash"></i> Numéro de série</label>
                            <input type="text" id="numero_serie" class="form-control readonly-field"
                                   value="{{ $device->numero_serie }}" readonly>
                            <span class="hint-text">Le numéro de série ne peut pas être modifié.</span>
                        </div>
                    </div>
                </div>

                <!-- Acquisition -->
                <div class="glass-card">
                    <div class="card-header">
                        <i class="ph ph-calendar"></i>
                        <h3>Acquisition & Prix</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="date_achat"><i class="ph ph-calendar"></i> Date d'achat</label>
                                <input type="date" name="date_achat" id="date_achat"
                                       class="form-control @error('date_achat') is-invalid @enderror"
                                       value="{{ old('date_achat',$device->date_achat?->format('Y-m-d')) }}"
                                       style="color-scheme: dark;">
                                @error('date_achat')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="prix"><i class="ph ph-currency-dollar"></i> Prix</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="prix" id="prix"
                                           class="form-control @error('prix') is-invalid @enderror"
                                           value="{{ old('prix',$device->prix) }}">
                                    <span class="input-suffix">MAD</span>
                                </div>
                                @error('prix')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technique -->
                <div class="glass-card">
                    <div class="card-header">
                        <i class="ph ph-lightning"></i>
                        <h3>Technique & Énergie</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="puissance_watt">
                                <i class="ph ph-lightning"></i> Puissance <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="puissance_watt" id="puissance_watt"
                                       class="form-control @error('puissance_watt') is-invalid @enderror"
                                       value="{{ old('puissance_watt',$device->puissance_watt) }}" required>
                                <span class="input-suffix">W</span>
                            </div>
                            @error('puissance_watt')
                                <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="info-hint">
                                <i class="ph ph-info"></i>
                                <span>Si vous modifiez la puissance, la consommation et les émissions CO₂ seront recalculées automatiquement.</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="efficacite_energetique"><i class="ph ph-leaf"></i> Efficacité énergétique</label>
                                <select name="efficacite_energetique" id="efficacite_energetique"
                                        class="form-select @error('efficacite_energetique') is-invalid @enderror">
                                    @foreach(['A+++','A++','A+','A','B','C','D','Non classé'] as $classe)
                                        <option value="{{ $classe }}" {{ old('efficacite_energetique',$device->efficacite_energetique)==$classe?'selected':'' }}>{{ $classe }}</option>
                                    @endforeach
                                </select>
                                @error('efficacite_energetique')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="duree_vie_annees"><i class="ph ph-hourglass"></i> Durée de vie</label>
                                <div class="input-group">
                                    <input type="number" name="duree_vie_annees" id="duree_vie_annees"
                                           class="form-control @error('duree_vie_annees') is-invalid @enderror"
                                           value="{{ old('duree_vie_annees',$device->duree_vie_annees) }}">
                                    <span class="input-suffix">ans</span>
                                </div>
                                @error('duree_vie_annees')
                                    <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statut & Localisation -->
                <div class="glass-card">
                    <div class="card-header">
                        <i class="ph ph-map-pin"></i>
                        <h3>Statut & Localisation</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="statut">
                                <i class="ph ph-activity"></i> Statut <span class="required">*</span>
                            </label>
                            <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror" required>
                                @foreach(['actif'=>'Actif','en_reparation'=>'En réparation','hors_service'=>'Hors service','stock'=>'En stock','recycle'=>'À recycler'] as $value=>$label)
                                    <option value="{{ $value }}" {{ old('statut',$device->statut)==$value?'selected':'' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('statut')
                                <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="localisation"><i class="ph ph-map-pin"></i> Localisation</label>
                            <input type="text" name="localisation" id="localisation"
                                   class="form-control @error('localisation') is-invalid @enderror"
                                   value="{{ old('localisation',$device->localisation) }}"
                                   placeholder="Ex: Bureau 301, Datacenter A...">
                            @error('localisation')
                                <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="user_id"><i class="ph ph-user"></i> Utilisateur assigné</label>
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">Aucun utilisateur</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id',$device->user_id)==$user->id?'selected':'' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description"><i class="ph ph-text-align-left"></i> Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3"
                                      placeholder="Informations complémentaires...">{{ old('description',$device->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Suppression -->
                <div class="delete-section">
                    <button type="button" class="btn-delete-trigger" onclick="toggleDeleteConfirm()">
                        <i class="ph ph-trash"></i> Supprimer cet équipement
                    </button>
                    <div id="deleteConfirm" class="delete-confirm">
                        <div class="delete-confirm-text">
                            <i class="ph ph-warning"></i>
                            <div>
                                <strong>Attention !</strong> Vous êtes sur le point de supprimer définitivement
                                <strong>"{{ $device->nom }}"</strong>. Cette action est irréversible et supprimera également
                                tout l'historique de consommation associé.
                            </div>
                        </div>
                        <div class="delete-actions">
                            <form action="{{ route('devices.destroy', $device) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger">
                                    <i class="ph ph-trash"></i> Oui, supprimer définitivement
                                </button>
                            </form>
                            <button type="button" class="btn-ghost" onclick="toggleDeleteConfirm()">
                                <i class="ph ph-x"></i> Annuler
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="ph ph-check"></i> Mettre à jour
                    </button>
                    <a href="{{ route('devices.index') }}" class="btn-secondary">
                        <i class="ph ph-x"></i> Annuler
                    </a>
                    <a href="{{ route('devices.show', $device) }}" class="btn-secondary" style="margin-left:auto;">
                        <i class="ph ph-eye"></i> Voir détails
                    </a>
                </div>

            </form>
        </main>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggle  = document.getElementById('sidebarToggle');
    const label   = toggle.querySelector('.sidebar-toggle-label');

    if (localStorage.getItem('sidebarCollapsed') === 'true') sidebar.classList.add('collapsed');

    toggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        const collapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', collapsed);
        if (label) label.textContent = collapsed ? '' : 'Réduire';
    });
});

function toggleDeleteConfirm() {
    document.getElementById('deleteConfirm').classList.toggle('show');
}
</script>

</body>
</html>