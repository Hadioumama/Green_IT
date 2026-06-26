<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Équipements à remplacer — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
/* ═══════════════════════════════════════════════════════ */
/* GREEN IT — ALERTS & REPLACEMENTS DESIGN v3            */
/* ═══════════════════════════════════════════════════════ */

:root {
    --green-primary:   #10b981;
    --green-bright:    #34d399;
    --green-dark:      #059669;
    --green-glow:      rgba(16,185,129,0.28);
    --green-soft:      rgba(16, 185, 129, 0.1);

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

/* Coque centrale identique aux autres pages */
.shell {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    width: min(1380px, 85vw);
    min-height: min(860px, 85vh);
    background: rgba(143, 158, 151, 0.45);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    border-radius: var(--r-lg);
    border: 1px solid rgba(52,211,153,0.18);
    box-shadow:
        0 32px 80px rgba(0,0,0,0.45),
        0 0 40px rgba(16,185,129,0.06) inset,
        0 1px 0 rgba(255,255,255,0.12) inset;
    padding: 30px;
    gap: 20px;
    animation: shellIn 0.8s cubic-bezier(.4,0,.2,1) both;
}

@keyframes shellIn {
    from { opacity:0; transform:scale(0.97) translateY(14px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}

/* Fil d'ariane / Breadcrumb */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--text-2);
    opacity: 0.8;
}
.breadcrumb a {
    color: var(--green-bright);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.2s;
}
.breadcrumb a:hover { color: #fff; }

/* En-tête */
.topbar-custom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-dim);
}
.title-badge {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: rgba(1, 16, 11, 0.97);
    border: 1px solid var(--red);
    border-radius: 20px;
    padding: 10px 16px;
    font-family: 'Rajdhani', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--red);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    box-shadow: 0 0 15px rgba(239, 68, 68, 0.2);
}
.title-badge-text h1 { font-size: 16px; font-weight: 700; }
.title-badge-text p { font-size: 11px; color: var(--text-2); font-family: 'Exo 2', sans-serif; text-transform: none; font-weight: 400; letter-spacing: 0; }

/* Barre de résumé / KPI */
.summary-strip {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}
.summary-card {
    background: rgba(255,255,255,0.055);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--r);
    padding: 14px 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    backdrop-filter: blur(8px);
}
.summary-card i {
    font-size: 22px;
    width: 38px;
    height: 38px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.sum-recycle i { background: rgba(16,185,129,0.15); color: var(--green-bright); }
.sum-clock i { background: rgba(245,158,11,0.15); color: var(--amber); }
.sum-cost i { background: rgba(59,130,246,0.15); color: var(--blue); }

.summary-card-info { display: flex; flex-direction: column; }
.summary-card-info span { font-size: 11px; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.05em; }
.summary-card-info strong { font-family: 'Rajdhani', sans-serif; font-size: 20px; color: var(--text-1); font-weight: 700; }

/* Grille des cartes matériels */
.devices-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 16px;
    overflow-y: auto;
    padding-right: 4px;
}
.devices-grid::-webkit-scrollbar { width: 6px; }
.devices-grid::-webkit-scrollbar-thumb { background: rgba(52,211,153,0.3); border-radius: 5px; }

/* Design des cartes Glassmorphism */
.device-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--r);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: all 0.25s ease;
}
.device-card:hover {
    border-color: rgba(52,211,153,0.3);
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.3);
}

/* Indicateur de gravité */
.card-urgency-bar {
    position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: var(--amber);
}
.card-urgency-bar.critical {
    background: var(--red);
    box-shadow: 0 2px 10px rgba(239, 68, 68, 0.5);
}

.card-inner { padding: 18px; display: flex; flex-direction: column; gap: 14px; flex: 1; }

.card-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; }
.card-meta { display: flex; align-items: center; gap: 10px; }
.card-icon {
    width: 36px; height: 36px; border-radius: 8px;
    background: rgba(255,255,255,0.06);
    color: var(--text-2);
    display: flex; align-items: center; justify-content: center; font-size: 20px;
}
.card-identity { display: flex; flex-direction: column; }
.card-name { font-size: 14px; font-weight: 600; color: #fff; }
.card-type { font-size: 11px; color: rgba(255,255,255,0.5); }

/* Badges d'état */
.card-badge {
    padding: 3px 8px; border-radius: 6px; font-size: 10px; font-weight: 700;
    font-family: 'Rajdhani', sans-serif; text-transform: uppercase; white-space: nowrap;
}
.badge-recycle { background: rgba(16,185,129,0.15); color: var(--green-bright); border: 1px solid rgba(16,185,129,0.3); }
.badge-aged { background: rgba(245,158,11,0.15); color: var(--amber); border: 1px solid rgba(245,158,11,0.3); }
.badge-both { background: rgba(239,68,68,0.15); color: var(--red); border: 1px solid rgba(239,68,68,0.3); }

/* Lignes de spécifications */
.card-details { display: flex; flex-direction: column; gap: 6px; }
.detail-row { display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--text-2); }
.detail-row i { color: var(--green-primary); font-size: 14px; width: 16px; text-align: center; }
.highlight { color: #fff; font-weight: 500; }
.highlight-green { color: var(--green-bright); font-weight: 600; }

/* Tableau miniature de statistiques */
.card-stats {
    display: grid; grid-template-columns: repeat(3, 1fr);
    background: rgba(0,0,0,0.15); border-radius: 8px; padding: 8px; text-align: center;
}
.mini-stat { display: flex; flex-direction: column; }
.mini-stat-value { font-family: 'Rajdhani', sans-serif; font-size: 13px; font-weight: 700; color: #fff; }
.mini-stat-label { font-size: 9px; color: rgba(255,255,255,0.4); text-transform: uppercase; margin-top: 1px; }

/* Boutons d'actions */
.card-actions { display: flex; gap: 8px; margin-top: auto; }
.btn-card {
    flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;
    text-decoration: none; transition: all 0.2s; border: none; cursor: pointer;
}
.btn-card-primary { background: rgba(24, 218, 153, 0.9); color:#fff; border: 1px solid rgba(16, 185, 129, 0.3); }
.btn-card-primary:hover { background: var(--green-primary); color: #fff; border-color: transparent; }
.btn-card-secondary { background: rgba(255,255,255,0.05); color: var(--text-2); }
.btn-card-secondary:hover { background: rgba(255,255,255,0.1); color: #fff; }

/* Boutons globaux */
.btn {
    display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px;
    border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;
    transition: all 0.2s; text-decoration: none; border: none;
}
.btn-primary {
    background: linear-gradient(135deg, var(--green-primary), var(--green-dark)); color: #fff;
    box-shadow: 0 4px 18px rgba(16,185,129,0.3);
}
.btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }
.btn-secondary { background: rgba(255,255,255,0.06); color: var(--text-2); border: 1px solid rgba(255,255,255,0.12); }
.btn-secondary:hover { background: rgba(255,255,255,0.1); color: #fff; }

/* État vide */
.empty-state-large {
    text-align: center; padding: 60px 20px; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 12px; flex: 1;
}
.empty-state-large i { font-size: 50px; color: var(--green-bright); filter: drop-shadow(0 0 10px var(--green-glow)); }
.empty-state-large h2 { font-family: 'Rajdhani', sans-serif; font-size: 24px; font-weight: 700; color: #fff; }
.empty-state-large p { font-size: 14px; color: var(--text-2); opacity: 0.7; max-width: 400px; margin-bottom: 8px; }
</style>
</head>
<body>

<div class="shell">

    <nav class="breadcrumb">
        <a href="{{ route('devices.index') }}"><i class="ph ph-desktop"></i> Parc informatique</a>
        <i class="ph ph-caret-right"></i>
        <span style="color: rgba(255,255,255,0.5);">Équipements à remplacer</span>
    </nav>

    <div class="topbar-custom">
        <div class="title-badge">
            <i class="ph ph-warning"></i>
            <div class="title-badge-text" style="text-align: left;">
                <h1>Équipements à remplacer</h1>
                <p>{{ $devices->count() }} équipement{{ $devices->count() > 1 ? 's' : '' }} nécessite{{ $devices->count() > 1 ? 'nt' : '' }} votre attention</p>
            </div>
        </div>
        <div>
            <a href="{{ route('devices.index') }}" class="btn btn-secondary">
                <i class="ph ph-arrow-left"></i> Retour au parc
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid var(--green-bright); color: var(--green-bright); padding: 12px 16px; border-radius: 8px; font-size: 13px; display: flex; align-items: center; gap: 8px;">
            <i class="ph ph-check-circle" style="font-size: 18px;"></i> {{ session('success') }}
        </div>
    @endif

    <div class="summary-strip">
        <div class="summary-card sum-recycle">
            <i class="ph ph-recycle"></i>
            <div class="summary-card-info">
                <span>À recycler</span>
                <strong>{{ $stats['a_recycler'] ?? 0 }}</strong>
            </div>
        </div>
        <div class="summary-card sum-clock">
            <i class="ph ph-clock-countdown"></i>
            <div class="summary-card-info">
                <span>Âge dépassé</span>
                <strong>{{ $stats['age_depasse'] ?? 0 }}</strong>
            </div>
        </div>
        <div class="summary-card sum-cost">
            <i class="ph ph-coin"></i>
            <div class="summary-card-info">
                <span>Coût estimé</span>
                <strong>{{ number_format($stats['cout_total'] ?? 0, 0) }} MAD</strong>
            </div>
        </div>
    </div>

    @if($devices->count() > 0)
        <div class="devices-grid">
            @foreach($devices as $device)
                @php
                    $raisons = [];
                    $isCritical = false;
                    
                    if ($device->statut === 'recycle') {
                        $raisons[] = 'À recycler';
                    }
                    
                    $age = $device->date_achat ? now()->diffInYears($device->date_achat) : null;
                    $ageDepasse = false;
                    if ($age !== null && $device->duree_vie_annees && $age >= $device->duree_vie_annees) {
                        $raisons[] = "Âge dépassé ({$age}/{$device->duree_vie_annees} ans)";
                        $ageDepasse = true;
                    }
                    
                    if ($device->statut === 'recycle' && $ageDepasse) {
                        $isCritical = true;
                    }
                    
                    $badgeClass = $isCritical ? 'badge-both' : ($device->statut === 'recycle' ? 'badge-recycle' : 'badge-aged');
                @endphp

                <div class="device-card">
                    <div class="card-urgency-bar {{ $isCritical ? 'critical' : '' }}"></div>
                    <div class="card-inner">
                        
                        <div class="card-top">
                            <div class="card-meta">
                                <div class="card-icon">
                                    <i class="ph ph-{{ 
                                        $device->type == 'PC' ? 'desktop' :
                                        ($device->type == 'Serveur' ? 'hard-drives' :
                                        ($device->type == 'Switch' ? 'network' :
                                        ($device->type == 'Routeur' ? 'wifi-high' :
                                        ($device->type == 'Imprimante' ? 'printer' :
                                        ($device->type == 'Écran' ? 'monitor' :
                                        ($device->type == 'Onduleur' ? 'battery-charging' : 'device-mobile'))))))
                                    }}"></i>
                                </div>
                                <div class="card-identity">
                                    <span class="card-name">{{ $device->nom }}</span>
                                    <span class="card-type">{{ $device->type }} — {{ $device->marque ?? 'Sans marque' }}</span>
                                </div>
                            </div>
                            <span class="card-badge {{ $badgeClass }}">
                                {{ implode(' + ', $raisons) }}
                            </span>
                        </div>

                        <div class="card-details">
                            @if($device->user)
                                <div class="detail-row">
                                    <i class="ph ph-user"></i>
                                    <span>Assigné à <strong class="highlight">{{ $device->user->name }}</strong></span>
                                </div>
                            @endif
                            
                            @if($device->localisation)
                                <div class="detail-row">
                                    <i class="ph ph-map-pin"></i>
                                    <span class="highlight">{{ $device->localisation }}</span>
                                </div>
                            @endif
                            
                            <div class="detail-row">
                                <i class="ph ph-calendar"></i>
                                <span>Achat : <span class="highlight">{{ $device->date_achat?->format('d/m/Y') ?? 'Non renseigné' }}</span></span>
                            </div>
                            
                            @if($age !== null)
                                <div class="detail-row">
                                    <i class="ph ph-clock"></i>
                                    <span>Âge actuel : <span class="highlight">{{ $age }} an{{ $age > 1 ? 's' : '' }}</span> / {{ $device->duree_vie_annees }} ans max</span>
                                </div>
                            @endif
                            
                            <div class="detail-row">
                                <i class="ph ph-lightning"></i>
                                <span>Consommation : <span class="highlight-green">{{ number_format($device->conso_annuelle_kwh ?? 0, 0) }} kWh/an</span></span>
                            </div>
                            
                            <div class="detail-row">
                                <i class="ph ph-cloud"></i>
                                <span>Émissions : <span class="highlight">{{ number_format($device->emission_co2_kg ?? 0, 0) }} kg CO₂/an</span></span>
                            </div>
                        </div>

                        <div class="card-stats">
                            <div class="mini-stat">
                                <div class="mini-stat-value">{{ number_format($device->puissance_watt ?? 0, 0) }} W</div>
                                <div class="mini-stat-label">Puissance</div>
                            </div>
                            <div class="mini-stat">
                                <div class="mini-stat-value">{{ number_format($device->empreinte_carbone_fab ?? 0, 0) }} kg</div>
                                <div class="mini-stat-label">Fab. CO₂</div>
                            </div>
                            <div class="mini-stat">
                                <div class="mini-stat-value">{{ number_format($device->cout_energie_annuel ?? 0, 0) }} MAD</div>
                                <div class="mini-stat-label">Coût/an</div>
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('devices.show', $device) }}" class="btn-card btn-card-primary">
                                <i class="ph ph-eye"></i> Détails
                            </a>
                            <a href="{{ route('devices.edit', $device) }}" class="btn-card btn-card-secondary">
                                <i class="ph ph-pencil"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state-large">
            <i class="ph ph-sparkles"></i>
            <h2>Tout va bien !</h2>
            <p>Félicitations, aucun équipement de votre parc informatique ne nécessite de remplacement ou n'a dépassé sa durée de vie.</p>
            <a href="{{ route('devices.index') }}" class="btn btn-primary" style="margin-top: 10px;">
                <i class="ph ph-arrow-left"></i> Retour au parc
            </a>
        </div>
    @endif

</div>

</body>
</html>