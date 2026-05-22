<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Green IT — Tableau de Bord</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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

/* ── PAGE: full-screen centered ── */
html, body {
    font-family: 'Exo 2', sans-serif;
    color: var(--text-1);
    height: 100vh;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    display: flex;
    align-items: center;
    justify-content: center;
    /* background image from Laravel */
    background-image: url('{{ asset("images/img.jfif") }}');
    background-size: cover;
    background-position: center;
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
.shell {
    position: relative;
    z-index: 1;
    display: flex;
    width:  min(1380px, 85vw);
    height: min(860px,  85vh);
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
    overflow: hidden;
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
    min-width: 0;
}

/* ── TOP BAR ── */
.topbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 24px;
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
    font-family:'Rajdhani',sans-serif; font-size:10px; font-weight:700;
    color:var(--green-bright); text-transform:uppercase; letter-spacing:0.10em;
    margin-bottom:8px; display:flex; align-items:center; gap:5px;
}
.gauge-wrap { position:relative; width:150px; height:90px; }
.gauge-svg { overflow:visible; }
.gauge-bg-arc { fill:none; stroke:rgba(16,185,129,0.10); stroke-width:9; stroke-linecap:round; }
.gauge-arc    { fill:none; stroke:url(#gaugeGrad); stroke-width:9; stroke-linecap:round; transition:stroke-dasharray 1.4s cubic-bezier(.4,0,.2,1); }
.gauge-needle { transform-origin:75px 75px; transition:transform 1.4s cubic-bezier(.4,0,.2,1); }
.gauge-value {
    position:absolute; bottom:0; left:50%; transform:translateX(-50%);
    font-family:'Rajdhani',sans-serif; font-size:28px; font-weight:700;
    color:var(--green-bright); text-shadow:0 0 18px var(--green-glow); line-height:1;
}
.gauge-pct { font-size:12px; font-weight:500; color:var(--text-2); margin-left:1px; }
.gauge-range { display:flex; justify-content:space-between; width:150px; font-size:8px; color:var(--text-3); margin-top:3px; }

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
    flex:1; padding-bottom:16px; position:relative;
}
.co2-chart::after { content:''; position:absolute; bottom:16px; left:0; right:0; height:1px; background:var(--border-dim); }
.co2-bar-group { display:flex; flex-direction:column; align-items:center; gap:3px; flex:1; }
.co2-bar-wrap { width:100%; display:flex; align-items:flex-end; justify-content:center; flex:1; }
.co2-bar {
    width:70%; max-width:18px; border-radius:3px 3px 0 0;
    background:linear-gradient(180deg, var(--green-bright), var(--green-dark));
    transition:height 1.2s cubic-bezier(.4,0,.2,1); min-height:3px; position:relative;
}
.co2-bar::after { content:''; position:absolute; top:0; left:0; right:0; height:6px; background:linear-gradient(180deg,rgba(255,255,255,0.18),transparent); border-radius:3px 3px 0 0; }
.co2-bar-label { font-size:7px; color:var(--text-3); text-align:center; white-space:nowrap; }

/* ── DONUT ── */
.donut-wrap { display:flex; align-items:center; gap:14px; flex:1; }
.donut-svg-wrap { position:relative; flex-shrink:0; }
.donut-center { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; }
.donut-center-val { font-family:'Rajdhani',sans-serif; font-size:20px; font-weight:700; color:var(--text-1); line-height:1; }
.donut-center-sub { font-size:7px; color:var(--text-3); text-transform:uppercase; }
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
</style>
</head>
<body>

<!-- ══════════════════════════════════════════════════════ -->
<!--  FLOATING CENTERED SHELL                              -->
<!-- ══════════════════════════════════════════════════════ -->
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
                <a href="{{ route('dashboard') }}" class="nav-item active" title="Dashboard">
                    <i class="ph ph-squares-four"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('devices.index') }}" class="nav-item" title="Parc informatique">
                    <i class="ph ph-desktop"></i><span>Parc informatique</span>
                </a>
                <a href="{{ route('energy.index') }}" class="nav-item" title="Consommation">
                    <i class="ph ph-lightning"></i><span>Consommation</span>
                </a>
                <a href="{{ route('devices.remplacer') }}" class="nav-item" title="Alertes">
                    <i class="ph ph-warning"></i><span>Alertes</span>
                    @if($kpis['a_remplacer'] > 0)
                        <span class="nav-badge">{{ $kpis['a_remplacer'] }}</span>
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
                <i class="ph ph-leaf"></i>
                Projet Green IT — Tableau de Bord
            </div>
            <div class="topbar-right">
                <button class="tb-btn" title="Paramètres"><i class="ph ph-sliders"></i></button>
                <button class="tb-btn" title="Profil"><i class="ph ph-user-circle"></i></button>
                <div class="tb-date">
                    <i class="ph ph-calendar-blank"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="dash-body">

            <!-- KPI STRIP -->
            <div class="kpi-strip">
                <div class="kpi kpi-eqp">
                    <div class="kpi-head"><span class="kpi-label">Équipements</span><div class="kpi-ico"><i class="ph ph-desktop"></i></div></div>
                    <div class="kpi-val">{{ $kpis['total_devices'] }}</div>
                    <div class="kpi-foot"><i class="ph ph-trend-up"></i> Total actif</div>
                </div>
                <div class="kpi kpi-kwh">
                    <div class="kpi-head"><span class="kpi-label">Consommation</span><div class="kpi-ico"><i class="ph ph-lightning"></i></div></div>
                    <div class="kpi-val">{{ number_format($kpis['total_conso'],0,',',' ') }}<span class="kpi-unit">kWh</span></div>
                    <div class="kpi-foot"><i class="ph ph-trend-up"></i> Annuel</div>
                </div>
                <div class="kpi kpi-co2">
                    <div class="kpi-head"><span class="kpi-label">Émissions CO₂</span><div class="kpi-ico"><i class="ph ph-cloud"></i></div></div>
                    <div class="kpi-val">{{ number_format($kpis['total_co2'],0,',',' ') }}<span class="kpi-unit">kg</span></div>
                    <div class="kpi-foot"><i class="ph ph-trend-down"></i> Usage</div>
                </div>
                <div class="kpi kpi-fab">
                    <div class="kpi-head"><span class="kpi-label">Fabrication</span><div class="kpi-ico"><i class="ph ph-factory"></i></div></div>
                    <div class="kpi-val">{{ number_format($kpis['total_fab_co2'],0,',',' ') }}<span class="kpi-unit">kg</span></div>
                    <div class="kpi-foot"><i class="ph ph-trend-down"></i> Embodied</div>
                </div>
                <div class="kpi kpi-sc">
                    <div class="kpi-head"><span class="kpi-label">Score Green</span><div class="kpi-ico"><i class="ph ph-chart-bar"></i></div></div>
                    <div class="kpi-val">{{ $kpis['score_moyen'] }}<span class="kpi-unit">/100</span></div>
                    <div class="kpi-foot"><i class="ph ph-trend-up"></i> Moyenne</div>
                </div>
                <div class="kpi kpi-alr">
                    <div class="kpi-head"><span class="kpi-label">Alertes</span><div class="kpi-ico"><i class="ph ph-warning"></i></div></div>
                    <div class="kpi-val">{{ $kpis['a_remplacer'] }}</div>
                    <div class="kpi-foot"><i class="ph ph-warning-circle"></i> À remplacer</div>
                </div>
            </div>

            <!-- MAIN GRID: CO2 | Gauge | Donut -->
            <div class="grid-main">

                <!-- CO2 par mois -->
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="ph ph-chart-bar"></i> Émissions CO₂ par mois (kg)</div>
                    </div>
                    <div class="card-body">
                        @php
                            $co2Mois = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];
                            $co2Var  = [1.05,1.08,1.10,1.00,0.95,0.88,0.90,0.92,0.97,1.02,1.08,1.15];
                            $co2Base = ($kpis['total_co2'] ?? 1500) / 12;
                            $co2Data = []; $maxCo2 = 0;
                            foreach($co2Mois as $i => $m){
                                $v = round($co2Base * $co2Var[$i]);
                                $co2Data[] = ['m'=>$m,'v'=>$v];
                                if($v>$maxCo2) $maxCo2=$v;
                            }
                        @endphp
                        <div class="co2-chart">
                            @foreach($co2Data as $d)
                            <div class="co2-bar-group">
                                <div class="co2-bar-wrap">
                                    <div class="co2-bar" style="height:0%;" data-height="{{ $maxCo2>0?round(($d['v']/$maxCo2)*100):0 }}%"></div>
                                </div>
                                <span class="co2-bar-label">{{ $d['m'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Gauge -->
                <div class="center-col">
                    <div class="gauge-card">
                        <div class="gauge-title"><i class="ph ph-leaf"></i> Score Green IT (%)</div>
                        <div class="gauge-wrap">
                            <svg class="gauge-svg" viewBox="0 0 150 90" width="150" height="90">
                                <defs>
                                    <linearGradient id="gaugeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#059669"/>
                                        <stop offset="100%" stop-color="#34d399"/>
                                    </linearGradient>
                                </defs>
                                <path class="gauge-bg-arc" d="M 15 75 A 57 57 0 0 1 135 75"/>
                                <path class="gauge-arc" id="gaugeArc" d="M 15 75 A 57 57 0 0 1 135 75" stroke-dasharray="0 179"/>
                                <g id="gaugeNeedle" style="transform:rotate(-90deg); transform-origin:75px 75px;">
                                    <line x1="75" y1="75" x2="75" y2="26" stroke="var(--green-bright)" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="75" cy="75" r="4" fill="var(--green-bright)"/>
                                </g>
                            </svg>
                            <div class="gauge-value" id="gaugeVal">{{ $kpis['score_moyen'] }}<span class="gauge-pct">%</span></div>
                        </div>
                        <div class="gauge-range"><span>0</span><span>100</span></div>
                    </div>
                    <div class="score-mini-grid">
                        <div class="score-mini">
                            <div class="score-mini-val">{{ $kpis['total_devices'] }}</div>
                            <div class="score-mini-label">Équipements</div>
                        </div>
                        <div class="score-mini">
                            <div class="score-mini-val">{{ $kpis['a_remplacer'] }}</div>
                            <div class="score-mini-label">Alertes</div>
                        </div>
                    </div>
                </div>

                <!-- Donut Sources -->
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="ph ph-chart-pie-slice"></i> Sources d'énergie</div>
                    </div>
                    <div class="card-body">
                        @php
                            $total2 = $parType->sum('count');
                            $dColors = ['#10b981','#3b82f6','#f59e0b','#8b5cf6','#06b6d4','#ec4899'];
                            $offset2 = 25;
                        @endphp
                        <div class="donut-wrap">
                            <div class="donut-svg-wrap">
                                <svg viewBox="0 0 36 36" width="100" height="100">
                                    <circle cx="18" cy="18" r="15.915" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="3.5"/>
                                    @foreach($parType as $idx => $type)
                                    @php
                                        $pct3 = $total2>0?($type->count/$total2)*100:0;
                                        $dash3 = $pct3*0.942;
                                        $c3 = $dColors[$idx%count($dColors)];
                                    @endphp
                                    <circle cx="18" cy="18" r="15.915" fill="none" stroke="{{ $c3 }}" stroke-width="3.5"
                                        stroke-dasharray="{{ $dash3 }} 100" stroke-dashoffset="{{ -$offset2 }}" stroke-linecap="round"/>
                                    @php $offset2+=$dash3; @endphp
                                    @endforeach
                                    <circle cx="18" cy="18" r="12" fill="rgba(4,12,20,0.85)"/>
                                </svg>
                                <div class="donut-center">
                                    <div class="donut-center-val">{{ $total2 }}</div>
                                    <div class="donut-center-sub">Total</div>
                                </div>
                            </div>
                            <div class="donut-legend">
                                @foreach($parType as $idx => $type)
                                @php $pct4 = $total2>0?round(($type->count/$total2)*100,1):0; $c4=$dColors[$idx%count($dColors)]; @endphp
                                <div class="dl-item">
                                    <div class="dl-dot" style="background:{{ $c4 }}; box-shadow:0 0 5px {{ $c4 }};"></div>
                                    <div class="dl-info">
                                        <span class="dl-name">{{ $type->type }}</span>
                                        <span class="dl-pct">{{ $pct4 }}%</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /grid-main -->

            <!-- BOTTOM GRID: Monthly | Table -->
            <div class="grid-bottom">

                @php
    $linePoints = [];
    $lineW = 520; $lineH = 130; $padL = 30; $padR = 10; $padT = 10; $padB = 22;
    $chartW = $lineW - $padL - $padR;
    $chartH = $lineH - $padT - $padB;
    $minCost = collect($mData)->min('cost');
    $maxCost = collect($mData)->max('cost');
    $range = $maxCost - $minCost ?: 1;
    foreach($mData as $i => $d) {
        $x = $padL + ($i / 11) * $chartW;
        $y = $padT + $chartH - (($d['cost'] - $minCost) / $range) * $chartH;
        $linePoints[] = ['x'=>round($x,1), 'y'=>round($y,1), 'm'=>$d['m'], 'cost'=>$d['cost'], 'kwh'=>$d['kwh']];
    }
    $pathD = 'M '.$linePoints[0]['x'].','.$linePoints[0]['y'];
    for($i=1; $i<count($linePoints); $i++) {
        $cpx1 = ($linePoints[$i-1]['x'] + $linePoints[$i]['x']) / 2;
        $pathD .= ' C '.$cpx1.','.$linePoints[$i-1]['y'].' '.$cpx1.','.$linePoints[$i]['y'].' '.$linePoints[$i]['x'].','.$linePoints[$i]['y'];
    }
    $areaD = $pathD.' L '.$linePoints[count($linePoints)-1]['x'].','.($padT+$chartH).' L '.$linePoints[0]['x'].','.($padT+$chartH).' Z';
@endphp

<div class="line-chart-container">
    <div class="line-tooltip" id="lineTooltip"></div>
    <svg class="line-chart-svg" viewBox="0 0 {{ $lineW }} {{ $lineH }}" preserveAspectRatio="none">
        <defs>
            <linearGradient id="lineGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%"   stop-color="#059669"/>
                <stop offset="50%"  stop-color="#34d399"/>
                <stop offset="100%" stop-color="#06b6d4"/>
            </linearGradient>
            <linearGradient id="lineAreaGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%"   stop-color="#10b981" stop-opacity="0.35"/>
                <stop offset="100%" stop-color="#10b981" stop-opacity="0"/>
            </linearGradient>
        </defs>

        {{-- Grid lines horizontales --}}
        @for($g=0; $g<=4; $g++)
        @php $gy = $padT + ($g/4)*$chartH; @endphp
        <line class="line-grid" x1="{{ $padL }}" y1="{{ $gy }}" x2="{{ $lineW-$padR }}" y2="{{ $gy }}"/>
        @endfor

        {{-- Aire sous la courbe --}}
        <path class="line-area" d="{{ $areaD }}"/>

        {{-- Courbe principale --}}
        <path class="line-path" id="linePath" d="{{ $pathD }}"/>

        {{-- Points + labels mois --}}
        @foreach($linePoints as $i => $pt)
        <circle class="line-dot" id="dot-{{ $i }}"
            cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="3.5"
            data-cost="{{ number_format($pt['cost'],0,',',' ') }}"
            data-kwh="{{ number_format($pt['kwh'],0,',',' ') }}"
            data-mois="{{ $pt['m'] }}"/>
        <text class="line-axis-label" x="{{ $pt['x'] }}" y="{{ $lineH - 4 }}" text-anchor="middle">{{ $pt['m'] }}</text>
        @endforeach
    </svg>
</div>
                <!-- État équipements / alertes -->
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="ph ph-list-checks"></i> État des équipements</div>
                        @if($alertes->count()>0)
                        <a href="{{ route('devices.remplacer') }}" style="font-size:10px;color:var(--amber);text-decoration:none;font-weight:600;">Voir tout →</a>
                        @endif
                    </div>
                    <div class="card-body" style="padding:7px 9px;">
                        @php $allDevices = $topConso->merge($worstScore)->unique('id'); @endphp
                        @if($allDevices->count()>0)
                        <table class="srv-table">
                            <thead>
                                <tr><th>Équipement</th><th>kWh</th><th>Score</th><th>Statut</th></tr>
                            </thead>
                            <tbody>
                                @foreach($allDevices->take(8) as $dev)
                                @php
                                    $sc = $dev->score_green_it ?? 0;
                                    $sCls = $sc>=70?'score-hi':($sc>=40?'score-mid':'score-lo');
                                    $age = $dev->date_achat ? now()->diffInYears($dev->date_achat) : null;
                                    $isAl = $dev->statut==='recycle'||($age!==null&&$dev->duree_vie_annees&&$age>=$dev->duree_vie_annees);
                                @endphp
                                <tr>
                                    <td class="srv-name">{{ Str::limit($dev->nom,18) }}</td>
                                    <td>{{ number_format($dev->conso_annuelle_kwh??0,0,',',' ') }}</td>
                                    <td><span class="score-pill {{ $sCls }}">{{ $sc }}</span></td>
                                    <td>
                                        @if($isAl)
                                            <span style="color:var(--red);font-size:9px;font-weight:600;"><i class="ph ph-warning"></i> Alerte</span>
                                        @else
                                            <span style="color:var(--green-primary);font-size:9px;font-weight:600;"><i class="ph ph-check-circle"></i> OK</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif($alertes->count()>0)
                        <div class="alert-list">
                            @foreach($alertes as $dev)
                            @php $r=[]; if($dev->statut==='recycle')$r[]='À recycler'; $a2=$dev->date_achat?now()->diffInYears($dev->date_achat):null; if($a2!==null&&$dev->duree_vie_annees&&$a2>=$dev->duree_vie_annees)$r[]='Âge dépassé'; @endphp
                            <a href="{{ route('devices.edit',$dev) }}" class="alert-item">
                                <div class="alert-icon"><i class="ph ph-warning"></i></div>
                                <div class="alert-info">
                                    <div class="alert-name">{{ $dev->nom }}</div>
                                    <div class="alert-reason">{{ implode(' + ',$r)?:'À remplacer' }}</div>
                                </div>
                                <i class="ph ph-caret-right alert-arrow"></i>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <div class="empty-ok"><i class="ph ph-check-circle"></i><span>Aucune alerte</span></div>
                        @endif
                    </div>
                </div>

            </div><!-- /grid-bottom -->

        </div><!-- /dash-body -->
    </div><!-- /main -->
</div><!-- /shell -->

<script>
// SIDEBAR TOGGLE
const sidebar = document.getElementById('sidebar');
const toggle  = document.getElementById('sidebarToggle');
const icon    = toggle.querySelector('i');
if(localStorage.getItem('sbCollapsed')==='true'){ sidebar.classList.add('collapsed'); icon.classList.replace('ph-caret-left','ph-caret-right'); }
toggle.addEventListener('click',()=>{
    sidebar.classList.toggle('collapsed');
    const c = sidebar.classList.contains('collapsed');
    icon.classList.replace(c?'ph-caret-left':'ph-caret-right', c?'ph-caret-right':'ph-caret-left');
    localStorage.setItem('sbCollapsed', c);
});

// ANIMATIONS
document.addEventListener('DOMContentLoaded',()=>{
    const score = {{ $kpis['score_moyen'] }};

    // Gauge
    const arc    = document.getElementById('gaugeArc');
    const needle = document.getElementById('gaugeNeedle');
    const totalArc = 179;
    const pct = Math.min(Math.max(score/100,0),1);
    setTimeout(()=>{
        arc.style.strokeDasharray = (pct*totalArc)+' '+totalArc;
        needle.style.transform = `rotate(${-90+pct*180}deg)`;
    },300);

    // CO2 bars
    setTimeout(()=>{
        document.querySelectorAll('.co2-bar[data-height]').forEach(b=>{ b.style.height=b.dataset.height; });
    },200);

    // ✅ NOUVEAU — animation courbe
setTimeout(()=>{
    const path = document.getElementById('linePath');
    if(path) {
        const len = path.getTotalLength();
        path.style.strokeDasharray = len;
        path.style.strokeDashoffset = len;
        setTimeout(()=>{ path.style.strokeDashoffset = 0; }, 100);
    }
    // Apparition des points
    document.querySelectorAll('.line-dot').forEach((dot, i)=>{
        setTimeout(()=>{ dot.style.opacity = 1; }, 400 + i * 120);
    });
    // Tooltip au survol
    const tooltip = document.getElementById('lineTooltip');
    document.querySelectorAll('.line-dot').forEach(dot=>{
        dot.addEventListener('mouseenter', e=>{
            tooltip.innerHTML = `<b>${dot.dataset.mois}</b><br>${dot.dataset.cost} DH<br>${dot.dataset.kwh} kWh`;
            tooltip.style.opacity = 1;
        });
        dot.addEventListener('mousemove', e=>{
            const rect = e.target.closest('.line-chart-container').getBoundingClientRect();
            tooltip.style.left = (e.clientX - rect.left + 10)+'px';
            tooltip.style.top  = (e.clientY - rect.top - 40)+'px';
        });
        dot.addEventListener('mouseleave', ()=>{ tooltip.style.opacity = 0; });
    });
}, 500);
</script>
</body>
</html>