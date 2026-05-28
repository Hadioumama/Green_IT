<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $device->nom }} — Détails | Green IT</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icônes Phosphor -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/devices-show.css') }}">
     <style>
/* ═══════════════════════════════════════════════════════ */
/*  GREEN IT DASHBOARD v3 — Centered Floating Glass Card   */
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

    --r:      14px;
    --r-lg:   22px;
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

/* ── PAGE: Autorise désormais le défilement si le contenu dépasse ── */
html, body {
    font-family: 'Exo 2', sans-serif;
    color: var(--text-1);
    min-height: 100vh;                 /* Changé de height à min-height */
    overflow-y: auto;                  /* ✅ REPASSE EN AUTO POUR ACTIVER LE SCROLL */
    -webkit-font-smoothing: antialiased;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 0;                   /* Ajoute un espace de confort en haut et en bas */
    /* background image from Laravel */
    background-image: url('{{ asset("images/img.jfif") }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;      /* Bloque le fond pour un effet visuel propre pendant le scroll */
}

/* Overlay tint — léger pour laisser l'image visible */
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

/* ── OUTER SHELL — the floating card ── */
/* ── OUTER SHELL — Adaptable en hauteur ── */
.shell {
    position: relative;
    z-index: 1;
    display: flex;
    width:  min(1380px, 85vw);
    min-height: min(860px, 85vh);      /* Changé de height à min-height pour s'étirer si besoin */
    /* fond semi-transparent pour laisser l'image transparaître */
    background: rgba(143, 158, 151, 0.45);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    border-radius: var(--r-lg);
    border: 1px solid rgba(52,211,153,0.18);
    box-shadow:
        0 32px 80px rgba(0,0,0,0.45),
        0  0  40px rgba(16,185,129,0.06) inset,
        0  1px 0   rgba(255,255,255,0.12) inset;
    /* overflow: hidden; */            /* Supprimé pour ne plus masquer le bas de la carte */
    animation: shellIn 0.8s cubic-bezier(.4,0,.2,1) both;
}

@keyframes shellIn {
    from { opacity:0; transform:scale(0.97) translateY(14px); }
    to   { opacity:1; transform:scale(1)    translateY(0); }
}

/* ── SIDEBAR ── */
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
    background:#10b981; color:white;
    cursor:pointer; font-size:12px; font-weight:500;
    text-decoration:none; width:100%; transition:all 0.2s;
}
.btn-logout:hover { background:#10b981; color:var(--red); }
.btn-logout i { font-size:16px; flex-shrink:0; }
.sidebar.collapsed .btn-logout { width:40px; padding:10px; justify-content:center; }
.sidebar.collapsed .btn-logout span { display:none; }

/* ── MAIN COLUMN ── */
.main {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    min-width: 0px;
}

/* ── TOP BAR ── */
.topbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 2px 24px;
    min-height:20px;
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
.tb-btn {
    width:34px; height:34px; border-radius:9px; border:1px solid var(--border-dim);
    background:var(--bg-inner); color:var(--text-2);
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; font-size:16px; transition:all 0.2s;
}
.tb-btn:hover { background:var(--bg-hover); color:var(--green-bright); border-color:var(--border); }
.tb-date {
    display:flex; align-items:center; gap:7px;
    padding:6px 12px; border:1px solid var(--border-dim);
    border-radius:9px; background:var(--bg-inner);
    font-size:11px; color:var(--text-2);
}
.tb-date i { color:var(--green-primary); font-size:14px; }

/* ── CONTENT AREA ── */
.dash-body {
    flex: 1;
    padding: 20px 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.dash-body::-webkit-scrollbar { width: 8px; }
.dash-body::-webkit-scrollbar-thumb { background: var(--border); border-radius: 5px; }

/* ── KPI STRIP ── */
.kpi-strip {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 9px;
    flex-shrink: 0;
    animation: fadeUp 0.5s ease both;
}

.kpi {
    background: rgba(255,255,255,0.055);
    border: 1px solid rgba(52,211,153,0.14);
    border-radius: var(--r);
    padding: 11px 13px;
    position: relative; overflow: hidden;
    transition: all 0.25s;
    backdrop-filter: blur(8px);
}
.kpi:hover { border-color:var(--border); transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.3); }
.kpi::after {
    content:''; position:absolute; top:-50%; right:-30%;
    width:70%; height:70%; border-radius:50%;
    filter:blur(26px); opacity:0.09; pointer-events:none;
}
.kpi-eqp::after { background:var(--blue); }
.kpi-kwh::after { background:var(--green-primary); }
.kpi-co2::after { background:var(--amber); }
.kpi-fab::after { background:var(--purple); }
.kpi-sc::after  { background:var(--cyan); }
.kpi-alr::after { background:var(--red); }

.kpi-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:7px; }
.kpi-label { font-size:10px; font-weight:1000; text-transform:uppercase; letter-spacing:0.08em; color:var(--text-3); }
.kpi-ico { width:30px; height:30px; border-radius:7px; display:flex; align-items:center; justify-content:center; font-size:25px; }
.kpi-eqp .kpi-ico { background:rgba(59,130,246,0.13); color:var(--blue); }
.kpi-kwh .kpi-ico { background:var(--green-soft); color:var( --green-softt); }
.kpi-co2 .kpi-ico { background:rgba(245,158,11,0.11); color:var(--amber); }
.kpi-fab .kpi-ico { background:rgba(139,92,246,0.11); color:var(--purple); }
.kpi-sc  .kpi-ico { background:rgba(6,182,212,0.11); color:var(--cyan); }
.kpi-alr .kpi-ico { background:rgba(239,68,68,0.11); color:var(--red); }
.kpi-val { font-family:'Rajdhani',sans-serif; font-size:24px; font-weight:700; color:var(--text-1); line-height:1; letter-spacing:-0.01em; }
.kpi-unit { font-size:12px; font-weight:500; color:var(--text-1); margin-left:2px; }
.kpi-foot { display:flex; align-items:center; gap:3px; margin-top:5px; font-size:12px; color:var(--text-3);font-weight:600; }
.kpi-foot i { font-size:20px; }

/* ── MAIN GRID: 3 columns ── */
.grid-main {
    display: grid;
    grid-template-columns: 1fr 185px 1fr;
    gap: 12px;
    flex-shrink: 0;
    animation: fadeUp 0.5s 0.08s ease both;
}

/* ── CARD ── */
.card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(52,211,153,0.13);
    border-radius: var(--r);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex; flex-direction: column; overflow: hidden;
    transition: border-color 0.2s;
}
.card:hover { border-color: var(--border); }
.card-head {
    display:flex; justify-content:space-between; align-items:center;
    padding: 9px 13px; border-bottom:1px solid var(--border-dim); flex-shrink:0;
}
.card-title {
    display:flex; align-items:center; gap:6px;
    font-family:'Rajdhani',sans-serif; font-size:11px; font-weight:700;
    color:var(--green-bright); text-transform:uppercase; letter-spacing:0.07em;
}
.card-title i { font-size:14px; }
.card-body { flex:1; padding:11px 13px; display:flex; flex-direction:column; min-height:0; }

/* ── CENTER GAUGE ── */
.center-col {
    display: flex; flex-direction: column; gap: 10px;
}
.gauge-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(52,211,153,0.13);
    border-radius: var(--r);
    backdrop-filter: blur(10px);
    padding: 12px 10px;
    display: flex; flex-direction: column; align-items: center;
}
.gauge-card:hover { border-color: var(--border); }
.gauge-title {
    font-family:'Rajdhani',sans-serif; font-size:15px; font-weight:700;
    color:var(--green-bright); text-transform:uppercase; letter-spacing:0.10em;
    margin-bottom:8px; display:flex; align-items:center; gap:5px;
}
.gauge-wrap { position:relative; width:185px; height:100px; }
.gauge-svg { overflow:visible; }
.gauge-bg-arc { fill:none; stroke:rgba(16,185,129,0.10); stroke-width:8; stroke-linecap:round; }
.gauge-arc    { fill:none; stroke:url(#gaugeGrad); stroke-width:8; stroke-linecap:round; transition:stroke-dasharray 1.4s cubic-bezier(.4,0,.2,1); }
.gauge-needle { transform-origin:75px 75px; transition:transform 1.4s cubic-bezier(.4,0,.2,1); }
.gauge-value {
    position:absolute; bottom:-30px; left:50%; transform:translateX(-50%);
    font-family:'Rajdhani',sans-serif; font-size:28px; font-weight:900;
    color:var(--green-bright); text-shadow:0 0 18px var(--green-glow);
}
.gauge-pct { font-size:10px; font-weight:600; color:var(--green-bright); margin-left:1px; }
.gauge-range { display:flex; justify-content:space-between; width:150px; font-size:15px;font-weight:700; color:var(--text-3); margin-top:3px; }

.score-mini-grid { display:grid; grid-template-columns:1fr 1fr; gap:6px; width:100%; }
.score-mini {
    background:rgba(255,255,255,0.03); border:1px solid var(--border-dim);
    border-radius:8px; padding:7px 9px; text-align:center;
}
.score-mini-val { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text-1); line-height:1; }
.score-mini-label { font-size:8px; color:var(--text-3); text-transform:uppercase; letter-spacing:0.06em; margin-top:2px; }

/* ── CO2 BARS ── */

.co2-chart {
    display:flex; align-items:flex-end; gap:5px;
    height: 130px;        /* ← hauteur fixe totale */
    padding-bottom:16px; 
    position:relative;
}
.co2-chart::after { content:''; position:absolute; bottom:16px; left:0; right:0; height:1px; background:var(--border-dim); }
.co2-bar-group { display:flex; flex-direction:column; align-items:center; gap:3px; flex:1; }
.co2-bar-wrap { width:100%; display:flex; align-items:flex-end; justify-content:center; height: 100px; }
.co2-bar {
    width:70%; max-width:18px; border-radius:3px 3px 0 0;
    background:linear-gradient(180deg, var(--green-bright), var(--green-dark));
    transition:height 1.2s cubic-bezier(.4,0,.2,1); min-height:3px; position:relative;
}
.co2-bar::after { content:''; position:absolute; top:0; left:0; right:0; height:6px; background:linear-gradient(180deg,rgba(255,255,255,0.18),transparent); border-radius:3px 3px 0 0; }
.co2-bar-label { font-size:9px;font-weight:800; color:var(--text-3); text-align:center; white-space:nowrap; }

/* ── DONUT ── */
.donut-wrap { display:flex; align-items:center;justify-content:center;; gap:14px; flex:1; }
.donut-svg-wrap { position:relative; flex-shrink:0; }
.donut-center { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; }
.donut-center-val { font-family:'Rajdhani',sans-serif; font-size:20px; font-weight:700; color:var(--text-1); line-height:1; }
.donut-center-sub { font-size:9px; color:white; text-transform:uppercase; }
.donut-legend { display:flex; flex-direction:column; gap:6px; flex:1; }
.dl-item { display:flex; align-items:center; gap:7px; }
.dl-dot { width:8px; height:8px; border-radius:3px; flex-shrink:0; }
.dl-info { display:flex; flex-direction:column; flex:1; }
.dl-name { font-size:9px; color:var(--text-2); }
.dl-pct  { font-size:11px; font-weight:700; color:var(--text-1); font-family:'Rajdhani',sans-serif; }

/* ── BOTTOM GRID ── */
.grid-bottom {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    flex-shrink: 0;
    animation: fadeUp 0.5s 0.16s ease both;
}

/* ── LINE CHART CURVE ── */
.line-chart-container {
    position: relative;
    width: 100%;
    flex: 1;
    min-height: 140px;
}
.line-chart-svg {
    width: 100%;
    height: 100%;
    overflow: visible;
}
.line-grid { stroke: rgba(255,255,255,0.05); stroke-width: 1; }
.line-axis-label { font-size: 8px; fill: var(--text-3); font-family: 'Exo 2', sans-serif; }
.line-area { fill: url(#lineAreaGrad); opacity: 0.5; }
.line-path {
    fill: none;
    stroke: url(#lineGrad);
    stroke-width: 2.5;
    stroke-linecap: round;
    stroke-linejoin: round;
    filter: drop-shadow(0 0 6px rgba(16,185,129,0.6));
    stroke-dasharray: 1000;
    stroke-dashoffset: 1000;
    transition: stroke-dashoffset 2s cubic-bezier(.4,0,.2,1);
}
.line-dot {
    fill: var(--green-bright);
    filter: drop-shadow(0 0 4px rgba(52,211,153,0.8));
    opacity: 0;
    transition: opacity 0.3s;
    cursor: pointer;
}
.line-dot:hover { r: 5; }
.line-tooltip {
    position: absolute;
    background: rgba(4,18,12,0.92);
    border: 1px solid var(--border);
    border-radius: 7px;
    padding: 5px 9px;
    font-size: 10px;
    color: var(--text-1);
    pointer-events: none;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.2s;
    z-index: 10;
}
/* ── SERVER TABLE ── */
.srv-table { width:100%; border-collapse:collapse; }
.srv-table th { font-size:8px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--text-3); padding:4px 7px; border-bottom:1px solid var(--border-dim); text-align:left; background:rgba(16,185,129,0.04); }
.srv-table td { padding:5px 7px; font-size:10px; color:var(--text-2); border-bottom:1px solid rgba(255,255,255,0.03); }
.srv-table tr:last-child td { border-bottom:none; }
.srv-table tr:hover td { background:var(--bg-hover); color:var(--text-1); }
.srv-name { font-weight:600; color:var(--text-1) !important; }
.score-pill { display:inline-flex; align-items:center; justify-content:center; min-width:26px; padding:1px 5px; border-radius:4px; font-size:9px; font-weight:700; font-family:'Rajdhani',sans-serif; }
.score-hi  { background:rgba(16,185,129,0.14); color:var(--green-bright); }
.score-mid { background:rgba(245,158,11,0.14); color:var(--amber); }
.score-lo  { background:rgba(239,68,68,0.14);  color:var(--red); }

/* ── ALERT LIST ── */
.alert-list { display:flex; flex-direction:column; gap:5px; }
.alert-item { display:flex; align-items:center; gap:8px; padding:7px 9px; background:rgba(239,68,68,0.05); border:1px solid rgba(239,68,68,0.12); border-radius:9px; text-decoration:none; transition:all 0.2s; }
.alert-item:hover { background:rgba(239,68,68,0.09); border-color:rgba(239,68,68,0.22); transform:translateX(3px); }
.alert-icon { width:28px; height:28px; border-radius:7px; background:rgba(239,68,68,0.12); display:flex; align-items:center; justify-content:center; color:var(--red); font-size:14px; flex-shrink:0; }
.alert-info { flex:1; overflow:hidden; }
.alert-name { font-size:11px; font-weight:600; color:var(--text-1); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.alert-reason { font-size:9px; color:var(--amber); }
.alert-arrow { color:var(--text-3); font-size:12px; transition:all 0.2s; }
.alert-item:hover .alert-arrow { color:var(--red); transform:translateX(2px); }
.empty-ok { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:6px; padding:16px; color:var(--green-bright); font-size:11px; }
.empty-ok i { font-size:26px; }

/* ── ANIMATIONS ── */
@keyframes fadeUp {
    from { opacity:0; transform:translateY(10px); }
    to   { opacity:1; transform:translateY(0); }
}
.page-wrapper {
    height: min(860px, 85vh); /* ✅ hauteur limitée */
}
.form-container {
    overflow-y: auto;          /* ✅ scroll activé */
    scrollbar-width: thin;     /* ✅ Firefox */
    scrollbar-color: var(--green-dark) rgba(255,255,255,0.04);
}
.form-container::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--green-bright), var(--green-dark));
}
</style>
</head>

<body>

<div class="page-wrapper">
    
    <!-- ═══════════════════════════════════════════════ -->
    <!-- HEADER : Navigation + Actions rapides -->
    <!-- ═══════════════════════════════════════════════ -->
    <header class="page-header">
        <div class="header-left">
            <a href="{{ route('devices.index') }}" class="btn btn-back">
                <i class="ph ph-arrow-left"></i> Retour à la liste
            </a>
            <div class="header-title">
                <h1>{{ $device->nom }}</h1>
                <div class="header-meta">
                    <span class="badge-type badge-{{ strtolower(str_replace(' ', '-', $device->type)) }}">
                        {{ $device->type }}
                    </span>
                    <span class="badge-status status-{{ $device->statut }}">
                        {{ match($device->statut) {
                            'actif' => 'Actif',
                            'stock' => 'Stock',
                            'en_reparation' => 'Réparation',
                            'hors_service' => 'Hors service',
                            'recycle' => 'À recycler',
                        } }}
                    </span>
                </div>
            </div>
        </div>
        <div class="header-actions">
            <a href="{{ route('devices.edit', $device) }}" class="btn btn-edit">
                <i class="ph ph-pencil"></i> Modifier
            </a>
            <form action="{{ route('devices.destroy', $device) }}" method="POST" class="inline-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete" onclick="return confirm('Supprimer « {{ $device->nom }} » ?')">
                    <i class="ph ph-trash"></i> Supprimer
                </button>
            </form>
        </div>
    </header>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- GRILLE PRINCIPALE : 2 colonnes -->
    <!-- ═══════════════════════════════════════════════ -->
    <div class="detail-grid">
        
        <!-- ═══════════════════════════════════════════════ -->
        <!-- COLONNE GAUCHE : Informations + Score -->
        <!-- ═══════════════════════════════════════════════ -->
        <div class="detail-column">
            
            <!-- Carte Identité -->
            <div class="detail-card card-identity">
                <div class="card-header">
                    <i class="ph ph-cpu"></i>
                    <h2>Identification</h2>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="info-label">Marque / Modèle</span>
                        <span class="info-value">{{ $device->marque ?? '—' }} {{ $device->modele ?? '' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Numéro de série</span>
                        <span class="info-value code">{{ $device->numero_serie }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date d'achat</span>
                        <span class="info-value">{{ $device->date_achat?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Âge</span>
                        <span class="info-value">{{ $device->age ? $device->age . ' ans' : '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Prix d'achat</span>
                        <span class="info-value">{{ $device->prix ? number_format($device->prix, 2) . ' MAD' : '—' }}</span>
                    </div>
                </div>
            </div>

            <!-- Carte Localisation -->
            <div class="detail-card card-location">
                <div class="card-header">
                    <i class="ph ph-map-pin"></i>
                    <h2>Localisation & Responsable</h2>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="info-label">Emplacement</span>
                        <span class="info-value">{{ $device->localisation ?? 'Non précisé' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Responsable</span>
                        <span class="info-value">
                            @if($device->user)
                                <div class="user-chip">
                                    <i class="ph ph-user"></i>
                                    <span>{{ $device->user->name }}</span>
                                    <small>{{ $device->user->email }}</small>
                                </div>
                            @else
                                <span class="text-muted">Non assigné</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Carte Description -->
            @if($device->description)
            <div class="detail-card card-description">
                <div class="card-header">
                    <i class="ph ph-text-align-left"></i>
                    <h2>Description</h2>
                </div>
                <div class="card-body">
                    <p class="description-text">{{ $device->description }}</p>
                </div>
            </div>
            @endif

        </div>

        <!-- ═══════════════════════════════════════════════ -->
        <!-- COLONNE DROITE : Énergie + CO₂ + Projections -->
        <!-- ═══════════════════════════════════════════════ -->
        <div class="detail-column">
            
            <!-- Score Green IT -->
            <div class="detail-card card-score">
                <div class="score-ring score-{{ $device->score_green_it >= 70 ? 'good' : ($device->score_green_it >= 40 ? 'medium' : 'bad') }}">
                    <div class="score-value">{{ $device->score_green_it }}</div>
                    <div class="score-label">Score Green IT</div>
                </div>
                <div class="score-details">
                    <div class="score-item">
                        <i class="ph ph-lightning"></i>
                        <span>Classe {{ $device->efficacite_energetique ?? 'Non classé' }}</span>
                    </div>
                    <div class="score-item">
                        <i class="ph ph-calendar"></i>
                        <span>Durée de vie : {{ $device->duree_vie_annees ?? '—' }} ans</span>
                    </div>
                </div>
            </div>

            <!-- Carte Consommation -->
            <div class="detail-card card-energy">
                <div class="card-header">
                    <i class="ph ph-lightning"></i>
                    <h2>Consommation Énergétique</h2>
                </div>
                <div class="card-body">
                    <div class="energy-highlight">
                        <div class="energy-big">
                            <span class="energy-number">{{ number_format($device->conso_annuelle_kwh ?? 0, 2) }}</span>
                            <span class="energy-unit">kWh/an</span>
                        </div>
                        <div class="energy-breakdown">
                            <span class="energy-detail">
                                <i class="ph ph-lightning-fill"></i>
                                {{ number_format($device->puissance_watt ?? 0, 0) }} W
                            </span>
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Coût énergie annuel</span>
                        <span class="info-value price">{{ number_format($projections['cout_energie_annuel'] ?? 0, 2) }} MAD</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Coût sur 5 ans</span>
                        <span class="info-value price">{{ number_format($projections['cout_energie_5ans'] ?? 0, 2) }} MAD</span>
                    </div>
                </div>
            </div>

            <!-- Carte Empreinte Carbone -->
            <div class="detail-card card-carbon">
                <div class="card-header">
                    <i class="ph ph-cloud"></i>
                    <h2>Empreinte Carbone</h2>
                </div>
                <div class="card-body">
                    <div class="carbon-grid">
                        <div class="carbon-item">
                            <i class="ph ph-cloud-arrow-up"></i>
                            <span class="carbon-label">Émissions annuelles</span>
                            <span class="carbon-value">{{ number_format($device->emission_co2_kg ?? 0, 2) }} kg CO₂</span>
                        </div>
                        <div class="carbon-item">
                            <i class="ph ph-factory"></i>
                            <span class="carbon-label">Fabrication</span>
                            <span class="carbon-value">{{ number_format($device->empreinte_carbone_fab ?? 0, 2) }} kg CO₂</span>
                        </div>
                        <div class="carbon-item">
                            <i class="ph ph-calendar-blank"></i>
                            <span class="carbon-label">Sur 5 ans</span>
                            <span class="carbon-value">{{ number_format($projections['emission_5ans'] ?? 0, 2) }} kg CO₂</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- SECTION BAS : Historique des mesures -->
    <!-- ═══════════════════════════════════════════════ -->
    <div class="detail-section">
        <div class="detail-card card-history">
            <div class="card-header">
                <i class="ph ph-chart-line-up"></i>
                <h2>Historique des mesures</h2>
                <span class="badge">{{ $device->energyLogs->count() }} mesures</span>
            </div>
            <div class="card-body">
                @if($device->energyLogs->count() > 0)
                    <div class="history-chart-wrapper">
                        <canvas id="historyChart"></canvas>
                    </div>
                    <div class="history-table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Période</th>
                                    <th>kWh</th>
                                    <th>kg CO₂</th>
                                    <th>Source</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($device->energyLogs->sortByDesc('date_debut') as $log)
                                <tr>
                                    <td>{{ $log->date_debut?->format('d/m/Y') ?? '—' }} → {{ $log->date_fin?->format('d/m/Y') ?? '—' }}</td>
                                    <td class="col-numeric">{{ number_format($log->consumption_kwh ?? $log->consumption ?? 0, 2) }}</td>
                                    <td class="col-numeric">{{ number_format($log->emission_co2_kg ?? 0, 2) }}</td>
                                    <td>
                                        <span class="badge-source source-{{ $log->source ?? 'mesure_reelle' }}">
                                            {{ match($log->source ?? 'mesure_reelle') {
                                                'mesure_reelle' => 'Mesure réelle',
                                                'estimation' => 'Estimation',
                                                'facture' => 'Facture',
                                                'api_carbon' => 'API Carbon',
                                                default => 'Mesure réelle'
                                            } }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ph ph-chart-line"></i>
                        <p>Aucune mesure enregistrée pour cet équipement</p>
                        <a href="{{ route('energy.create', ['device_id' => $device->id]) }}" class="btn btn-sm btn-primary">
                            <i class="ph ph-plus"></i> Ajouter une mesure
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- ═══════════════════════════════════════════════ -->
<!-- SCRIPT : Graphique d'historique -->
<!-- ═══════════════════════════════════════════════ -->
@if($device->energyLogs->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('historyChart').getContext('2d');
    
    const logs = {!! json_encode($device->energyLogs->sortBy('date_debut')->map(fn($l) => [
        'date' => $l->date_debut?->toDateString() ?? $l->date?->toDateString() ?? now()->toDateString(),
        'kwh' => (float) ($l->consumption_kwh ?? $l->consumption ?? 0)
    ])->values()) !!};
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: logs.map(l => {
                const d = new Date(l.date);
                return d.toLocaleDateString('fr-FR', {month: 'short', year: 'numeric'});
            }),
            datasets: [{
                label: 'Consommation (kWh)',
                data: logs.map(l => l.kwh),
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.3,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'kWh' }
                }
            }
        }
    });
});
</script>
@endif

</body>
</html>