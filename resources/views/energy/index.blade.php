<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consommation Énergétique — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
/* ═══════════════════════════════════════════════════════ */
/* GREEN IT DASHBOARD v3 — Centered Floating Glass Card   */
/* ═══════════════════════════════════════════════════════ */

:root {
    --green-primary:   #10b981;
    --green-bright:    #34d399;
    --green-dark:      #059669;
    --green-glow:      rgba(16,185,129,0.28);
    --green-soft:      rgba(16, 185, 129, 0.1);
    --green-softt:rgba(190, 204, 34, 0.88);

    --bg-card:    rgba(244, 250, 248, 0.72);
    --bg-inner:   rgba(255,255,255,0.055);
    --bg-hover:   rgba(238, 241, 240, 0.09);

    --border:     rgba(8, 25, 16, 0.2);
    --border-dim: rgba(177, 165, 165, 0.08);

    --text-1: #f4f6f5dd;
    --text-2: #e6f3ec;
    --text-3: #10b981;

    --cyan:   #0cc5e6;
    --amber:  #f79616de;
 
    --blue:   #76b8f9ea;
    --purple: #4c12d3;
    --red:    #ef4444;

    --r:      14px;
    --r-lg:   22px;
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

html, body {
    font-family: 'Exo 2', sans-serif;
    color: var(--text-1);
    min-height: 100vh;
    overflow-y: auto;
    -webkit-font-smoothing: antialiased;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 0;
    background-image: url('{{ asset("images/img.jfif") }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

body::before {
    content: '';
    position: fixed; inset: 0;
    background: linear-gradient(135deg,
        rgba(2,12,8,0.42) 0%,
        rgba(3,18,14,0.32) 50%,
        rgba(2,10,18,0.45) 100%
    );
    z-index: 0;
    pointer-events: none;
}

.shell {
    position: relative;
    z-index: 1;
    display: flex;
    width:  min(1380px, 85vw);
    min-height: min(860px, 85vh);
    background: rgba(143, 158, 151, 0.45);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    border-radius: var(--r-lg);
    border: 1px solid rgba(52,211,153,0.18);
    box-shadow:
        0 32px 80px rgba(0,0,0,0.45),
        0  0  40px rgba(16,185,129,0.06) inset,
        0  1px 0   rgba(255,255,255,0.12) inset;
    animation: shellIn 0.8s cubic-bezier(.4,0,.2,1) both;
}

@keyframes shellIn {
    from { opacity:0; transform:scale(0.97) translateY(14px); }
    to   { opacity:1; transform:scale(1)    translateY(0); }
}

.sidebar {
    width: 220px;
    min-width: 220px;
    display: flex;
    flex-direction: column;
    background: rgba(4, 1, 0, 0.78);
    border-right: 1px solid rgba(52,211,153,0.12);
    padding: 0;
    transition: width 0.3s ease, min-width 0.3s ease;
    position: relative;
    flex-shrink: 0;
}
.sidebar.collapsed { width: 64px; min-width: 64px; }

.sidebar-toggle {
    position: absolute; top: 18px; right: -13px;
    width: 26px; height: 26px;
    background: rgba(2, 26, 17, 0.9);
    border: 1px solid var(--border);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--green-primary); font-size: 12px;
    z-index: 20;
    box-shadow: 0 2px 10px rgba(0,0,0,0.4);
    transition: all 0.2s;
}
.sidebar-toggle:hover { background: var(--green-soft); box-shadow: 0 0 10px var(--green-glow); }
.sidebar.collapsed .sidebar-toggle i { transform: rotate(180deg); }

.brand {
    display: flex; align-items: center; gap: 12px;
    padding: 22px 20px 18px;
    border-bottom: 1px solid var(--border-dim);
    flex-shrink: 0;
}
.sidebar.collapsed .brand { justify-content: center; padding: 22px 0 18px; }

.brand-icon {
    width: 38px; height: 38px;
    background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #fff;
    box-shadow: 0 0 18px var(--green-glow);
    flex-shrink: 0;
}
.brand-label {
    font-family: 'Rajdhani', sans-serif;
    font-size: 17px; font-weight: 700;
    color: var(--text-1); letter-spacing: 0.05em; text-transform: uppercase;
    white-space: nowrap; transition: opacity 0.2s;
}
.sidebar.collapsed .brand-label { opacity:0; width:0; overflow:hidden; display:none; }

.nav-group { padding: 14px 12px 0; }
.nav-group-title {
    font-size: 9px; font-weight: 700; color: var(--text-3);
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
.nav-item.active { background: rgba(16, 185, 129, 0.15); color: var(--green-bright); border-left: 3px solid var(--green-bright); }

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

.sidebar-footer {
    margin-top: auto; padding: 14px 16px;
    border-top: 1px solid var(--border-dim);
}
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
    background: rgba(16, 185, 129, 0.2); color: var(--green-bright);
    cursor:pointer; font-size:12px; font-weight:500;
    text-decoration:none; width:100%; transition:all 0.2s;
    border: 1px solid rgba(16, 185, 129, 0.3);
}
.btn-logout:hover { background: var(--red); color: white; border-color: transparent; }
.btn-logout i { font-size:16px; flex-shrink:0; }
.sidebar.collapsed .btn-logout { width:40px; padding:10px; justify-content:center; }
.sidebar.collapsed .btn-logout span { display:none; }

.main {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    min-width: 0px;
}

.topbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 15px 24px;
    min-height: 60px;
    border-bottom: 1px solid var(--border-dim);
    background: rgba(87, 109, 100, 0.22);
    backdrop-filter: blur(10px);
    flex-shrink: 0;
}
.title-badge {
    display:inline-flex; align-items:center; gap:7px;
    background: rgba(1, 16, 11, 0.97);
    border: 1px solid var(--green-bright);
    border-radius: 20px; padding: 10px 16px;
    font-family: 'Rajdhani', sans-serif;
    font-size: 15px; font-weight: 700;
    color: var(--green-bright); letter-spacing: 0.08em; text-transform: uppercase;
}
.title-badge i { font-size:17px; }
.topbar-right { display:flex; align-items:center; gap:9px; }
.tb-date {
    display:flex; align-items:center; gap:7px;
    padding:6px 12px; border:1px solid var(--border-dim);
    border-radius:9px; background:var(--bg-inner);
    font-size:11px; color:var(--text-2);
}
.tb-date i { color:var(--green-primary); font-size:14px; }

.dash-body {
    flex: 1;
    padding: 20px 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.dash-body::-webkit-scrollbar { width: 8px; }
.dash-body::-webkit-scrollbar-thumb { background: rgba(52,211,153,0.3); border-radius: 5px; }

.kpi-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    flex-shrink: 0;
    animation: fadeUp 0.5s ease both;
}

.kpi {
    background: rgba(255,255,255,0.055);
    border: 1px solid rgba(52,211,153,0.14);
    border-radius: var(--r);
    padding: 16px;
    position: relative; overflow: hidden;
    transition: all 0.25s;
    backdrop-filter: blur(8px);
}
.kpi:hover { border-color:var(--green-bright); transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.3); }

.kpi-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:7px; }
.kpi-label { font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:0.08em; color:var(--text-3); }
.kpi-ico { width:32px; height:32px; border-radius:7px; display:flex; align-items:center; justify-content:center; font-size:18px; }
.kpi-eqp .kpi-ico { background:rgba(59,130,246,0.13); color:var(--blue); }
.kpi-kwh .kpi-ico { background:var(--green-soft); color:var(--green-bright); }
.kpi-co2 .kpi-ico { background:rgba(245,158,11,0.11); color:var(--amber); }
.kpi-sc .kpi-ico { background:rgba(6,182,212,0.11); color:var(--cyan); }

.kpi-val { font-family:'Rajdhani',sans-serif; font-size:26px; font-weight:700; color:var(--text-1); line-height:1; }
.kpi-foot { display:flex; align-items:center; gap:4px; margin-top:8px; font-size:11px; color:rgba(255,255,255,0.5); }
.kpi-foot i { font-size:14px; color: var(--green-bright); }

/* Zone des graphiques */
.grid-charts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    animation: fadeUp 0.5s 0.08s ease both;
}

.card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(52,211,153,0.13);
    border-radius: var(--r);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex; flex-direction: column; overflow: hidden;
    transition: border-color 0.2s;
}
.card:hover { border-color: rgba(52,211,153,0.3); }
.card-head {
    display:flex; justify-content:space-between; align-items:center;
    padding: 12px 16px; border-bottom:1px solid var(--border-dim); flex-shrink:0;
}
.card-title {
    display:flex; align-items:center; gap:6px;
    font-family:'Rajdhani',sans-serif; font-size:13px; font-weight:700;
    color:var(--green-bright); text-transform:uppercase; letter-spacing:0.07em;
}
.card-title i { font-size:16px; }

/* Correction essentielle pour Chart.js */
.card-body { 
    flex:1; 
    padding:16px; 
    display:block; 
    position: relative;
    min-height: 280px; 
}

.grid-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.action-btn {
    display: flex; align-items: center; gap: 12px;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(52,211,153,0.1);
    padding: 14px 20px; border-radius: var(--r);
    color: var(--text-1); transition: all 0.2s; cursor: pointer;
}
.action-btn:hover {
    background: rgba(16, 185, 129, 0.1);
    border-color: var(--green-bright);
    transform: translateY(-1px);
}
.action-icon {
    width: 36px; height: 36px; border-radius: 8px;
    background: rgba(16, 185, 129, 0.15);
    color: var(--green-bright);
    display: flex; align-items: center; justify-content: center; font-size: 18px;
}

.srv-table { width:100%; border-collapse:collapse; }
.srv-table th { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--text-3); padding:10px 12px; border-bottom:1px solid var(--border-dim); text-align:left; background:rgba(16,185,129,0.04); }
.srv-table td { padding:10px 12px; font-size:12px; color:var(--text-2); border-bottom:1px solid rgba(255,255,255,0.03); }
.srv-table tr:last-child td { border-bottom:none; }
.srv-table tr:hover td { background:var(--bg-hover); color:var(--text-1); }
.srv-name { font-weight:600; color:var(--text-1) !important; }

.score-pill { display:inline-flex; align-items:center; justify-content:center; padding:3px 8px; border-radius:6px; font-size:10px; font-weight:700; font-family:'Rajdhani',sans-serif; text-transform: uppercase; }
.score-hi  { background:rgba(16,185,129,0.14); color:var(--green-bright); border: 1px solid rgba(16,185,129,0.3); }
.score-mid { background:rgba(245,158,11,0.14); color:var(--amber); border: 1px solid rgba(245,158,11,0.3); }

@keyframes fadeUp {
    from { opacity:0; transform:translateY(10px); }
    to   { opacity:1; transform:translateY(0); }
}

.chart-wrapper {
    position: relative;
    width: 100%;
    height: 250px;
}
</style>
</head>
<body>

<div class="shell">

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
                    @if($alertCount > 0)
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

    <div class="main">

        <div class="topbar">
            <div class="title-badge">
                <i class="ph ph-lightning"></i>
                Consommation Énergétique — Suivi & Analyse
            </div>
            <div class="topbar-right">
                <div class="tb-date">
                    <i class="ph ph-calendar-blank"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="dash-body">

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

            <div class="grid-charts">
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="ph ph-chart-bar"></i> Répartition Consommation (kWh)</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                            <canvas id="deviceChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="ph ph-trend-up"></i> Évolution de l'Empreinte Carbone</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid-actions">
                <a href="{{ route('energy.create') }}" class="action-btn" style="text-decoration: none;">
                    <div class="action-icon"><i class="ph ph-plus"></i></div>
                    <span>Ajouter une nouvelle mesure</span>
                </a>
                <a href="{{ route('devices.index') }}" class="action-btn" style="text-decoration: none;">
                    <div class="action-icon"><i class="ph ph-desktop"></i></div>
                    <span>Consulter le parc matériel</span>
                </a>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="ph ph-funnel"></i> Filtrer les analyses</div>
                </div>
                <div class="card-body" style="min-height: auto; padding: 14px 16px;">
                    <form method="GET" action="{{ route('energy.index') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <select name="device_id" style="background: rgba(0,0,0,0.4); color: var(--text-1); border: 1px solid rgba(52,211,153,0.2); border-radius: 8px; padding: 8px 12px; min-width: 180px; font-family: 'Exo 2', sans-serif; font-size: 13px; outline: none;">
                            <option value="" style="background: #111; color: var(--text-1);">Tous les appareils</option>
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}" {{ request('device_id') == $device->id ? 'selected' : '' }} style="background: #111; color: var(--text-1);">
                                    {{ $device->nom }}
                                </option>
                            @endforeach
                        </select>
                        
                        <input type="date" name="date_debut" value="{{ request('date_debut') }}" style="background: rgba(0,0,0,0.4); color: var(--text-1); border: 1px solid rgba(52,211,153,0.2); border-radius: 8px; padding: 8px 12px; font-family: 'Exo 2', sans-serif; font-size: 13px; outline: none;">
                        <input type="date" name="date_fin" value="{{ request('date_fin') }}" style="background: rgba(0,0,0,0.4); color: var(--text-1); border: 1px solid rgba(52,211,153,0.2); border-radius: 8px; padding: 8px 12px; font-family: 'Exo 2', sans-serif; font-size: 13px; outline: none;">
                        
                        <button type="submit" class="action-btn" style="padding: 8px 16px; border-radius: 8px; font-size: 13px; background: rgba(16, 185, 129, 0.2); border-color: rgba(16, 185, 129, 0.4);">
                            <i class="ph ph-funnel" style="color: var(--green-bright)"></i><span>Filtrer</span>
                        </button>
                        <a href="{{ route('energy.index') }}" class="action-btn" style="padding: 8px 16px; border-radius: 8px; font-size: 13px; text-decoration: none; background: rgba(255,255,255,0.05); border-color: transparent;">
                            <i class="ph ph-arrow-counter-clockwise" style="color: #fff"></i><span>Reset</span>
                        </a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="ph ph-list"></i> Historique des consommations</div>
                    <span style="font-size: 11px; color: var(--text-3); font-weight: 600;">{{ count($energyLogs) }} entrées</span>
                </div>
                <div class="card-body" style="padding: 0; min-height: auto;">
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
                                    <td style="font-family: 'Rajdhani', sans-serif; font-size: 14px; font-weight: 600;">{{ number_format($log->consumption_kwh ?? $log->consumption, 2) }}</td>
                                    <td style="font-family: 'Rajdhani', sans-serif; font-size: 14px; font-weight: 600; color: var(--amber);">{{ number_format($log->emission_co2_kg ?? (($log->consumption_kwh ?? 0) * 0.7), 2) }}</td>
                                    <td>
                                        @php
                                            $sourceClass = match($log->source ?? 'mesure_reelle') {
                                                'mesure_reelle' => 'score-hi',
                                                'estimation' => 'score-mid',
                                                'facture' => 'score-hi',
                                                'api_carbon' => 'score-hi',
                                                default => 'score-hi'
                                            };
                                            $sourceLabel = match($log->source ?? 'mesure_reelle') {
                                                'mesure_reelle' => 'Mesure',
                                                'estimation' => 'Estimation',
                                                'facture' => 'Facture',
                                                'api_carbon' => 'API',
                                                default => 'Mesure'
                                            };
                                        @endphp
                                        <span class="score-pill {{ $sourceClass }}">{{ $sourceLabel }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 30px; color: rgba(255,255,255,0.4);">
                                        <i class="ph ph-tray" style="font-size: 24px; display: block; margin-bottom: 6px;"></i>
                                        Aucune mesure enregistrée pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Gestion de l'ouverture/fermeture du Sidebar
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    
    if (sidebar && sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            const icon = sidebarToggle.querySelector('i');
            icon.className = sidebar.classList.contains('collapsed') ? 'ph ph-caret-right' : 'ph ph-caret-left';
        });
    }

    // Configuration par défaut pour adapter Chart.js au thème Cyber-Green
    Chart.defaults.font.family = "'Exo 2', sans-serif";
    Chart.defaults.color = 'rgba(255, 255, 255, 0.7)';

    // Récupération sécurisée de la collection PHP translatée en JSON
    const logs = {!! json_encode($energyLogs) !!};
    
    const deviceMetrics = {};
    const timelineMetrics = {};

    logs.forEach(log => {
        const dName = log.device ? log.device.nom : 'Inconnu';
        const valKwh = parseFloat(log.consumption_kwh || log.consumption || 0);
        const valCo2 = parseFloat(log.emission_co2_kg || (valKwh * 0.7));

        // Groupement pour le diagramme en barres
        deviceMetrics[dName] = (deviceMetrics[dName] || 0) + valKwh;

        // Groupement par date pour l'évolution
        if (log.date_debut) {
            const dateObj = new Date(log.date_debut);
            const keyLabel = dateObj.toLocaleDateString('fr-FR', { month: 'short', year: '2-digit' });
            timelineMetrics[keyLabel] = (timelineMetrics[keyLabel] || 0) + valCo2;
        }
    });

    // --- GRAPHIQUE 1 : REPARTITION (BARS) ---
    const ctxBar = document.getElementById('deviceChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: Object.keys(deviceMetrics).length ? Object.keys(deviceMetrics) : ['Aucun matériel'],
            datasets: [{
                label: 'Consommation',
                data: Object.values(deviceMetrics).length ? Object.values(deviceMetrics) : [0],
                backgroundColor: 'rgba(52, 211, 153, 0.2)',
                borderColor: '#34d399',
                borderWidth: 2,
                borderRadius: 6,
                hoverBackgroundColor: 'rgba(52, 211, 153, 0.45)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.6)' } },
                y: { grid: { color: 'rgba(255,255,255,0.06)' }, ticks: { color: 'rgba(255,255,255,0.6)' } }
            }
        }
    });

    // --- GRAPHIQUE 2 : EVOLUTION TEMPORELLE (LINE) ---
    const ctxLine = document.getElementById('trendChart').getContext('2d');
    const co2Glow = ctxLine.createLinearGradient(0, 0, 0, 220);
    co2Glow.addColorStop(0, 'rgba(247, 150, 22, 0.25)');
    co2Glow.addColorStop(1, 'rgba(247, 150, 22, 0.0)');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: Object.keys(timelineMetrics).length ? Object.keys(timelineMetrics) : ['Pas de données'],
            datasets: [{
                data: Object.values(timelineMetrics).length ? Object.values(timelineMetrics) : [0],
                borderColor: '#f79616',
                backgroundColor: co2Glow,
                borderWidth: 3,
                tension: 0.38,
                fill: true,
                pointBackgroundColor: '#f79616',
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.6)' } },
                y: { grid: { color: 'rgba(255,255,255,0.06)' }, ticks: { color: 'rgba(255,255,255,0.6)' } }
            }
        }
    });
});
</script>
</body>
</html>