<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
<style>
/* ═══════════════════════════════════════════════════════════════════════════ */
/*  GREEN IT DASHBOARD — Ultra Compact Sans Scroll                          */
/*  Tout visible sur un écran, pas de défilement nécessaire                 */
/* ═══════════════════════════════════════════════════════════════════════════ */

:root {
    --bg-primary: #0b0f19;
    --bg-secondary: #111827;
    --bg-card: #151b2b;
    --bg-sidebar: #0f141f;
    --bg-sidebar-active: rgba(16, 185, 129, 0.08);

    --text-primary: #f1f5f9;
    --text-secondary: #94a3b8;
    --text-muted: #64748b;

    --accent-green: #10b981;
    --accent-green-glow: rgba(16, 185, 129, 0.25);
    --accent-green-soft: rgba(16, 185, 129, 0.12);

    --accent-blue: #3b82f6;
    --accent-blue-glow: rgba(59, 130, 246, 0.25);
    --accent-blue-soft: rgba(59, 130, 246, 0.12);

    --accent-orange: #f59e0b;
    --accent-orange-glow: rgba(245, 158, 11, 0.25);
    --accent-orange-soft: rgba(245, 158, 11, 0.12);

    --accent-red: #ef4444;
    --accent-red-glow: rgba(239, 68, 68, 0.25);
    --accent-red-soft: rgba(239, 68, 68, 0.12);

    --accent-purple: #8b5cf6;
    --accent-purple-glow: rgba(139, 92, 246, 0.25);
    --accent-purple-soft: rgba(139, 92, 246, 0.12);

    --accent-cyan: #06b6d4;
    --accent-cyan-glow: rgba(6, 182, 212, 0.25);
    --accent-cyan-soft: rgba(6, 182, 212, 0.12);

    --border: rgba(148, 163, 184, 0.08);
    --border-hover: rgba(148, 163, 184, 0.15);
    --border-active: rgba(16, 185, 129, 0.2);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

html, body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    line-height: 1.4;
    height: 100vh;
    font-size: 13px;
    -webkit-font-smoothing: antialiased;
    overflow: hidden;
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  APP LAYOUT — Full height sans scroll                                      */
/* ═══════════════════════════════════════════════════════════════════════════ */

.app {
    display: flex;
    height: 100vh;
    overflow: hidden;
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  SIDEBAR — Compact fixe                                                    */
/* ═══════════════════════════════════════════════════════════════════════════ */

.sidebar {
    width: 70px;
    min-width: 70px;
    background: var(--bg-sidebar);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px 0;
    z-index: 100;
}

.sidebar-brand {
    margin-bottom: 30px;
}

.brand-logo {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--accent-green), #059669);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    box-shadow: 0 0 15px var(--accent-green-glow);
}

.sidebar-nav {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
    align-items: center;
}

.nav-item {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    font-size: 20px;
    text-decoration: none;
    transition: all 0.25s ease;
    position: relative;
}

.nav-item:hover {
    background: rgba(255, 255, 255, 0.03);
    color: var(--text-primary);
}

.nav-item.active {
    background: var(--accent-green-soft);
    color: var(--accent-green);
    box-shadow: 0 0 12px var(--accent-green-glow);
}

.nav-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 18px;
    height: 18px;
    background: var(--accent-red);
    color: white;
    border-radius: 50%;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 8px var(--accent-red-glow);
}

.sidebar-footer {
    margin-top: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border);
    width: 100%;
}

.user-avatar {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: white;
}

.btn-logout-sidebar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    border: none;
    background: rgba(255, 255, 255, 0.03);
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 18px;
}

.btn-logout-sidebar:hover {
    background: var(--accent-red-soft);
    color: var(--accent-red);
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  CONTENT — Scroll interne si nécessaire mais compact                       */
/* ═══════════════════════════════════════════════════════════════════════════ */

.content {
    flex: 1;
    padding: 20px 28px;
    overflow-y: auto;
    overflow-x: hidden;
}

/* Header ultra compact */
.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    flex-shrink: 0;
}

.header-title-group h1 {
    font-size: 24px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 2px;
    letter-spacing: -0.02em;
}

.header-title-group p {
    font-size: 12px;
    color: var(--text-muted);
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    border-radius: 10px;
    width: 220px;
    transition: all 0.3s;
}

.search-box:focus-within {
    border-color: var(--accent-green);
    box-shadow: 0 0 15px var(--accent-green-glow);
}

.search-box i {
    color: var(--text-muted);
    font-size: 16px;
}

.search-box input {
    background: none;
    border: none;
    color: var(--text-primary);
    font-size: 13px;
    outline: none;
    width: 100%;
}

.search-box input::placeholder {
    color: var(--text-dim);
}

.header-date {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 12px;
    color: var(--text-secondary);
}

.header-date i {
    color: var(--accent-cyan);
    font-size: 16px;
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  KPI ROW — Ultra compact, 6 sur une ligne ou 2×3 très serré                */
/* ═══════════════════════════════════════════════════════════════════════════ */

.kpi-row {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
    margin-bottom: 16px;
    flex-shrink: 0;
}

.kpi-box {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    min-height: 0;
}

.kpi-box:hover {
    transform: translateY(-2px);
    border-color: var(--border-hover);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

.kpi-glow {
    position: absolute;
    top: -40%;
    right: -30%;
    width: 80%;
    height: 80%;
    border-radius: 50%;
    opacity: 0.06;
    filter: blur(30px);
    transition: all 0.3s;
}

.kpi-box:hover .kpi-glow {
    opacity: 0.12;
}

.kpi-total .kpi-glow { background: var(--accent-blue); }
.kpi-energy .kpi-glow { background: var(--accent-green); }
.kpi-co2 .kpi-glow { background: var(--accent-orange); }
.kpi-fab .kpi-glow { background: var(--accent-purple); }
.kpi-score .kpi-glow { background: var(--accent-cyan); }
.kpi-alert .kpi-glow { background: var(--accent-red); }

.kpi-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.kpi-title {
    font-size: 10px;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.kpi-icon-box {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.kpi-total .kpi-icon-box { background: var(--accent-blue-soft); color: var(--accent-blue); }
.kpi-energy .kpi-icon-box { background: var(--accent-green-soft); color: var(--accent-green); }
.kpi-co2 .kpi-icon-box { background: var(--accent-orange-soft); color: var(--accent-orange); }
.kpi-fab .kpi-icon-box { background: var(--accent-purple-soft); color: var(--accent-purple); }
.kpi-score .kpi-icon-box { background: var(--accent-cyan-soft); color: var(--accent-cyan); }
.kpi-alert .kpi-icon-box { background: var(--accent-red-soft); color: var(--accent-red); }

.kpi-number {
    font-size: 22px;
    font-weight: 800;
    color: var(--text-primary);
    position: relative;
    z-index: 1;
    letter-spacing: -0.02em;
    line-height: 1;
}

.kpi-number small {
    font-size: 12px;
    font-weight: 500;
    color: var(--text-muted);
    margin-left: 2px;
}

.kpi-trend {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    font-size: 11px;
    color: var(--text-muted);
    position: relative;
    z-index: 1;
}

.kpi-trend i {
    font-size: 12px;
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  MAIN GRID — Donut + 2 bar charts côte à côte                              */
/* ═══════════════════════════════════════════════════════════════════════════ */

.main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
    flex-shrink: 0;
}

.chart-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
}

.chart-card:hover {
    border-color: var(--border-hover);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
}

.chart-header h3 {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
}

.chart-header h3 i {
    color: var(--accent-green);
    font-size: 16px;
}

.chart-menu {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    border: none;
    background: rgba(255, 255, 255, 0.03);
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 16px;
}

.chart-menu:hover {
    background: rgba(255, 255, 255, 0.06);
    color: var(--text-primary);
}

.chart-body {
    padding: 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 0;
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  DONUT CHART — Compact                                                     */
/* ═══════════════════════════════════════════════════════════════════════════ */

.donut-container {
    display: flex;
    align-items: center;
    gap: 20px;
}

.donut-chart {
    position: relative;
    width: 140px;
    height: 140px;
    flex-shrink: 0;
}

.donut {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

.donut-segment {
    transition: all 0.3s;
    cursor: pointer;
}

.donut-segment:hover {
    stroke-width: 4;
    filter: drop-shadow(0 0 6px currentColor);
}

.donut-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.donut-value {
    display: block;
    font-size: 28px;
    font-weight: 800;
    color: var(--text-primary);
    letter-spacing: -0.02em;
}

.donut-label {
    font-size: 10px;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.donut-legend {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 8px;
    border-radius: 6px;
    transition: all 0.2s;
    cursor: pointer;
}

.legend-item:hover {
    background: rgba(255, 255, 255, 0.03);
}

.legend-dot {
    width: 10px;
    height: 10px;
    border-radius: 3px;
    flex-shrink: 0;
    box-shadow: 0 0 6px currentColor;
}

.legend-name {
    font-size: 12px;
    color: var(--text-secondary);
    flex: 1;
}

.legend-value {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-primary);
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  DIAGRAMME EN BÂTON (Bar Chart Vertical) — Consommation & Scores          */
/* ═══════════════════════════════════════════════════════════════════════════ */

.baton-chart {
    display: flex;
    align-items: flex-end;
    justify-content: center;
    gap: 16px;
    height: 160px;
    padding: 0 8px;
    position: relative;
}

.baton-chart::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 8px;
    right: 8px;
    height: 1px;
    background: var(--border);
}

.baton-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    flex: 1;
    max-width: 60px;
}

.baton-bar-container {
    width: 100%;
    height: 120px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    position: relative;
}

.baton-bar {
    width: 100%;
    max-width: 36px;
    border-radius: 6px 6px 0 0;
    transition: height 1.2s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    min-height: 4px;
}

.baton-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 20px;
    background: linear-gradient(180deg, rgba(255,255,255,0.15), transparent);
    border-radius: 6px 6px 0 0;
}

.baton-value {
    font-size: 11px;
    font-weight: 700;
    color: var(--text-primary);
    white-space: nowrap;
}

.baton-label {
    font-size: 10px;
    color: var(--text-muted);
    text-align: center;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  BOTTOM ROW — Alertes + Actions                                            */
/* ═══════════════════════════════════════════════════════════════════════════ */

.bottom-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    flex-shrink: 0;
}

/* Alert Cards */
.alert-cards {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.alert-card-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid var(--border);
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.25s;
}

.alert-card-item:hover {
    background: rgba(255, 255, 255, 0.04);
    border-color: var(--accent-orange);
    transform: translateX(4px);
}

.alert-card-icon {
    width: 32px;
    height: 32px;
    background: var(--accent-red-soft);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.alert-card-icon i {
    font-size: 16px;
    color: var(--accent-red);
}

.alert-card-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
    flex: 1;
    overflow: hidden;
}

.alert-card-name {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-primary);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.alert-card-reason {
    font-size: 10px;
    color: var(--accent-orange);
}

.alert-card-item > i {
    color: var(--text-muted);
    font-size: 14px;
    transition: all 0.2s;
    flex-shrink: 0;
}

.alert-card-item:hover > i {
    color: var(--accent-orange);
    transform: translateX(3px);
}

/* Empty State */
.empty-state-dark {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 30px 16px;
    color: var(--accent-green);
    font-size: 12px;
    font-weight: 500;
}

.empty-state-dark i {
    font-size: 32px;
    opacity: 0.8;
}

/* Action Grid */
.action-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 16px 12px;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid var(--border);
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s;
    text-align: center;
}

.action-btn:hover {
    transform: translateY(-3px);
    border-color: transparent;
}

.action-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    transition: all 0.3s;
}

.action-btn span {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-secondary);
    transition: all 0.3s;
}

.action-btn:hover span {
    color: var(--text-primary);
}

.action-add:hover { background: var(--accent-green-soft); }
.action-add .action-icon { background: var(--accent-green-soft); color: var(--accent-green); }
.action-add:hover .action-icon { box-shadow: 0 0 15px var(--accent-green-glow); transform: scale(1.08); }

.action-energy:hover { background: var(--accent-blue-soft); }
.action-energy .action-icon { background: var(--accent-blue-soft); color: var(--accent-blue); }
.action-energy:hover .action-icon { box-shadow: 0 0 15px var(--accent-blue-glow); transform: scale(1.08); }

.action-view:hover { background: var(--accent-cyan-soft); }
.action-view .action-icon { background: var(--accent-cyan-soft); color: var(--accent-cyan); }
.action-view:hover .action-icon { box-shadow: 0 0 15px var(--accent-cyan-glow); transform: scale(1.08); }

.action-alert:hover { background: var(--accent-red-soft); }
.action-alert .action-icon { background: var(--accent-red-soft); color: var(--accent-red); }
.action-alert:hover .action-icon { box-shadow: 0 0 15px var(--accent-red-glow); transform: scale(1.08); }

/* Chart Link */
.chart-link {
    font-size: 11px;
    font-weight: 600;
    color: var(--accent-orange);
    text-decoration: none;
    transition: all 0.2s;
}

.chart-link:hover {
    color: #fbbf24;
}

/* ═══════════════════════════════════════════════════════════════════════════ */
/*  RESPONSIVE                                                                */
/* ═══════════════════════════════════════════════════════════════════════════ */

@media (max-width: 1200px) {
    .kpi-row {
        grid-template-columns: repeat(3, 1fr);
    }
    .main-grid {
        grid-template-columns: 1fr;
    }
    .bottom-row {
        grid-template-columns: 1fr;
    }
    body {
        overflow-y: auto;
    }
    .content {
        overflow-y: visible;
    }
}

@media (max-width: 768px) {
    .kpi-row {
        grid-template-columns: repeat(2, 1fr);
    }
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        transform: translateX(-100%);
        transition: transform 0.3s;
    }
    .sidebar.active {
        transform: translateX(0);
    }
    .content {
        margin-left: 0;
        padding: 70px 16px 16px;
    }
}
</style>
<base target="_blank">
</head>
<body>

<div class="app">

    <!-- ═══════════════════════════════════════════════ -->
    <!-- SIDEBAR — Fixe compact 70px                     -->
    <!-- ═══════════════════════════════════════════════ -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="ph ph-leaf"></i>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item active" title="Dashboard">
                <i class="ph ph-squares-four"></i>
            </a>
            <a href="{{ route('devices.index') }}" class="nav-item" title="Parc informatique">
                <i class="ph ph-desktop"></i>
            </a>
            <a href="{{ route('energy.index') }}" class="nav-item" title="Consommation">
                <i class="ph ph-lightning"></i>
            </a>
            <a href="{{ route('devices.remplacer') }}" class="nav-item" title="Alertes">
                <i class="ph ph-warning"></i>
                @if($kpis['a_remplacer'] > 0)
                    <span class="nav-badge">{{ $kpis['a_remplacer'] }}</span>
                @endif
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-avatar" title="{{ Auth::user()->name }}">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout-sidebar" title="Déconnexion">
                    <i class="ph ph-sign-out"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- CONTENU DROIT                                -->
    <!-- ═══════════════════════════════════════════════ -->
    <main class="content">

        <!-- Header -->
        <header class="content-header">
            <div class="header-title-group">
                <h1>Tableau de bord</h1>
                <p>Bienvenue, voici l'état de votre parc informatique</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="header-date">
                    <i class="ph ph-calendar-blank"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </header>

        <!-- KPI Cards — 6 sur une ligne, ultra compact -->
        <div class="kpi-row">
            <div class="kpi-box kpi-total">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Équipements</span>
                    <div class="kpi-icon-box"><i class="ph ph-desktop"></i></div>
                </div>
                <div class="kpi-number">{{ $kpis['total_devices'] }}</div>
                <div class="kpi-trend"><i class="ph ph-trend-up"></i><span>Total actif</span></div>
            </div>

            <div class="kpi-box kpi-energy">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Consommation</span>
                    <div class="kpi-icon-box"><i class="ph ph-lightning"></i></div>
                </div>
                <div class="kpi-number">{{ number_format($kpis['total_conso'], 0, ',', ' ') }} <small>kWh</small></div>
                <div class="kpi-trend"><i class="ph ph-trend-up"></i><span>Annuel</span></div>
            </div>

            <div class="kpi-box kpi-co2">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Émissions CO₂</span>
                    <div class="kpi-icon-box"><i class="ph ph-cloud"></i></div>
                </div>
                <div class="kpi-number">{{ number_format($kpis['total_co2'], 0, ',', ' ') }} <small>kg</small></div>
                <div class="kpi-trend"><i class="ph ph-trend-down"></i><span>Usage</span></div>
            </div>

            <div class="kpi-box kpi-fab">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Fabrication</span>
                    <div class="kpi-icon-box"><i class="ph ph-factory"></i></div>
                </div>
                <div class="kpi-number">{{ number_format($kpis['total_fab_co2'], 0, ',', ' ') }} <small>kg</small></div>
                <div class="kpi-trend"><i class="ph ph-trend-down"></i><span>Embodied</span></div>
            </div>

            <div class="kpi-box kpi-score">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Score Green</span>
                    <div class="kpi-icon-box"><i class="ph ph-chart-bar"></i></div>
                </div>
                <div class="kpi-number">{{ $kpis['score_moyen'] }}<small>/100</small></div>
                <div class="kpi-trend"><i class="ph ph-trend-up"></i><span>Moyenne</span></div>
            </div>

            <div class="kpi-box kpi-alert">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Alertes</span>
                    <div class="kpi-icon-box"><i class="ph ph-warning"></i></div>
                </div>
                <div class="kpi-number">{{ $kpis['a_remplacer'] }}</div>
                <div class="kpi-trend"><i class="ph ph-warning-circle"></i><span>À remplacer</span></div>
            </div>
        </div>

        <!-- Main Grid — 3 colonnes : Donut + Conso + Scores -->
        <div class="main-grid">
            <!-- Donut Chart — Répartition par type -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="ph ph-chart-pie-slice"></i> Répartition par type</h3>
                    <button class="chart-menu"><i class="ph ph-dots-three"></i></button>
                </div>
                <div class="chart-body">
                    <div class="donut-container">
                        <div class="donut-chart">
                            <svg viewBox="0 0 36 36" class="donut">
                                @php
                                    $total = $parType->sum('count');
                                    $offset = 0;
                                    $colors = ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#ec4899', '#06b6d4', '#eab308', '#64748b'];
                                @endphp
                                @foreach($parType as $index => $type)
                                    @php
                                        $pct = $total > 0 ? ($type->count / $total) * 100 : 0;
                                        $dash = $pct * 0.942;
                                        $color = $colors[$index % count($colors)];
                                    @endphp
                                    <circle cx="18" cy="18" r="15.915"
                                        fill="none"
                                        stroke="{{ $color }}"
                                        stroke-width="3"
                                        stroke-dasharray="{{ $dash }} 100"
                                        stroke-dashoffset="{{ -$offset }}"
                                        class="donut-segment"
                                    />
                                    @php $offset += $dash; @endphp
                                @endforeach
                                <circle cx="18" cy="18" r="13" fill="#0b0f19"/>
                            </svg>
                            <div class="donut-center">
                                <span class="donut-value">{{ $total }}</span>
                                <span class="donut-label">Total</span>
                            </div>
                        </div>
                        <div class="donut-legend">
                            @foreach($parType as $index => $type)
                                @php $color = $colors[$index % count($colors)]; @endphp
                                <div class="legend-item">
                                    <span class="legend-dot" style="background: {{ $color }}; color: {{ $color }}"></span>
                                    <span class="legend-name">{{ $type->type }}</span>
                                    <span class="legend-value">{{ $type->count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagramme en Bâton — Top Consommation -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="ph ph-lightning"></i> Top consommation</h3>
                </div>
                <div class="chart-body">
                    <div class="baton-chart" id="consoChart">
                        @php
                            $maxConso = $topConso->max('conso_annuelle_kwh') ?: 1;
                            $consoColors = ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#ec4899'];
                        @endphp
                        @foreach($topConso as $index => $device)
                            @php
                                $height = ($device->conso_annuelle_kwh / $maxConso) * 100;
                                $color = $consoColors[$index % count($consoColors)];
                            @endphp
                            <div class="baton-item">
                                <div class="baton-bar-container">
                                    <div class="baton-bar" style="height: 0%; background: {{ $color }};" data-height="{{ $height }}%"></div>
                                </div>
                                <span class="baton-value">{{ number_format($device->conso_annuelle_kwh, 0, ',', ' ') }}</span>
                                <span class="baton-label" title="{{ $device->nom }}">{{ $device->nom }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Diagramme en Bâton — Scores Faibles -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="ph ph-trend-down"></i> Scores faibles</h3>
                </div>
                <div class="chart-body">
                    <div class="baton-chart" id="scoresChart">
                        @foreach($worstScore as $device)
                            @php
                                $score = $device->score_green_it ?? 0;
                                $height = $score;
                                if ($score >= 70) {
                                    $color = '#10b981';
                                } elseif ($score >= 40) {
                                    $color = '#f59e0b';
                                } else {
                                    $color = '#ef4444';
                                }
                            @endphp
                            <div class="baton-item">
                                <div class="baton-bar-container">
                                    <div class="baton-bar" style="height: 0%; background: {{ $color }};" data-height="{{ $height }}%"></div>
                                </div>
                                <span class="baton-value">{{ $score }}</span>
                                <span class="baton-label" title="{{ $device->nom }}">{{ $device->nom }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Row — Alertes + Actions -->
        <div class="bottom-row">
            <!-- Alertes -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="ph ph-warning"></i> Alertes</h3>
                    @if($alertes->count() > 0)
                        <a href="{{ route('devices.remplacer') }}" class="chart-link">Voir tout</a>
                    @endif
                </div>
                <div class="chart-body">
                    @if($alertes->count() > 0)
                        <div class="alert-cards">
                            @foreach($alertes as $device)
                                @php
                                    $raisons = [];
                                    if ($device->statut === 'recycle') $raisons[] = 'À recycler';
                                    $age = $device->date_achat ? now()->diffInYears($device->date_achat) : null;
                                    if ($age !== null && $device->duree_vie_annees && $age >= $device->duree_vie_annees) {
                                        $raisons[] = "Âge dépassé";
                                    }
                                @endphp
                                <a href="{{ route('devices.edit', $device) }}" class="alert-card-item">
                                    <div class="alert-card-icon"><i class="ph ph-warning"></i></div>
                                    <div class="alert-card-info">
                                        <span class="alert-card-name">{{ $device->nom }}</span>
                                        <span class="alert-card-reason">{{ implode(' + ', $raisons) ?: 'À remplacer' }}</span>
                                    </div>
                                    <i class="ph ph-caret-right"></i>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state-dark">
                            <i class="ph ph-check-circle"></i>
                            <span>Aucune alerte</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="ph ph-lightning"></i> Actions rapides</h3>
                </div>
                <div class="chart-body">
                    <div class="action-grid">
                        <a href="{{ route('devices.create') }}" class="action-btn action-add">
                            <div class="action-icon"><i class="ph ph-plus"></i></div>
                            <span>Nouvel équipement</span>
                        </a>
                        <a href="{{ route('energy.create') }}" class="action-btn action-energy">
                            <div class="action-icon"><i class="ph ph-lightning"></i></div>
                            <span>Consommation</span>
                        </a>
                        <a href="{{ route('devices.index') }}" class="action-btn action-view">
                            <div class="action-icon"><i class="ph ph-list"></i></div>
                            <span>Voir le parc</span>
                        </a>
                        <a href="{{ route('devices.remplacer') }}" class="action-btn action-alert">
                            <div class="action-icon"><i class="ph ph-warning"></i></div>
                            <span>Alertes</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
    // Animation des diagrammes en bâton au chargement
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const bars = document.querySelectorAll('.baton-bar[data-height]');
            bars.forEach(function(bar) {
                bar.style.height = bar.getAttribute('data-height');
            });
        }, 200);
    });
</script>

</body>
</html>