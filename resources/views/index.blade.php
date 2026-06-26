<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parc informatique — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* ═══════════════════════════════════════════════ */
        /* RESET & BASE STYLES (Thème Sombre) */
        /* ═══════════════════════════════════════════════ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
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

/* ═══════════════════════════════════════════════ */
html, body {
    font-family: 'Exo 2', sans-serif;
    color: var(--text-1);
    min-height: 100vh;
    overflow-x: hidden;
    overflow-y: auto;       /* ← scroll global */
    -webkit-font-smoothing: antialiased;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    background-image: url('{{ asset("images/img.jfif") }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}
/* ═══════════════════════════════════════════════ */
/* SCROLLBAR FINIE ET DISCRÈTE                   */
/* ═══════════════════════════════════════════════ */

/* Webkit (Chrome, Safari, Edge) */
::-webkit-scrollbar {
    width: 1px;              /* ← largeur très fine (défaut: 16px) */
    height: 1px;             /* ← hauteur pour scroll horizontal */
}

::-webkit-scrollbar-track {
    background: transparent;  /* ← piste invisible */
    border-radius: 2px;
    margin-top: 50px;     /* ← espace en haut */
    margin-bottom: 50px;  /* ← espace en bas */

}

::-webkit-scrollbar-thumb {
    background:  #0ff6a9; /* ← vert discret */
    border-radius: 2px;
      min-height: 20px;  
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(16, 185, 129, 0.6);   /* ← plus visible au hover */
}

/* Firefox */
html {
    scrollbar-width: thin;                    /* ← "auto", "thin", "none" */
    scrollbar-color: rgb(251, 251, 251) transparent;  /* ← thumb track */
}
.shell {
    position: relative;
    z-index: 1;
    display: flex;
    width: 95vw;
    max-width: 1400px;
    min-height: 85vh;
    height: auto;
    background: rgba(143, 158, 151, 0.45);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    border-radius: var(--r-lg);
    border: 1px solid rgba(52,211,153,0.18);
    box-shadow:
        0 32px 80px rgba(0,0,0,0.45),
        0  0  40px rgba(16,185,129,0.06) inset,
        0  1px 0   rgba(255,255,255,0.12) inset;
    overflow: hidden !important;     /* ← CACHE tout débordement */
    animation: shellIn 0.8s cubic-bezier(.4,0,.2,1) both;
    margin: 20px auto;
    align-items: flex-start;        /* ← empêche l'étirement vertical */
}
/* Le contenu principal s'étend naturellement */


/* Le tableau reste responsive mais sans scroll interne */
.table-responsive {
    overflow-x: visible;      /* ← PAS de scroll horizontal interne */
    /* Ou si vous voulez garder le scroll horizontal du tableau sur mobile : */
    /* overflow-x: auto; */
}

/* Overlay tint */
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

@keyframes shellIn {
    from { opacity:0; transform:scale(0.97) translateY(14px); }
    to   { opacity:1; transform:scale(1)    translateY(0); }
}       
.sidebar {
    width: 200px;
    min-width: 200px;
    display: flex;
    flex-direction: column;
    background: rgba(4, 1, 0, 0.78);
    border-right: 1px solid rgba(52,211,153,0.12);
    padding: 0;
    transition: width 0.3s ease, min-width 0.3s ease;
    position: sticky;       /* ← STICKY au lieu de relative */
    top: 0;                 /* ← colle en haut */
    left: 0;
    align-self: flex-start; /* ← ne s'étire pas avec le shell */
    height: 100vh;          /* ← 100vh comme avant */
    min-height: 100vh;
    flex-shrink: 0;
}

.sidebar.collapsed { 
    width: 64px; 
    min-width: 64px; 
}
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: visible !important;
    min-width: 0;
    min-height: auto;
    height: auto;
    width: auto;
    transition: all 0.3s ease;
}

.dash-body {
    flex: 1;
    padding: 12px 16px;
    overflow: visible;      /* ← PAS de scroll interne */
    display: flex;
    flex-direction: column;
    gap: 1px;
     overflow: visible !important;   
    min-height: auto;
    height: auto;
    min-width: 0;
}
        .sidebar-toggle {
            position: absolute; top: 18px; 
             left: 50px;    /* ← Positionné à 10px du bord gauche */
             right: auto; 
            width: 26px; height: 26px;
            background: rgba(2, 26, 17, 0.9);
            border: 1px solid rgba(177, 165, 165, 0.08);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #10b981; font-size: 12px;
            z-index: 20;
            box-shadow: 0 2px 10px rgba(0,0,0,0.4);
            transition: all 0.2s;
        }
        .sidebar-toggle:hover { background: rgba(16, 185, 129, 0.1); box-shadow: 0 0 10px rgba(16,185,129,0.28); }
        .sidebar.collapsed .sidebar-toggle i { transform: rotate(180deg); }

        .brand {
            display: flex; align-items: center; gap: 12px;
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(177, 165, 165, 0.08);
            flex-shrink: 0;
        }
        .sidebar.collapsed .brand { justify-content: center; padding: 22px 0 18px; }

        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff;
            box-shadow: 0 0 18px rgba(16,185,129,0.28);
            flex-shrink: 0;
        }
        .brand-label {
            font-family: 'Rajdhani', sans-serif;
            font-size: 17px; font-weight: 700;
            color: #f4f6f5dd; letter-spacing: 0.05em; text-transform: uppercase;
            white-space: nowrap; transition: opacity 0.2s;
        }
        .sidebar.collapsed .brand-label { opacity:0; width:0; overflow:hidden; display:none; }

        .nav-group { padding: 14px 12px 0; }
        .nav-group-title {
            font-size: 9px; font-weight: 700; color: #10b981;
            text-transform: uppercase; letter-spacing: 0.12em;
            padding: 0 8px; margin-bottom: 6px;
        }
        .sidebar.collapsed .nav-group-title { display: none; }
        nav { display: flex; flex-direction: column; gap: 2px; }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px;
            color: #e6f3ec; font-size: 13px; font-weight: 500;
            text-decoration: none; transition: all 0.2s; white-space: nowrap; position: relative;
        }
        .sidebar.collapsed .nav-item { justify-content:center; padding:10px; width:40px; margin:0 auto; }
        .nav-item:hover { background: rgba(238, 241, 240, 0.09); color: #34d399; }

        .nav-item i { font-size: 18px; flex-shrink: 0; width: 22px; text-align: center; }
        .sidebar.collapsed .nav-item span { opacity:0; width:0; overflow:hidden; display:none; }

        .nav-item.active {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-left: 3px solid #10b981;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: #ef4444; color: #fff; font-size: 10px; font-weight: 700;
            border-radius: 10px; padding: 1px 6px;
        }
         
        .sidebar.collapsed .nav-badge { position:absolute; top:2px; right:2px; margin:0; }

        .sidebar.collapsed .nav-item[title]::after {
            content: attr(title); position: absolute; left: 52px;
            background: rgba(4,18,12,0.95); color: #f4f6f5dd;
            padding: 5px 10px; border-radius: 6px; font-size: 11px;
            white-space: nowrap; opacity: 0; pointer-events: none;
            transition: opacity 0.15s; border: 1px solid rgba(8, 25, 16, 0.2); z-index: 100;
        }
        .sidebar.collapsed .nav-item:hover::after { opacity: 1; }

               .sidebar-footer {
            margin-top: auto; 
            padding: 14px 16px;
            border-top: 1px solid rgba(177, 165, 165, 0.08);
            display: flex;           /* ← AJOUTER */
            flex-direction: column;  /* ← AJOUTER : empile verticalement */
            gap: 10px;               /* ← AJOUTER : espace entre user et bouton */
        }
        .sidebar.collapsed .sidebar-footer { 
            padding: 14px 6px; 
            display: flex; 
            justify-content: center; 
            align-items: center;
        }

        .user-row { 
            display: flex; 
            align-items: center; 
            gap: 9px; 
        }
        .sidebar.collapsed .user-row { display: none; }
        .avatar {
            width:32px; height:32px;
            background: linear-gradient(135deg, #76b8f9ea, #4c12d3);
            border-radius: 8px; display:flex; align-items:center; justify-content:center;
            font-size:13px; font-weight:700; color:#fff; flex-shrink:0;
        }
        .user-info { display:flex; flex-direction:column; overflow:hidden; }
        .user-name { font-size:12px; font-weight:600; color:#f4f6f5dd; white-space:nowrap; }
        .user-role { font-size:10px; color:#10b981; }
        .btn-logout {
            display: flex; 
            align-items: center; 
            justify-content: center;   /* ← AJOUTER : centre le texte */
            gap: 8px;
            padding: 10px 12px;         /* ← CHANGER : plus de padding */
            border-radius: 8px; 
            border: none;
            background: #10b981; 
            color: white;
            cursor: pointer; 
            font-size: 12px; 
            font-weight: 500;
            text-decoration: none; 
            width: 100%; 
            transition: all 0.2s;
        }
        .btn-logout:hover { 
            background: #059669;       /* ← CHANGER : vert foncé au lieu de rouge */
            color: white; 
        }
        .btn-logout i { font-size: 16px; flex-shrink: 0; }
        .sidebar.collapsed .btn-logout { 
            width: 40px; 
            padding: 10px; 
            justify-content: center; 
        }
        .sidebar.collapsed .btn-logout span { display: none; }

        .btn-logout:hover { background:#10b981; color:white; }
        .btn-logout i { font-size:16px; flex-shrink:0; }
        .sidebar.collapsed .btn-logout { width:40px; padding:10px; justify-content:center; }
        .sidebar.collapsed .btn-logout span { display:none; }
        /* ═══════════════════════════════════════════════ */
        /* MAIN CONTENT AREA */
        /* ═══════════════════════════════════════════════ */
       
        .sidebar.collapsed ~ .main-content {
            width: calc(100% - 64px);   /* ← AJOUTER : espace quand collapsed */
        }
               /* ── TOP BAR ── */
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 24px;
            min-height: 56px;
            border-bottom: 1px solid rgba(177, 165, 165, 0.08);
            background: rgba(117, 143, 133, 0.32);
            backdrop-filter: blur(10px);
            flex-shrink: 0;
        }
        .title-badge {
            display:inline-flex; align-items:center; gap:7px;
            background: rgba(1, 16, 11, 0.97);
            border: 1px solid #34d399;
            border-radius: 20px; padding: 10px 16px;
            font-family: 'Rajdhani', sans-serif;
            font-size: 15px; font-weight: 700;
            color: #34d399; letter-spacing: 0.08em; text-transform: uppercase;
        }
        .title-badge i { font-size:17px; }
        .topbar-right { display:flex; align-items:center; gap:9px; }
        .tb-date {
            display:flex; align-items:center; gap:7px;
            padding:6px 12px; border:1px solid rgba(177, 165, 165, 0.08);
            border-radius:9px; background: rgba(255,255,255,0.055);
            font-size:11px; color:#e6f3ec;
        }
        .tb-date i { color:#10b981; font-size:14px; }

        /* ── CONTENT AREA ── */
         
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header-title-wrapper h1 {
            font-size: 24px;
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .header-title-wrapper .subtitle {
            font-size: 13px;
            color: #94a3b8;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* ═══════════════════════════════════════════════ */
        /* GLASSMORPHISM PANELS */
        /* ═══════════════════════════════════════════════ */
        .glass-panel {
            background: rgba(113, 133, 125, 0.22);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));  /* ← CHANGER : 160px au lieu de 200px */
            gap: 16px;                                                     /* ← CHANGER : 16px au lieu de 20px */
            margin-bottom: 24px;                                           /* ← CHANGER : 24px au lieu de 32px */
        }

        .stat-card {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
        }

        .stat-card i {
            font-size: 28px;
            opacity: 0.8;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
        }

        .stat-label {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .stat-blue i { color: #38bdf8; }
        .stat-green i { color: #4ade80; }
        .stat-orange i { color: #fb923c; }
        .stat-red i { color: #f87171; }
        .stat-purple i { color: #c084fc; }

        /* ═══════════════════════════════════════════════ */
        /* TABLE STYLES */
        /* ═══════════════════════════════════════════════ */
        .table-section {
            padding: 16px;
        }

        .table-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-toolbar h2 {
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-filters {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .badge-count-total {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .filter-select {
            appearance: none;
            background: #22c55e;           /* ← CHANGER : vert comme btn-primary */
            border: none;                   /* ← CHANGER : supprimer bordure */
            color: #111613;                 /* ← CHANGER : texte foncé comme btn-primary */
            padding: 10px 36px 10px 18px;   /* ← CHANGER : même padding que btn-primary */
            border-radius: 8px;             /* ← Garder */
            font-size: 13px;                /* ← Garder */
            font-weight: 600;               /* ← AJOUTER : même graisse que btn-primary */
            cursor: pointer;
            outline: none;
            display: inline-flex;           /* ← AJOUTER */
            align-items: center;            /* ← AJOUTER */
            gap: 8px;                       /* ← AJOUTER : même gap que btn-primary */
            white-space: nowrap;            /* ← AJOUTER */
            transition: background 0.2s;    /* ← AJOUTER : même transition que btn-primary */
        }
        .filter-select:hover {
            background: #16a34a;            /* ← AJOUTER : même hover que btn-primary */
        }
        /* Style des options du select */
        .filter-select option {
            background: #161f1a;            /* ← AJOUTER : fond sombre pour le dropdown */
            color: #e2e8f0;                 /* ← AJOUTER : texte clair */
            font-weight: 500;
        }
.table-responsive {
    overflow-x: visible;
    overflow-y: visible;
}

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table th {
            padding: 14px 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #94a3b8;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 16px;
            font-size: 14px;
            color: #cbd5e1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }

        .data-table tr:hover td {
            background: rgba(255, 255, 255, 0.01);
        }

        .device-title {
            font-weight: 600;
            color: #ffffff;
            display: block;
        }

        .device-meta {
            font-size: 12px;
            color: #64748b;
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-actif { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
        .status-stock { background: rgba(148, 163, 184, 0.15); color: #94a3b8; }
        .status-en_reparation { background: rgba(249, 115, 22, 0.15); color: #fdba74; }
        .status-hors_service { background: rgba(220, 38, 38, 0.15); color: #f87171; }

        .score-badge {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
        }
        .score-good { background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid #22c55e; }
        .score-medium { background: rgba(234, 88, 12, 0.2); color: #fb923c; border: 1px solid #ea580c; }
        .score-bad { background: rgba(220, 38, 38, 0.2); color: #f87171; border: 1px solid #dc2626; }

        .btn-primary {
            background: #22c55e;
            color: #111613;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-primary:hover { background: #16a34a; }

        .actions { display: flex; gap: 8px; }
        .btn-icon {
            color: #94a3b8;
            font-size: 16px;
            text-decoration: none;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.02);
            border: none;
            cursor: pointer;
        }
        .btn-icon:hover { color: #ffffff; background: rgba(255, 255, 255, 0.08); }
        .btn-delete:hover { color: #f87171; background: rgba(220, 38, 38, 0.1); }
        
        .inline-form { margin: 0; }
        /* ═══════════════════════════════════════════════ */
/* RESPONSIVE — Sidebar collapse automatique       */
/* ═══════════════════════════════════════════════ */

@media (max-width: 1024px) {
    .shell {
        width: 100vw;
        max-width: none;
        border-radius: 0;
    }
    
    .sidebar {
        width: 64px;
        min-width: 64px;
        padding: 0;
    }
    
    .sidebar .sidebar-toggle {
        display: none;  /* Cache le toggle en mode responsive */
    }
    
    .sidebar .brand-label,
    .sidebar .nav-group-title,
    .sidebar .nav-item span,
    .sidebar .user-row,
    .sidebar .btn-logout span {
        display: none;
    }
    
    .sidebar .brand {
        justify-content: center;
        padding: 22px 0 18px;
    }
    
    .sidebar .nav-item {
        justify-content: center;
        padding: 10px;
        width: 40px;
        margin: 0 auto;
    }
    
    .sidebar .nav-badge {
        position: absolute;
        top: 2px;
        right: 2px;
        margin: 0;
    }
    
    .sidebar .sidebar-footer {
        padding: 14px 6px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .sidebar .btn-logout {
        width: 40px;
        padding: 10px;
        justify-content: center;
    }
    
    .main-content {
        width: calc(100% - 64px);
    }
}
@media (max-width: 768px) {
    .shell {
        flex-direction: column;
        height: auto;           /* ← CHANGER : auto au lieu de 100vh */
        min-height: auto;       /* ← CHANGER */
        overflow-y: visible;    /* ← CHANGER */
    }
    
    .sidebar {
        width: 100%;
        min-width: 100%;
        height: auto;           /* ← CHANGER */
        min-height: auto;       /* ← CHANGER */
        flex-direction: row;
        align-items: center;
        padding: 10px 16px;
        border-right: none;
        border-bottom: 1px solid rgba(52,211,153,0.12);
    }
    
    .sidebar .brand {
        padding: 0;
        margin: 0;
        border: none;
    }
    
    .sidebar .nav-group {
        display: none;  /* Cache le menu en mode mobile */
    }
    
    .sidebar .sidebar-footer {
        display: none;
    }
    
    .sidebar .sidebar-toggle {
        display: flex;
        position: static;
        margin-left: auto;
    }
    
    .main-content {
        width: 100%;
        height: auto;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .data-table {
        font-size: 12px;
    }
    
    .data-table th,
    .data-table td {
        padding: 8px;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }
    
    .table-toolbar {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }
}
/* ═══════════════════════════════════════════════ */
/* DROPDOWN ACTIONS                               */
/* ═══════════════════════════════════════════════ */

.actions-dropdown {
    position: relative;
    display: inline-block;
}

.btn-dots {
    color: #94a3b8;
    font-size: 20px;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-dots:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.08);
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 6px;
    min-width: 220px;
    background: rgba(10, 18, 14, 0.95);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(52, 211, 153, 0.15);
    border-radius: 10px;
    padding: 6px;
    box-shadow:
        0 10px 40px rgba(0, 0, 0, 0.5),
        0 0 20px rgba(16, 185, 129, 0.08);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-8px) scale(0.96);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
}

.actions-dropdown.active .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 6px;
    color: #e2e8f0;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.15s;
    cursor: pointer;
    width: 100%;
    border: none;
    background: transparent;
    text-align: left;
}

.dropdown-item i {
    font-size: 16px;
    color: #94a3b8;
    flex-shrink: 0;
    width: 18px;
    text-align: center;
}

.dropdown-item:hover {
    background: rgba(16, 185, 129, 0.1);
    color: #34d399;
}

.dropdown-item:hover i {
    color: #34d399;
}

.dropdown-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.06);
    margin: 6px 0;
}

/* Fermer le dropdown en cliquant ailleurs */
.actions-dropdown.active .btn-dots {
    color: #34d399;
    background: rgba(16, 185, 129, 0.1);
}
/* ═══════════════════════════════════════════════ */
/* BOUTON SUPPRIMER CERCLE (toujours visible)     */
/* ═══════════════════════════════════════════════ */

.btn-delete-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(239, 68, 68, 0.15);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #f87171;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.btn-delete-circle:hover {
    background: rgba(239, 68, 68, 0.25);
    border-color: rgba(239, 68, 68, 0.5);
    color: #fca5a5;
    transform: scale(1.1);
}

.btn-delete-circle i {
    font-size: 15px;
}
/* ═══════════════════════════════════════════════ */
/* SUPPRESSION DÉFINITIVE DES SCROLLBARS INTERNES */
/* ═══════════════════════════════════════════════ */

.main-content,
.dash-body,
.table-section,
.glass-panel,
.table-responsive {
    overflow: visible !important;
    overflow-x: visible !important;
    overflow-y: visible !important;
}

/* Supprime les pseudo-éléments de scrollbar */
.shell::-webkit-scrollbar,
.main-content::-webkit-scrollbar,
.dash-body::-webkit-scrollbar,
.table-section::-webkit-scrollbar,
.glass-panel::-webkit-scrollbar {
    display: none !important;
    width: 0 !important;
    height: 0 !important;
}


/* ═══════════════════════════════════════════════ */
/* SCROLLBAR GLOBALE UNIQUEMENT                 */
/* ═══════════════════════════════════════════════ */

html, body {
    overflow-y: auto;
    overflow-x: hidden;
}

::-webkit-scrollbar-button:vertical:start:increment,
::-webkit-scrollbar-button:vertical:start:decrement,
::-webkit-scrollbar-button:vertical:end:increment,
::-webkit-scrollbar-button:vertical:end:decrement {
    display: none !important;
    height: 0 !important;
}
::-webkit-scrollbar-button {
    display: none !important;
    height: 0 !important;
    width: 0 !important;
}
    </style>
</head>
<body>

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
                <a href="{{ route('devices.index') }}" class="nav-item active" title="Parc informatique">
                    <i class="ph ph-desktop"></i><span>Parc informatique</span>
                </a>
                <a href="{{ route('energy.index') }}" class="nav-item" title="Consommation">
                    <i class="ph ph-lightning"></i><span>Consommation</span>
                </a>
                <a href="{{ route('devices.remplacer') }}" class="nav-item" title="Alertes">
                    <i class="ph ph-warning"></i><span>Alertes</span>
                    @if(isset($stats['devices_a_remplacer']) && $stats['devices_a_remplacer'] > 0)
                        <span class="nav-badge">{{ $stats['devices_a_remplacer'] }}</span>
                    @endif
                </a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="user-row">
                <div class="avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
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

        <main class="main-content">
        
        <!-- TOP BAR -->
        <div class="topbar">
            <div class="title-badge">
                <i class="ph ph-leaf"></i>
                Parc informatique
            </div>
            <div class="topbar-right">
                <div class="tb-date">
                    <i class="ph ph-calendar-blank"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </div>

    
        <div class="dash-body">
        <header class="page-header">
        </header>

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; padding: 12px 16px; border-radius: 8px; color: #4ade80; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <i class="ph ph-check-circle" style="font-size: 18px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="table-section glass-panel">
           <div class="table-toolbar">
    <h2><i class="ph ph-list"></i> Liste des équipements</h2>
    
    <div class="table-filters">
        <span class="badge-count-total">{{ $stats['devices_actifs'] ?? 0 }} Actifs</span>
        
        <a href="{{ route('devices.create') }}" class="btn-primary" style="white-space: nowrap;">
            <i class="ph ph-plus"></i> Ajouter un équipement
        </a>
        
        <form action="{{ route('devices.index') }}" method="GET" class="filter-form">
            <div style="position: relative; display: inline-flex; align-items: center;">
                <select name="statut" onchange="this.form.submit()" class="filter-select">
                    <option value="">Tous les statuts</option>
                    <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="en_reparation" {{ request('statut') == 'en_reparation' ? 'selected' : '' }}>En réparation</option>
                    <option value="hors_service" {{ request('statut') == 'hors_service' ? 'selected' : '' }}>Hors service</option>
                    <option value="stock" {{ request('statut') == 'stock' ? 'selected' : '' }}>En stock</option>
                    <option value="recycle" {{ request('statut') == 'recycle' ? 'selected' : '' }}>À recycler</option>
                </select>
                <i class="ph ph-faders" style="position: absolute; right: 12px; color: #000205; pointer-events: none;"></i>
            </div>
        </form>
    </div>
</div>

            <div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Équipement</th>
                            <th>Type</th>
                            <th>Responsable</th>
                            <th>Puissance</th>
                            <th>Conso/an</th>
                            <th>CO₂/an</th>
                            <th>Score</th>
                            <th>Statut</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($devices as $device)
                            <tr>
                                <td>
                                    <span class="device-title">{{ $device->nom }}</span>
                                    <span class="device-meta">{{ $device->marque }} {{ $device->modele }}</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px; color: #94a3b8;">{{ $device->type }}</span>
                                </td>
                                <td>
                                    @if($device->user)
                                        <div style="display: flex; align-items: center; gap: 6px; font-size: 13px;">
                                            <i class="ph ph-user" style="color: #22c55e;"></i>
                                            <span>{{ $device->user->name }}</span>
                                        </div>
                                    @else
                                        <span style="color: #64748b; font-size: 13px; font-style: italic;">Non assigné</span>
                                    @endif
                                </td>
                                <td>{{ $device->puissance_watt ? number_format($device->puissance_watt, 0) . ' W' : '-' }}</td>
                                <td>{{ $device->conso_annuelle_kwh ? number_format($device->conso_annuelle_kwh, 0) . ' kWh' : '-' }}</td>
                                <td>{{ $device->emission_co2_kg ? number_format($device->emission_co2_kg, 0) . ' kg' : '-' }}</td>
                                <td>
                                    <div class="score-badge score-{{ $device->score_green_it >= 70 ? 'good' : ($device->score_green_it >= 40 ? 'medium' : 'bad') }}">
                                        {{ $device->score_green_it }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-status status-{{ $device->statut }}">
                                        {{ 
                                            $device->statut == 'actif' ? 'Actif' :
                                            ($device->statut == 'stock' ? 'Stock' :
                                            ($device->statut == 'en_reparation' ? 'Réparation' :
                                            ($device->statut == 'hors_service' ? 'Hors service' : 'À recycler')))
                                        }}
                                    </span>
                                </td>
                                <td style="text-align: right;">
    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
        <!-- Bouton Supprimer toujours visible (cercle rouge) -->
        <form action="{{ route('devices.destroy', $device) }}" method="POST" class="inline-form" style="display: inline-flex;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete-circle" title="Supprimer" onclick="return confirm('Supprimer « {{ $device->nom }} » ?')">
                <i class="ph ph-trash"></i>
            </button>
        </form>
        
        <!-- Dropdown pour les autres actions -->
        <div class="actions-dropdown" style="position: relative; display: inline-block;">
            <button type="button" class="btn-icon btn-dots" onclick="toggleDropdown(this)" title="Actions">
                <i class="ph ph-dots-three-vertical"></i>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('devices.show', $device) }}" class="dropdown-item">
                    <i class="ph ph-eye"></i>
                    <span>Voir les détails</span>
                </a>
                <a href="{{ route('devices.edit', $device) }}" class="dropdown-item">
                    <i class="ph ph-pencil-simple"></i>
                    <span>Modifier l'équipement</span>
                </a>
              
            </div>
        </div>
    </div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" style="text-align: center; padding: 40px; color: #64748b;">
                                    <i class="ph ph-desktop" style="font-size: 48px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                                    <p>Aucun équipement enregistré dans le parc informatique.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($devices->hasPages())
                <div style="margin-top: 20px;">
                    {{ $devices->links() }}
                </div>
            @endif
        </div>
    </div>
    </main>
   <script>
document.addEventListener('DOMContentLoaded', function() {
    /* ── SIDEBAR TOGGLE ── */
    const sidebar = document.getElementById('sidebar');
    const toggle  = document.getElementById('sidebarToggle');
    const icon    = toggle.querySelector('i');

    if (localStorage.getItem('sbCollapsed') === 'true') {
        sidebar.classList.add('collapsed');
        icon.classList.replace('ph-caret-left', 'ph-caret-right');
    }

    toggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        const c = sidebar.classList.contains('collapsed');
        icon.classList.replace(
            c ? 'ph-caret-left' : 'ph-caret-right',
            c ? 'ph-caret-right' : 'ph-caret-left'
        );
        localStorage.setItem('sbCollapsed', c);
    });

    /* ── DROPDOWN ACTIONS ── */
    window.toggleDropdown = function(btn) {
        const dropdown = btn.closest('.actions-dropdown');
        const isActive = dropdown.classList.contains('active');
        
        // Fermer tous les dropdowns ouverts
        document.querySelectorAll('.actions-dropdown.active').forEach(d => {
            d.classList.remove('active');
        });
        
        // Ouvrir celui-ci s'il n'était pas déjà actif
        if (!isActive) {
            dropdown.classList.add('active');
        }
    };

    // Fermer en cliquant ailleurs
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.actions-dropdown')) {
            document.querySelectorAll('.actions-dropdown.active').forEach(d => {
                d.classList.remove('active');
            });
        }
    });
});
</script>
</body>
</html>