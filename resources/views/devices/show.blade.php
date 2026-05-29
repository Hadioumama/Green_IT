<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $device->nom }} — Détails | Green IT</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
    /* ═══════════════════════════════════════════════════════ */
    /*  GREEN IT — Device Details (Glassmorphism Compact)      */
    /* ═══════════════════════════════════════════════════════ */
    
    :root {
        --green-primary:   #10b981;
        --green-bright:    #34d399;
        --green-dark:      #059669;
        --green-glow:      rgba(16,185,129,0.35);
        --green-soft:      rgba(16, 185, 129, 0.08);
        --text-1: #f0fdf4;
        --text-2: #a7f3d0;
        --text-3: #8dc9a8;
        --bg-dark:  rgba(4, 12, 8, 0.40);
        --bg-panel: rgba(10, 22, 16, 0.35);
        --border-glow: rgba(52,211,153,0.22);
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
    
    /* ── GRAND CADRE UNIQUE ── */
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
        transition: all 0.3s ease;
    }
    
    .master-frame:hover {
        border-color: rgba(52, 211, 153, 0.18);
        box-shadow:
            0 32px 80px rgba(0,0,0,0.45),
            0 0 80px rgba(16,185,129,0.08) inset,
            0 1px 0 rgba(255,255,255,0.10) inset;
    }
    
    @keyframes frameIn {
        from { opacity:0; transform:scale(0.96) translateY(20px); }
        to   { opacity:1; transform:scale(1) translateY(0); }
    }
    
    /* ── HEADER DU CADRE ── */
    .frame-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 22px;
        background: rgba(255, 255, 255, 0.04);
        border-bottom: 1px solid var(--glass-border);
        backdrop-filter: blur(20px);
    }
    
    .frame-brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
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
        font-size: 17px;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        text-shadow: 0 0 16px rgba(52, 211, 153, 0.4);
    }
    
    .frame-brand-text span {
        font-size: 9px;
        color: #7ecfaa;
        letter-spacing: 0.08em;
    }
    
    .frame-date {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(52,211,153,0.10);
        border-radius: 8px;
        font-size: 11px;
        color: var(--text-2);
    }
    
    .frame-date i { color: var(--green-bright); }
    
    /* ── CORPS DU CADRE ── */
    .frame-body {
        display: flex;
        min-height: calc(100vh - 140px);
    }
    
    /* ── SIDEBAR RÉTRACTABLE ── */
    .sidebar {
        width: var(--sidebar-width);
        min-width: var(--sidebar-width);
        background: rgba(4, 1, 0, 0.45);
        border-right: 1px solid var(--glass-border);
        display: flex;
        flex-direction: column;
        padding: 0;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .sidebar.collapsed {
        width: var(--sidebar-collapsed);
        min-width: var(--sidebar-collapsed);
    }

    /* ── SIDEBAR TOGGLE (top) ── */
    .sidebar-toggle {
        width: 100%;
        height: 32px;
        background: rgba(16, 185, 129, 0.08);
        border: none;
        border-bottom: 1px solid rgba(52, 211, 153, 0.12);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 10px;
        cursor: pointer;
        color: var(--green-bright);
        font-size: 12px;
        transition: all 0.2s;
        gap: 6px;
        flex-shrink: 0;
    }

    .sidebar-toggle:hover {
        background: rgba(16, 185, 129, 0.15);
    }

    .sidebar-toggle-label {
        font-size: 9px;
        color: var(--text-3);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        transition: opacity 0.2s;
        white-space: nowrap;
    }

    .sidebar.collapsed .sidebar-toggle {
        justify-content: center;
        padding: 0;
    }

    .sidebar.collapsed .sidebar-toggle-label {
        display: none;
    }

    .sidebar.collapsed .sidebar-toggle i {
        transform: rotate(180deg);
    }

    .sidebar-nav {
        flex: 1;
        padding: 10px 0;
        overflow: hidden;
    }
    
    .sidebar.collapsed .nav-section-title,
    .sidebar.collapsed .nav-item span,
    .sidebar.collapsed .sidebar-footer {
        opacity: 0;
        pointer-events: none;
        width: 0;
        overflow: hidden;
    }
    
    .sidebar.collapsed .nav-item {
        justify-content: center;
        padding: 9px 6px;
        margin: 0 3px;
    }
    
    .sidebar.collapsed .nav-item i {
        width: auto;
        font-size: 18px;
    }
    
    .sidebar.collapsed .user-chip,
    .sidebar.collapsed .btn-logout span {
        display: none;
    }
    
    .sidebar.collapsed .btn-logout {
        padding: 9px 4px;
        margin: 0 4px;
    }
    
    .nav-section { 
        padding: 0 10px; 
        margin-bottom: 4px;
        transition: opacity 0.2s;
    }
    
    .nav-section-title {
        font-size: 9px;
        font-weight: 700;
        color: #6ee7b7;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        padding: 0 8px;
        margin-bottom: 5px;
        transition: opacity 0.2s;
        text-shadow: 0 0 8px rgba(52, 211, 153, 0.4);
    }
    
    .nav-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 7px 10px;
        border-radius: 8px;
        color: var(--text-2);
        font-size: 11px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
        margin-bottom: 2px;
        white-space: nowrap;
    }
    
    .nav-item:hover {
        background: rgba(16, 185, 129, 0.10);
        color: var(--green-bright);
        transform: translateX(3px);
    }
    
    .nav-item.active {
        background: rgba(16, 185, 129, 0.15);
        color: var(--green-bright);
        border-left: 3px solid var(--green-primary);
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .nav-item i { 
        font-size: 16px; 
        width: 20px; 
        text-align: center;
        transition: all 0.25s;
        flex-shrink: 0;
    }
    
    .sidebar-footer {
        padding: 10px;
        border-top: 1px solid var(--glass-border);
        transition: opacity 0.2s;
    }
    
    .user-chip {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 8px;
    }
    
    .user-avatar {
        width: 28px; height: 28px;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700; color: #fff;
        flex-shrink: 0;
    }
    
    .user-info { display: flex; flex-direction: column; }
    .user-name { font-size: 10px; font-weight: 600; color: var(--text-1); }
    .user-role { font-size: 8px; color: var(--green-bright); }
    
    .btn-logout {
        display: flex; align-items: center; justify-content: center;
        gap: 5px;
        width: 100%;
        padding: 7px;
        border-radius: 7px;
        border: none;
        background: rgba(239, 68, 68, 0.12);
        color: #f87171;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    
    .btn-logout:hover {
        background: rgba(239, 68, 68, 0.22);
        transform: translateY(-1px);
    }
    
    /* ── ZONE CONTENU ── */
    .content-zone {
        flex: 1;
        padding: 16px 22px;
        overflow-y: auto;
    }
    
    .content-zone::-webkit-scrollbar { width: 3px; }
    .content-zone::-webkit-scrollbar-track { background: transparent; }
    .content-zone::-webkit-scrollbar-thumb { background: rgba(16,185,129,0.25); border-radius: 2px; }
    
    /* ── PAGE HEADER ── */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 14px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(52,211,153,0.10);
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 7px;
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(52, 211, 153, 0.15);
        color: #34d399;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s;
        margin-bottom: 6px;
    }
    
    .btn-back:hover {
        background: rgba(16, 185, 129, 0.15);
        transform: translateX(-3px);
    }
    
    .header-title h1 {
        font-family: 'Rajdhani', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: -0.01em;
        text-shadow: 0 2px 20px rgba(0,0,0,0.5), 0 0 40px rgba(16,185,129,0.15);
    }
    
    .header-meta {
        display: flex;
        gap: 6px;
        margin-top: 6px;
    }
    
    .badge {
        padding: 3px 10px;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    
    .badge-type {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .status-actif { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.2); }
    .status-stock { background: rgba(148, 163, 184, 0.15); color: #94a3b8; border: 1px solid rgba(148, 163, 184, 0.2); }
    .status-en_reparation { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.2); }
    .status-hors_service { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); }
    .status-recycle { background: rgba(139, 92, 246, 0.15); color: #a78bfa; border: 1px solid rgba(139, 92, 246, 0.2); }
    
    .header-actions {
        display: flex;
        gap: 7px;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 14px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.25s;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.15));
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.25);
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1));
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.2);
    }
    
    /* ── GRILLE PRINCIPALE ── */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 10px;
    }
    
    .detail-column {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    /* ── CARTES GLASS COMPACTES ── */
    .detail-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        backdrop-filter: blur(20px) saturate(120%);
        -webkit-backdrop-filter: blur(20px) saturate(120%);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .detail-card:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(52, 211, 153, 0.20);
        box-shadow: 0 10px 32px rgba(0, 0, 0, 0.25), 0 0 16px rgba(16,185,129,0.05);
        transform: translateY(-2px);
    }
    
    .card-header {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 9px 12px;
        background: rgba(16, 185, 129, 0.08);
        border-bottom: 1px solid rgba(52, 211, 153, 0.12);
    }
    
    .card-header i {
        font-size: 16px;
        color: #6ee7b7;
        filter: drop-shadow(0 0 4px rgba(52, 211, 153, 0.6));
    }
    
    .card-header h2 {
        font-family: 'Rajdhani', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: #6ee7b7;
        text-transform: uppercase;
        letter-spacing: 0.10em;
        text-shadow: 0 0 12px rgba(52, 211, 153, 0.5);
    }
    
    .card-body { padding: 8px 12px; }
    
    /* ── INFO ROWS COMPACTES ── */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
    }
    
    .info-row:last-child { border-bottom: none; }
    
    .info-label {
        font-size: 11px;
        color: #8dc9a8;
        font-weight: 500;
    }
    
    .info-value {
        font-size: 11px;
        color: var(--text-1);
        font-weight: 600;
        text-align: right;
    }
    
    .info-value.code {
        font-family: 'Courier New', monospace;
        background: rgba(16, 185, 129, 0.08);
        padding: 2px 7px;
        border-radius: 4px;
        font-size: 10px;
        color: var(--green-bright);
    }
    
    .info-value.price { color: #fbbf24; font-weight: 700; }
    
    .user-chip-inline {
        display: flex;
        align-items: center;
        gap: 5px;
        background: rgba(16, 185, 129, 0.08);
        padding: 3px 8px;
        border-radius: 5px;
        border: 1px solid rgba(16, 185, 129, 0.15);
    }
    
    .user-chip-inline i { color: var(--green-bright); font-size: 11px; }
    .user-chip-inline span { color: var(--text-1); font-size: 11px; font-weight: 600; }
    .user-chip-inline small { color: var(--text-3); font-size: 9px; margin-left: 2px; }
    
    .text-muted { color: var(--text-3); font-style: italic; }
    
    .description-text {
        font-size: 11px;
        color: var(--text-2);
        line-height: 1.6;
    }
    
    /* ── SCORE COMPACT ── */
    .card-score {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px;
    }
    
    .score-ring {
        position: relative;
        width: 78px;
        height: 78px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .score-ring::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 3px solid rgba(255, 255, 255, 0.06);
    }
    
    .score-ring.score-good::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 3px solid var(--green-primary);
        border-top-color: transparent;
        transform: rotate(45deg);
        box-shadow: 0 0 12px rgba(16, 185, 129, 0.3);
    }
    
    .score-ring.score-medium::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 3px solid #f59e0b;
        border-top-color: transparent;
        transform: rotate(45deg);
        box-shadow: 0 0 12px rgba(245, 158, 11, 0.3);
    }
    
    .score-ring.score-bad::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 3px solid #ef4444;
        border-top-color: transparent;
        transform: rotate(45deg);
        box-shadow: 0 0 12px rgba(239, 68, 68, 0.3);
    }
    
    .score-value {
        font-family: 'Rajdhani', sans-serif;
        font-size: 22px;
        font-weight: 900;
        color: var(--text-1);
        line-height: 1;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    
    .score-label {
        font-size: 7px;
        color: var(--green-bright);
        text-transform: uppercase;
        letter-spacing: 0.10em;
        margin-top: 2px;
    }
    
    .score-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .score-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: #c4e8d8;
    }
    
    .score-item i { color: var(--green-bright); font-size: 13px; }
    
    /* ── ENERGY COMPACT ── */
    .energy-highlight {
        text-align: center;
        padding: 8px;
        background: rgba(16, 185, 129, 0.05);
        border-radius: 8px;
        margin-bottom: 8px;
        border: 1px solid rgba(52, 211, 153, 0.10);
    }
    
    .energy-big {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 5px;
        margin-bottom: 3px;
    }
    
    .energy-number {
        font-family: 'Rajdhani', sans-serif;
        font-size: 24px;
        font-weight: 900;
        color: var(--text-1);
        line-height: 1;
        text-shadow: 0 2px 12px rgba(0,0,0,0.3);
    }
    
    .energy-unit {
        font-size: 11px;
        color: var(--green-bright);
        font-weight: 600;
    }
    
    .energy-breakdown {
        font-size: 11px;
        color: #8dc9a8;
    }
    
    .energy-breakdown i { color: var(--green-bright); margin-right: 3px; }
    
    /* ── CARBON COMPACT ── */
    .carbon-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 7px;
    }
    
    .carbon-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 3px;
        padding: 8px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        transition: all 0.25s ease;
    }
    
    .carbon-item:hover {
        background: rgba(16, 185, 129, 0.06);
        border-color: rgba(52, 211, 153, 0.15);
        transform: translateY(-2px);
    }
    
    .carbon-item i { font-size: 16px; color: var(--green-bright); }
    
    .carbon-label {
        font-size: 9px;
        color: #8dc9a8;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 600;
    }
    
    .carbon-value {
        font-family: 'Rajdhani', sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-1);
    }
    
    /* ── HISTORIQUE COMPACT ── */
    .detail-section { margin-top: 0; }
    
    .card-history .card-header { justify-content: space-between; }
    
    .badge-count {
        padding: 2px 8px;
        background: rgba(16, 185, 129, 0.15);
        color: var(--green-bright);
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
    }
    
    .history-chart-wrapper {
        height: 190px;
        margin-bottom: 12px;
        padding: 7px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table thead th {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6ee7b7;
        padding: 7px 10px;
        text-align: left;
        border-bottom: 1px solid rgba(52, 211, 153, 0.18);
        background: rgba(16, 185, 129, 0.07);
        text-shadow: 0 0 8px rgba(52, 211, 153, 0.4);
    }
    
    .data-table tbody td {
        padding: 7px 10px;
        font-size: 12px;
        color: #c4e8d8;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .data-table tbody tr:hover td { background: rgba(16, 185, 129, 0.04); }
    
    .col-numeric {
        font-family: 'Rajdhani', sans-serif;
        font-weight: 700;
        color: var(--text-1);
    }
    
    .badge-source {
        display: inline-block;
        padding: 2px 7px;
        border-radius: 4px;
        font-size: 9px;
        font-weight: 600;
    }
    
    .source-mesure_reelle { background: rgba(16, 185, 129, 0.15); color: #34d399; }
    .source-estimation { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
    .source-facture { background: rgba(59, 130, 246, 0.15); color: #60a5fa; }
    .source-api_carbon { background: rgba(139, 92, 246, 0.15); color: #a78bfa; }
    
    /* ── ALERT BADGE ── */
    .alert-banner {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 14px;
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.25);
        border-radius: 8px;
        color: #f87171;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 14px;
        backdrop-filter: blur(10px);
    }
    
    .alert-banner i {
        font-size: 14px;
        color: #ef4444;
    }
    
    .alert-banner strong {
        color: #fca5a5;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    /* Stats cards */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 14px;
    }
    
    .stat-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        backdrop-filter: blur(16px);
        transition: all 0.25s;
    }
    
    .stat-card:hover {
        background: rgba(255, 255, 255, 0.06);
        transform: translateY(-2px);
    }
    
    .stat-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    
    .stat-icon.recycle { background: rgba(16, 185, 129, 0.12); color: #34d399; }
    .stat-icon.warning { background: rgba(245, 158, 11, 0.12); color: #fbbf24; }
    .stat-icon.cost { background: rgba(59, 130, 246, 0.12); color: #60a5fa; }
    
    .stat-content { display: flex; flex-direction: column; gap: 2px; }
    .stat-label {
        font-size: 10px;
        color: #8dc9a8;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 600;
    }
    .stat-value {
        font-family: 'Rajdhani', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--text-1);
    }
    
    /* Device card */
    .device-alert-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 14px;
        backdrop-filter: blur(16px);
        transition: all 0.25s;
        position: relative;
        overflow: hidden;
    }
    
    .device-alert-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #f59e0b, #ef4444);
        opacity: 0.6;
    }
    
    .device-alert-card:hover {
        background: rgba(255, 255, 255, 0.06);
        transform: translateY(-2px);
        box-shadow: 0 10px 32px rgba(0,0,0,0.2);
    }
    
    .device-alert-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .device-alert-title {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .device-alert-icon {
        width: 32px;
        height: 32px;
        background: rgba(148, 163, 184, 0.12);
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: var(--text-2);
    }
    
    .device-alert-name {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-1);
    }
    
    .device-alert-type {
        font-size: 10px;
        color: var(--text-3);
    }
    
    .badge-alert {
        padding: 2px 8px;
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.2);
        border-radius: 5px;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .device-alert-details {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .device-alert-detail {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: var(--text-2);
    }
    
    .device-alert-detail i {
        font-size: 11px;
        color: var(--green-bright);
        width: 14px;
    }
    
    .device-alert-detail.highlight {
        color: #fbbf24;
    }
    
    .device-alert-footer {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    
    .device-alert-stat {
        text-align: center;
    }
    
    .device-alert-stat-value {
        font-family: 'Rajdhani', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-1);
    }
    
    .device-alert-stat-label {
        font-size: 8px;
        color: var(--text-3);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-top: 2px;
    }
    
    /* ── EMPTY STATE ── */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 24px;
        color: var(--text-3);
        text-align: center;
    }
    
    .empty-state i { font-size: 34px; color: var(--green-bright); opacity: 0.4; }
    .empty-state p { font-size: 12px; }
    
    .btn-sm { padding: 5px 12px; font-size: 10px; }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
        color: #fff;
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, var(--green-bright), var(--green-primary));
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
    }
    
    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .detail-grid { grid-template-columns: 1fr; }
        .stats-row { grid-template-columns: 1fr; }
    }
    
    @media (max-width: 768px) {
        .master-frame { margin: 0; border-radius: 0; }
        .frame-body { flex-direction: column; }
        .sidebar { 
            width: 100%; 
            border-right: none; 
            border-bottom: 1px solid var(--glass-border);
        }
        .sidebar.collapsed {
            width: 100%;
            min-width: 100%;
        }
        .sidebar-toggle { display: none; }
        .content-zone { padding: 14px; }
        .page-header { flex-direction: column; }
        .header-actions { width: 100%; justify-content: flex-end; }
        .carbon-grid { grid-template-columns: 1fr; }
        .card-score { flex-direction: column; text-align: center; }
        .stats-row { grid-template-columns: 1fr; }
        .device-alert-footer { grid-template-columns: 1fr; }
    }
    </style>
</head>

<body>

<div class="master-frame">
    
    <!-- Header du cadre -->
    <div class="frame-header">
        <div class="frame-brand">
            <div class="frame-brand-icon">
                <i class="ph ph-leaf"></i>
            </div>
            <div class="frame-brand-text">
                <h1>Green IT</h1>
                <span>Parc Informatique Écoresponsable</span>
            </div>
        </div>
        <div class="frame-date">
            <i class="ph ph-calendar-blank"></i>
            <span>{{ now()->format('d M Y') }}</span>
        </div>
    </div>
    
    <!-- Corps du cadre -->
    <div class="frame-body">
        
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">

            <!-- Toggle button (top) -->
            <button class="sidebar-toggle" id="sidebarToggle" title="Réduire/Développer">
                <span class="sidebar-toggle-label">Réduire</span>
                <i class="ph ph-caret-left"></i>
            </button>

            <div class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Navigation</div>
                    <nav>
                        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="ph ph-squares-four"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('devices.index') }}" class="nav-item {{ request()->routeIs('devices.*') && !request()->routeIs('devices.remplacer') ? 'active' : '' }}">
                            <i class="ph ph-desktop"></i>
                            <span>Parc informatique</span>
                        </a>
                        <a href="{{ route('energy.index') }}" class="nav-item {{ request()->routeIs('energy.*') ? 'active' : '' }}">
                            <i class="ph ph-lightning"></i>
                            <span>Consommation</span>
                        </a>
                        <a href="{{ route('devices.remplacer') }}" class="nav-item {{ request()->routeIs('devices.remplacer') ? 'active' : '' }}">
                            <i class="ph ph-warning"></i>
                            <span>Alertes</span>
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
                        <i class="ph ph-sign-out"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Zone de contenu -->
        <main class="content-zone">
            
            <!-- Header de page -->
            <header class="page-header">
                <div class="header-left">
                    <a href="{{ route('devices.index') }}" class="btn-back">
                        <i class="ph ph-arrow-left"></i> Retour à la liste
                    </a>
                    <div class="header-title">
                        <h1>{{ $device->nom }}</h1>
                        <div class="header-meta">
                            <span class="badge badge-type">{{ $device->type }}</span>
                            <span class="badge status-{{ $device->statut }}">
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
            
            <!-- Grille principale -->
            <div class="detail-grid">
                
                <!-- Colonne gauche -->
                <div class="detail-column">
                    
                    <!-- Identification -->
                    <div class="detail-card">
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
                                <span class="info-value price">{{ $device->prix ? number_format($device->prix, 2) . ' MAD' : '—' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Localisation -->
                    <div class="detail-card">
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
                                        <div class="user-chip-inline">
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
                    
                    <!-- Description -->
                    @if($device->description)
                    <div class="detail-card">
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
                
                <!-- Colonne droite -->
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
                    
                    <!-- Consommation -->
                    <div class="detail-card">
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
                                    <i class="ph ph-lightning-fill"></i>
                                    {{ number_format($device->puissance_watt ?? 0, 0) }} W
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
                    
                    <!-- Empreinte Carbone -->
                    <div class="detail-card">
                        <div class="card-header">
                            <i class="ph ph-cloud"></i>
                            <h2>Empreinte Carbone</h2>
                        </div>
                        <div class="card-body">
                            <div class="carbon-grid">
                                <div class="carbon-item">
                                    <i class="ph ph-cloud-arrow-up"></i>
                                    <span class="carbon-label">Émissions annuelles</span>
                                    <span class="carbon-value">{{ number_format($device->emission_co2_kg ?? 0, 2) }} kg</span>
                                </div>
                                <div class="carbon-item">
                                    <i class="ph ph-factory"></i>
                                    <span class="carbon-label">Fabrication</span>
                                    <span class="carbon-value">{{ number_format($device->empreinte_carbone_fab ?? 0, 2) }} kg</span>
                                </div>
                                <div class="carbon-item">
                                    <i class="ph ph-calendar-blank"></i>
                                    <span class="carbon-label">Sur 5 ans</span>
                                    <span class="carbon-value">{{ number_format($projections['emission_5ans'] ?? 0, 2) }} kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Historique -->
            <div class="detail-section">
                <div class="detail-card card-history">
                    <div class="card-header">
                        <div style="display:flex;align-items:center;gap:7px;">
                            <i class="ph ph-chart-line-up"></i>
                            <h2>Historique des mesures</h2>
                        </div>
                        <span class="badge-count">{{ $device->energyLogs->count() }} mesures</span>
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
            
        </main>
        
    </div>
    
</div>

<!-- Toggle Sidebar Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const label = toggle.querySelector('.sidebar-toggle-label');
    
    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
    }
    
    toggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        const collapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', collapsed);
        if (label) label.textContent = collapsed ? '' : 'Réduire';
    });
});
</script>

<!-- Script Chart.js -->
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
                borderColor: 'rgb(52, 211, 153)',
                backgroundColor: 'rgba(52, 211, 153, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: 'rgb(16, 185, 129)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
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
                    grid: { color: 'rgba(255,255,255,0.03)' },
                    ticks: { color: '#8dc9a8', font: { size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#8dc9a8', font: { size: 11 } }
                }
            }
        }
    });
});
</script>
@endif

</body>
</html>