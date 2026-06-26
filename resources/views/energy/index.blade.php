<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consommation Énergétique — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
<style>
:root {
    --green-primary: #10b981;
    --green-bright:  #34d399;
    --green-dark:    #059669;
    --green-glow:    rgba(16,185,129,0.28);
    --green-soft:    rgba(16,185,129,0.1);
    --green-softt:   rgba(190,204,34,0.88);
    --bg-inner:  rgba(255,255,255,0.055);
    --bg-hover:  rgba(238,241,240,0.09);
    --border:    rgba(8,25,16,0.2);
    --border-dim:rgba(177,165,165,0.08);
    --text-1: #f4f6f5dd;
    --text-2: #e6f3ec;
    --text-3: #1bdb9bc2;
    --cyan:   #0cc5e6;
    --amber:  #f79616de;
    --blue:   #76b8f9ea;
    --purple: #4c12d3;
    --red:    #ef4444;
    --r:    14px;
    --r-lg: 22px;
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

html, body {
    font-family: 'Exo 2', sans-serif;
    color: var(--text-1);
    height: 100vh;
    width: 100vw;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url('{{ asset("images/img.jfif") }}');
    background-size: cover;
    background-position: center;
}

body::before {
    content: '';
    position: fixed; inset: 0;
    background: linear-gradient(135deg,rgba(2,12,8,0.42) 0%,rgba(3,18,14,0.32) 50%,rgba(2,10,18,0.45) 100%);
    z-index: 0; pointer-events: none;
}

/* ══ SHELL CONTAINER ══ */
.shell {
    position: relative; z-index: 1;
    display: flex;
    width:  100vw;
    height: 100vh;
    background: rgba(143,158,151,0.45);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    border-radius: 0;
    border: none;
    box-shadow: none;
    overflow: hidden;
    animation: shellIn 0.8s cubic-bezier(.4,0,.2,1) both;
}
@keyframes shellIn { from{opacity:0;transform:scale(0.97) translateY(14px)} to{opacity:1;transform:scale(1) translateY(0)} }

/* ══ SIDEBAR ══ */
.sidebar {
    width: 220px; min-width: 220px;
    display: flex; flex-direction: column;
    background: rgba(4,1,0,0.78);
    border-right: 1px solid rgba(52,211,153,0.12);
    transition: width 0.3s ease, min-width 0.3s ease;
    position: relative; flex-shrink: 0;
}
.sidebar.collapsed { width: 64px; min-width: 64px; }

.sidebar-toggle {
    position: absolute; top: 18px; right: -13px;
    width: 26px; height: 26px;
    background: rgba(2,26,17,0.9); border: 1px solid var(--border);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--green-primary); font-size: 12px;
    z-index: 20; box-shadow: 0 2px 10px rgba(0,0,0,0.4); transition: all 0.2s;
}
.sidebar-toggle:hover { background: var(--green-soft); box-shadow: 0 0 10px var(--green-glow); }
.sidebar.collapsed .sidebar-toggle i { transform: rotate(180deg); }

.brand {
    display: flex; align-items: center; gap: 12px;
    padding: 22px 20px 18px;
    border-bottom: 1px solid var(--border-dim); flex-shrink: 0;
}
.sidebar.collapsed .brand { justify-content: center; padding: 22px 0 18px; }
.brand-icon {
    width: 38px; height: 38px;
    background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #fff; box-shadow: 0 0 18px var(--green-glow); flex-shrink: 0;
}
.brand-label {
    font-family: 'Rajdhani', sans-serif; font-size: 17px; font-weight: 700;
    color: var(--text-1); letter-spacing: 0.05em; text-transform: uppercase;
    white-space: nowrap; transition: opacity 0.2s;
}
.sidebar.collapsed .brand-label { opacity:0; width:0; overflow:hidden; display:none; }

.nav-group { padding: 14px 12px 0; }
.nav-group-title {
    font-size: 10px; font-weight: 700; color: var(--text-3);
    text-transform: uppercase; letter-spacing: 0.12em;
    padding: 0 8px; margin-bottom: 6px;
}
.sidebar.collapsed .nav-group-title { display: none; }
nav { display: flex; flex-direction: column; gap: 2px; }

.nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; border-radius: 8px;
    color: var(--text-2); font-size: 13px; font-weight: 500;
    text-decoration: none; transition: all 0.2s; white-space: nowrap; position: relative;
}
.sidebar.collapsed .nav-item { justify-content:center; padding:10px; width:40px; margin:0 auto; }
.nav-item:hover { background: var(--bg-hover); color: var(--green-bright); }
.nav-item.active { background: rgba(16,185,129,0.12); color: var(--green-bright); }
.nav-item i { font-size: 18px; flex-shrink: 0; width: 22px; text-align: center; }
.sidebar.collapsed .nav-item span { opacity:0; width:0; overflow:hidden; display:none; }

.nav-badge {
    margin-left: auto;
    background: var(--red); color: #fff; font-size: 10px; font-weight: 700;
    border-radius: 10px; padding: 1px 6px;
}
.sidebar.collapsed .nav-badge { position:absolute; top:2px; right:2px; margin:0; }
.sidebar.collapsed .nav-item[title]::after {
    content: attr(title); position: absolute; left: 52px;
    background: rgba(4,18,12,0.95); color: var(--text-1);
    padding: 5px 10px; border-radius: 6px; font-size: 11px;
    white-space: nowrap; opacity: 0; pointer-events: none;
    transition: opacity 0.15s; border: 1px solid var(--border); z-index: 100;
}
.sidebar.collapsed .nav-item:hover::after { opacity: 1; }

.sidebar-footer { margin-top: auto; padding: 14px 16px; border-top: 1px solid var(--border-dim); }
.sidebar.collapsed .sidebar-footer { padding: 14px 6px; display:flex; justify-content:center; }
.user-row { display:flex; align-items:center; gap:9px; margin-bottom: 10px; }
.sidebar.collapsed .user-row { display: none; }
.avatar {
    width:32px; height:32px;
    background: linear-gradient(135deg, var(--blue), var(--purple));
    border-radius: 8px; display:flex; align-items:center; justify-content:center;
    font-size:13px; font-weight:700; color:#fff; flex-shrink:0;
}
.user-info { display:flex; flex-direction:column; overflow:hidden; }
.user-name { font-size:12px; font-weight:600; color:var(--text-1); white-space:nowrap; }
.user-role { font-size:10px; color:var(--text-3); }
.btn-logout {
    display:flex; align-items:center; gap:8px;
    padding:8px 10px; border-radius:8px; border:none;
    background:#10b981; color:white; cursor:pointer; font-size:12px; font-weight:500;
    text-decoration:none; width:100%; transition:all 0.2s;
}
.btn-logout:hover { color:var(--red); }
.btn-logout i { font-size:16px; flex-shrink:0; }
.sidebar.collapsed .btn-logout { width:40px; padding:10px; justify-content:center; }
.sidebar.collapsed .btn-logout span { display:none; }

/* ══ MAIN COLUMN ══ */
.main {
    flex: 1; min-width: 0;
    display: flex; flex-direction: column;
    overflow: hidden;
    height: 100%;
}

/* ══ TOPBAR ══ */
.topbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 24px;
    height: 52px;
    flex-shrink: 0;
    border-bottom: 1px solid var(--border-dim);
    background: rgba(87,109,100,0.22);
    backdrop-filter: blur(10px);
}
.title-badge {
    display:inline-flex; align-items:center; gap:7px;
    background: rgba(1,16,11,0.97);
    border: 1px solid var(--green-bright);
    border-radius: 20px; padding: 8px 16px;
    font-family: 'Rajdhani', sans-serif;
    font-size: 14px; font-weight: 700;
    color: var(--green-bright); letter-spacing: 0.08em; text-transform: uppercase;
}
.title-badge i { font-size:16px; }
.topbar-right { display:flex; align-items:center; gap:9px; }
.tb-date {
    display:flex; align-items:center; gap:7px;
    padding:6px 12px; border:1px solid var(--border-dim);
    border-radius:9px; background:var(--bg-inner);
    font-size:11px; color:var(--text-2);
}
.tb-date i { color:var(--green-primary); font-size:14px; }
.tb-user { display:flex; align-items:center; color:var(--green-primary); font-size:22px; text-decoration:none; }

/* ══ DASH BODY : scroll global sur tout le contenu ══ */
.dash-body {
    flex: 1;
    min-height: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 14px 20px 16px;
    overflow-y: auto;
    overflow-x: hidden;
}
.dash-body::-webkit-scrollbar { width: 6px; }
.dash-body::-webkit-scrollbar-track { background: transparent; }
.dash-body::-webkit-scrollbar-thumb { background: rgba(16,185,129,0.3); border-radius: 3px; }
.dash-body::-webkit-scrollbar-thumb:hover { background: rgba(16,185,129,0.5); }

/* ══ KPI STRIP ══ */
.kpi-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    align-items: stretch;
    flex-shrink: 0;
}
.kpi {
    background: rgba(255,255,255,0.055);
    border: 1px solid rgba(52,211,153,0.14);
    border-radius: var(--r);
    padding: 12px 14px;
    position: relative; overflow: hidden;
    transition: all 0.25s;
    backdrop-filter: blur(8px);
}
.kpi:hover { border-color:rgba(52,211,153,0.35); transform:translateY(-1px); box-shadow:0 6px 20px rgba(0,0,0,0.25); }
.kpi::after {
    content:''; position:absolute; top:-50%; right:-30%;
    width:70%; height:70%; border-radius:50%;
    filter:blur(26px); opacity:0.08; pointer-events:none;
}
.kpi-kwh::after { background:var(--green-primary); }
.kpi-co2::after { background:var(--amber); }
.kpi-eqp::after { background:var(--blue); }
.kpi-sc::after  { background:var(--cyan); }

.kpi-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:6px; }
.kpi-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--text-3); }
.kpi-ico { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:18px; }
.kpi-kwh .kpi-ico { background:var(--green-soft); color:var(--green-softt); }
.kpi-co2 .kpi-ico { background:rgba(245,158,11,0.11); color:var(--amber); }
.kpi-eqp .kpi-ico { background:rgba(59,130,246,0.13); color:var(--blue); }
.kpi-sc  .kpi-ico { background:rgba(6,182,212,0.11); color:var(--cyan); }
.kpi-val { font-family:'Rajdhani',sans-serif; font-size:26px; font-weight:700; color:var(--text-1); line-height:1; }
.kpi-foot { display:flex; align-items:center; gap:4px; margin-top:6px; font-size:11px; color:var(--text-3); font-weight:600; }
.kpi-foot i { font-size:14px; }

/* ══ ROW 2 : CHARTS côte à côte ══ */
.charts-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    flex-shrink: 0;
    min-height: 280px;
    max-height: 320px;
}
.card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(52,211,153,0.13);
    border-radius: var(--r);
    backdrop-filter: blur(10px);
    display: flex; flex-direction: column;
    overflow: hidden;
    min-height: 0;
    transition: border-color 0.2s;
}
.card:hover { border-color:rgba(52,211,153,0.28); }
.card-head {
    display:flex; justify-content:space-between; align-items:center;
    padding: 10px 14px;
    border-bottom:1px solid var(--border-dim);
    flex-shrink: 0;
}
.card-title {
    display:flex; align-items:center; gap:6px;
    font-family:'Rajdhani',sans-serif; font-size:14px; font-weight:700;
    color:var(--green-bright); text-transform:uppercase; letter-spacing:0.07em;
}
.card-title i { font-size:16px; }
.card-link {
    display:flex; align-items:center; gap:5px;
    font-size:12px; color:var(--text-3); text-decoration:none; font-weight:600;
    transition: color 0.2s;
}
.card-link:hover { color:var(--green-bright); }
.card-link i { font-size:14px; }
.card-body {
    flex: 1; min-height: 0;
    padding: 10px 14px;
    display: flex; flex-direction: column;
    position: relative;
    overflow: hidden;
}

/* ══ ROW 3 : HISTORIQUE ══ */
.history-card {
    display: flex;
    flex-direction: column;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(52,211,153,0.13);
    border-radius: var(--r);
    backdrop-filter: blur(10px);
    overflow: hidden;
    flex-shrink: 0;
    min-height: 200px;
}
.history-head {
    display:flex; align-items:center; flex-wrap:nowrap; gap:10px;
    padding: 10px 14px;
    border-bottom:1px solid var(--border-dim);
    flex-shrink: 0;
    background: rgba(8,20,14,0.95);
}
.history-body {
    flex: 1;
    min-height: 0;
    overflow: hidden;
}
 
/* ══ TABLE ══ */
.srv-table { width:100%; border-collapse:collapse; }
.srv-table th {
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em;
    color:var(--text-3); padding:6px 12px;
    border-bottom:1px solid var(--border-dim);
    text-align:left;
    background:rgba(16,185,129,0.03);
}
.srv-table td { padding:6px 12px; font-size:11px; color:var(--text-2); border-bottom:1px solid rgba(255,255,255,0.03); }
.srv-table tr:last-child td { border-bottom:none; }
.srv-table tr:hover td { background:var(--bg-hover); color:var(--text-1); }
.srv-name { font-weight:600; color:var(--text-1) !important; font-size:12px !important; }
.score-pill { display:inline-flex; align-items:center; justify-content:center; min-width:28px; padding:2px 7px; border-radius:4px; font-size:10px; font-weight:700; font-family:'Rajdhani',sans-serif; }
.score-hi  { background:rgba(16,185,129,0.14); color:var(--green-bright); }
.score-mid { background:rgba(245,158,11,0.14); color:var(--amber); }
.score-lo  { background:rgba(239,68,68,0.14);  color:var(--red); }

/* ══ FILTER INLINE ══ */
.filter-form { display:flex; gap:10px; align-items:center; flex-wrap:nowrap; margin-left:auto; }
.filter-input {
    background: rgba(0,0,0,0.4); color: var(--text-1);
    border: 1px solid rgba(52,211,153,0.2); border-radius: 6px;
    padding: 5px 10px; font-family: 'Exo 2', sans-serif; font-size: 12px; outline: none;
}
.filter-input:focus { border-color: rgba(52,211,153,0.5); }
select.filter-input { min-width: 140px; }
.filter-btn {
    display:flex; align-items:center; justify-content:center;
    width:30px; height:30px; border-radius:6px; cursor:pointer; font-size:14px; border:none;
}
.filter-btn-go  { background:rgba(16,185,129,0.2); border:1px solid rgba(16,185,129,0.4); color:var(--green-bright); }
.filter-btn-rst { background:rgba(255,255,255,0.05); border:1px solid var(--border-dim); color:var(--text-2); text-decoration:none; }
.entries-badge { font-size:12px; color:var(--text-3); font-weight:600; white-space:nowrap; }

@keyframes fadeUp { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="shell">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-toggle" id="sidebarToggle" title="Réduire / Agrandir">
            <i class="ph ph-caret-left"></i>
        </div>
        <div class="brand">
            <div class="brand-icon"><i class="ph ph-leaf"></i></div>
            <span class="brand-label">Green IT</span>
        </div>
        <div class="nav-group">
            <div class="nav-group-title">Principal</div>
            <nav>
                <a href="{{ route('dashboard') }}" class="nav-item" title="Dashboard">
                    <i class="ph ph-squares-four"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('devices.index') }}" class="nav-item" title="Parc informatique">
                    <i class="ph ph-desktop"></i><span>Parc informatique</span>
                </a>
                <a href="{{ route('energy.index') }}" class="nav-item active" title="Consommation">
                    <i class="ph ph-lightning"></i><span>Consommation</span>
                </a>
             <a href="{{ route('devices.remplacer') }}" class="nav-item" title="Alertes">
    <i class="ph ph-warning"></i><span>Alertes</span>
    @if(($alertCount ?? 0) > 0)
        <span class="nav-badge">{{ $alertCount }}</span>
    @endif
</a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="user-row">
                <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">Administrateur</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout" title="Déconnexion">
                    <i class="ph ph-sign-out"></i><span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <div class="title-badge">
                <i class="ph ph-lightning"></i>
                Consommation Énergétique — Suivi & Analyse
            </div>
            <div class="topbar-right">
                <a href="{{ route('profile') }}" class="tb-user" title="{{ Auth::user()->name }}">
                    <i class="ph ph-user-circle"></i>
                </a>
                <div class="tb-date">
                    <i class="ph ph-calendar-blank"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="dash-body">

            <!-- ── RANGÉE 1 : KPI STRIP ── -->
            <div class="kpi-strip">
                <div class="kpi kpi-kwh">
                    <div class="kpi-head">
                        <span class="kpi-label">kWh Total</span>
                        <div class="kpi-ico"><i class="ph ph-lightning"></i></div>
                    </div>
                    <div class="kpi-val">{{ number_format($totalConsumption, 2) }}</div>
                    <div class="kpi-foot"><i class="ph ph-check-circle"></i> Mesures enregistrées</div>
                </div>
                <div class="kpi kpi-co2">
                    <div class="kpi-head">
                        <span class="kpi-label">kg CO₂</span>
                        <div class="kpi-ico"><i class="ph ph-cloud"></i></div>
                    </div>
                    <div class="kpi-val">{{ number_format($totalCO2Calc, 2) }}</div>
                    <div class="kpi-foot"><i class="ph ph-leaf"></i> Émissions calculées</div>
                </div>
                <div class="kpi kpi-eqp">
                    <div class="kpi-head">
                        <span class="kpi-label">Appareils</span>
                        <div class="kpi-ico"><i class="ph ph-desktop"></i></div>
                    </div>
                    <div class="kpi-val">{{ count($devices) }}</div>
                    <div class="kpi-foot"><i class="ph ph-cpu"></i> Matériels suivis</div>
                </div>
                <div class="kpi kpi-sc">
                    <div class="kpi-head">
                        <span class="kpi-label">Mesures</span>
                        <div class="kpi-ico"><i class="ph ph-chart-bar"></i></div>
                    </div>
                    <div class="kpi-val">{{ count($energyLogs) }}</div>
                    <div class="kpi-foot"><i class="ph ph-database"></i> Entrées d'historique</div>
                </div>
            </div>

            <!-- ── RANGÉE 2 : GRAPHIQUES ── -->
            <div class="charts-row">
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="ph ph-chart-bar"></i> Répartition Consommation (kWh)</div>
                        <a href="{{ route('devices.index') }}" class="card-link">
                            <i class="ph ph-desktop"></i> Parc matériel
                        </a>
                    </div>
                    <div class="card-body">
                        <canvas id="deviceChart" style="width:100%;height:100%;"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="ph ph-trend-up"></i> Évolution Empreinte Carbone</div>
                        <a href="{{ route('energy.create') }}" class="card-link" style="color:var(--green-bright);">
                            <i class="ph ph-plus-circle"></i> Nouvelle mesure
                        </a>
                    </div>
                    <div class="card-body">
                        <canvas id="trendChart" style="width:100%;height:100%;"></canvas>
                    </div>
                </div>
            </div>

            <!-- ── RANGÉE 3 : HISTORIQUE + FILTRE INLINE ── -->
            <div class="history-card">
                <div class="history-head">
                    <div class="card-title"><i class="ph ph-list"></i> Historique des consommations</div>
                    <form method="GET" action="{{ route('energy.index') }}" class="filter-form">
                        <select name="device_id" class="filter-input">
                            <option value="" style="background:#111;">Tous les appareils</option>
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}" {{ request('device_id') == $device->id ? 'selected' : '' }} style="background:#111;">
                                    {{ $device->nom }}
                                </option>
                            @endforeach
                        </select>
                        <input type="date" name="date_debut" value="{{ request('date_debut') }}" class="filter-input">
                        <input type="date" name="date_fin"   value="{{ request('date_fin') }}"   class="filter-input">
                        <button type="submit" class="filter-btn filter-btn-go" title="Filtrer">
                            <i class="ph ph-funnel"></i>
                        </button>
                        <a href="{{ route('energy.index') }}" class="filter-btn filter-btn-rst" title="Reset">
                            <i class="ph ph-arrow-counter-clockwise"></i>
                        </a>
                        <span class="entries-badge">{{ count($energyLogs) }} entrées</span>
                    </form>
                </div>
                <div class="history-body">
                    <table class="srv-table">
                        <thead>
                            <tr>
                                <th>Appareil</th>
                                <th>Période</th>
                                <th>kWh</th>
                                <th>kg CO₂</th>
                                <th>Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($energyLogs as $log)
                                <tr>
                                    <td class="srv-name">{{ $log->device->nom ?? 'N/A' }}</td>
                                    <td>{{ $log->date_debut?->format('d/m/Y') }} → {{ $log->date_fin?->format('d/m/Y') }}</td>
                                    <td style="font-family:'Rajdhani',sans-serif;font-size:13px;font-weight:600;">{{ number_format($log->consumption_kwh ?? $log->consumption, 2) }}</td>
                                    <td style="font-family:'Rajdhani',sans-serif;font-size:13px;font-weight:600;color:var(--amber);">{{ number_format($log->emission_co2_kg ?? (($log->consumption_kwh ?? 0) * 0.7), 2) }}</td>
                                    <td>
                                        @php
                                            $sc = match($log->source ?? 'mesure_reelle') {
                                                'estimation' => ['score-mid','Estimation'],
                                                'facture'    => ['score-hi','Facture'],
                                                'api_carbon' => ['score-hi','API'],
                                                default      => ['score-hi','Mesure']
                                            };
                                        @endphp
                                        <span class="score-pill {{ $sc[0] }}">{{ $sc[1] }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;padding:20px;color:rgba(255,255,255,0.35);">
                                        <i class="ph ph-tray" style="font-size:22px;display:block;margin-bottom:5px;"></i>
                                        Aucune mesure enregistrée.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /dash-body -->
    </div><!-- /main -->
</div><!-- /shell -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* Sidebar toggle */
    const sidebar = document.getElementById('sidebar');
    const toggle  = document.getElementById('sidebarToggle');
    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        toggle.querySelector('i').className =
            sidebar.classList.contains('collapsed') ? 'ph ph-caret-right' : 'ph ph-caret-left';
    });

    Chart.defaults.font.family = "'Exo 2', sans-serif";
    Chart.defaults.color = 'rgba(255,255,255,0.65)';

    const logs = {!! json_encode($energyLogs) !!};
    const deviceMetrics   = {};
    const timelineMetrics = {};

    logs.forEach(log => {
        const dName  = log.device ? log.device.nom : 'Inconnu';
        const valKwh = parseFloat(log.consumption_kwh || log.consumption || 0);
        const valCo2 = parseFloat(log.emission_co2_kg || valKwh * 0.7);
        deviceMetrics[dName] = (deviceMetrics[dName] || 0) + valKwh;
        if (log.date_debut) {
            const k = new Date(log.date_debut).toLocaleDateString('fr-FR', { month:'short', year:'2-digit' });
            timelineMetrics[k] = (timelineMetrics[k] || 0) + valCo2;
        }
    });

    const tickStyle = { color:'rgba(255,255,255,0.55)', font:{ size:9 } };
    const gridStyle = { color:'rgba(255,255,255,0.05)' };

    new Chart(document.getElementById('deviceChart'), {
        type: 'bar',
        data: {
            labels:   Object.keys(deviceMetrics).length   ? Object.keys(deviceMetrics)   : ['—'],
            datasets: [{ data: Object.values(deviceMetrics).length ? Object.values(deviceMetrics) : [0],
                backgroundColor:'rgba(52,211,153,0.18)', borderColor:'#34d399',
                borderWidth:2, borderRadius:5, hoverBackgroundColor:'rgba(52,211,153,0.4)' }]
        },
        options: { responsive:true, maintainAspectRatio:false,
            plugins:{ legend:{display:false} },
            scales:{ x:{grid:{display:false}, ticks:tickStyle}, y:{grid:gridStyle, ticks:tickStyle} }
        }
    });

    const ctxL  = document.getElementById('trendChart').getContext('2d');
    const grad  = ctxL.createLinearGradient(0,0,0,160);
    grad.addColorStop(0,'rgba(247,150,22,0.28)');
    grad.addColorStop(1,'rgba(247,150,22,0)');

    new Chart(ctxL, {
        type: 'line',
        data: {
            labels:   Object.keys(timelineMetrics).length   ? Object.keys(timelineMetrics)   : ['—'],
            datasets: [{ data: Object.values(timelineMetrics).length ? Object.values(timelineMetrics) : [0],
                borderColor:'#f79616', backgroundColor:grad,
                borderWidth:2.5, tension:0.38, fill:true,
                pointBackgroundColor:'#f79616', pointHoverRadius:5, pointRadius:3 }]
        },
        options: { responsive:true, maintainAspectRatio:false,
            plugins:{ legend:{display:false} },
            scales:{ x:{grid:{display:false}, ticks:tickStyle}, y:{grid:gridStyle, ticks:tickStyle} }
        }
    });
});
</script>
</body>
</html>