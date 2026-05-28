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


        /* ═══════════════════════════════════════════════ */
        /* SIDEBAR (Barre latérale gauche) */
        /* ═══════════════════════════════════════════════ */
        .sidebar {
            width: 260px;
            background: #111613;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
            flex-shrink: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            padding-left: 8px;
        }

        .brand-logo-box {
            width: 36px;
            height: 36px;
            background: #22c55e;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111613;
            font-size: 20px;
            box-shadow: 0 0 15px rgba(34, 197, 94, 0.4);
        }

        .brand-name {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #ffffff;
        }

        .sidebar-menu-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #22c55e;
            letter-spacing: 1.5px;
            margin-bottom: 16px;
            padding-left: 8px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-link i {
            font-size: 18px;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.03);
            color: #ffffff;
        }

        .sidebar-item.active .sidebar-link {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            border-left: 3px solid #22c55e;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .sidebar-link .badge-count {
            margin-left: auto;
            background: #dc2626;
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
        }

        /* ═══════════════════════════════════════════════ */
        /* MAIN CONTENT AREA */
        /* ═══════════════════════════════════════════════ */
        .main-content {
            flex-grow: 1;
            padding: 32px;
            overflow-y: auto;
        }

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
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
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
            padding: 24px;
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
            background: #161f1a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
            padding: 8px 36px 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            outline: none;
        }

        .table-responsive {
            overflow-x: auto;
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
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo-box">
                <i class="ph ph-leaf"></i>
            </div>
            <span class="brand-name">GREEN IT</span>
        </div>

        <div class="sidebar-menu-wrapper">
            <p class="sidebar-menu-title">Principal</p>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="ph ph-squares-four"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item active">
                    <a href="{{ route('devices.index') }}" class="sidebar-link">
                        <i class="ph ph-desktop"></i>
                        <span>Parc informatique</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="ph ph-lightning"></i>
                        <span>Consommation</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="ph ph-warning"></i>
                        <span>Alertes</span>
                        @if(isset($devicesAremplacer) && $devicesAremplacer->count() > 0)
                            <span class="badge-count">{{ $devicesAremplacer->count() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <main class="main-content">
        
        <header class="page-header">
            <div class="header-title-wrapper">
                <h1>Parc informatique</h1>
                <span class="subtitle">Gestion énergétique et empreinte carbone de vos équipements</span>
            </div>
            
            <div class="header-actions">
                <a href="{{ route('devices.create') }}" class="btn-primary">
                    <i class="ph ph-plus"></i> Ajouter un équipement
                </a>
            </div>
        </header>

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; padding: 12px 16px; border-radius: 8px; color: #4ade80; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <i class="ph ph-check-circle" style="font-size: 18px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card glass-panel stat-blue">
                <i class="ph ph-desktop"></i>
                <div class="stat-info">
                    <span class="stat-value">{{ $stats['total_devices'] ?? 0 }}</span>
                    <span class="stat-label">Équipements</span>
                </div>
            </div>
            
            <div class="stat-card glass-panel stat-green">
                <i class="ph ph-lightning"></i>
                <div class="stat-info">
                    <span class="stat-value">{{ number_format($stats['total_conso_kwh'] ?? 0, 0, ',', ' ') }}</span>
                    <span class="stat-label">kWh / an</span>
                </div>
            </div>
            
            <div class="stat-card glass-panel stat-orange">
                <i class="ph ph-cloud"></i>
                <div class="stat-info">
                    <span class="stat-value">{{ number_format($stats['total_emission_co2'] ?? 0, 0, ',', ' ') }}</span>
                    <span class="stat-label">kg CO₂ / an</span>
                </div>
            </div>
            
            <div class="stat-card glass-panel stat-red">
                <i class="ph ph-factory"></i>
                <div class="stat-info">
                    <span class="stat-value">{{ number_format($stats['total_fabrication_co2'] ?? 0, 0, ',', ' ') }}</span>
                    <span class="stat-label">kg CO₂ Fab.</span>
                </div>
            </div>
            
            <div class="stat-card glass-panel stat-purple">
                <i class="ph ph-warning"></i>
                <div class="stat-info">
                    <span class="stat-value">{{ $stats['devices_a_remplacer'] ?? 0 }}</span>
                    <span class="stat-label">À remplacer</span>
                </div>
            </div>
        </div>

        <div class="table-section glass-panel">
            <div class="table-toolbar">
                <h2><i class="ph ph-list"></i> Liste des équipements</h2>
                
                <div class="table-filters">
                    <span class="badge-count-total">{{ $stats['devices_actifs'] ?? 0 }} Actifs</span>
                    
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
                            <i class="ph ph-faders" style="position: absolute; right: 12px; color: #94a3b8; pointer-events: none;"></i>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
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
                                <td>
                                    <div class="actions" style="justify-content: flex-end;">
                                        <a href="{{ route('devices.show', $device) }}" class="btn-icon" title="Voir"><i class="ph ph-eye"></i></a>
                                        <a href="{{ route('devices.edit', $device) }}" class="btn-icon" title="Modifier"><i class="ph ph-pencil"></i></a>
                                        <form action="{{ route('devices.destroy', $device) }}" method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-delete" title="Supprimer" onclick="return confirm('Supprimer « {{ $device->nom }} » ?')">
                                                <i class="ph ph-trash"></i>
                                            </button>
                                        </form>
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

    </main>
</body>
</html>