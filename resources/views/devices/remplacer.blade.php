<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Équipements à remplacer — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/devices-index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/remplacer.css') }}">

   
</head>
<body>

<div class="page-wrapper">

    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('devices.index') }}"><i class="ph ph-house"></i> Parc informatique</a>
        <i class="ph ph-caret-right"></i>
        <span class="breadcrumb-current">Équipements à remplacer</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <div class="header-title">
            <div class="header-icon">
                <i class="ph ph-warning"></i>
            </div>
            <div class="header-text">
                <h1>Équipements à remplacer</h1>
                <p>{{ $devices->count() }} équipement{{ $devices->count() > 1 ? 's' : '' }} nécessite{{ $devices->count() > 1 ? 'nt' : '' }} votre attention</p>
            </div>
        </div>
        <div class="header-actions">
            <a href="{{ route('devices.index') }}" class="btn btn-secondary">
                <i class="ph ph-arrow-left"></i> Retour au parc
            </a>
        </div>
    </div>

    <!-- Message -->
    @if(session('success'))
        <div class="alert alert-success" style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <i class="ph ph-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Résumé -->
    <div class="summary-bar">
        <div class="summary-item">
            <i class="ph ph-recycle"></i>
            <span><strong>{{ $stats['a_recycler'] ?? 0 }}</strong> à recycler</span>
        </div>
        <div class="summary-item">
            <i class="ph ph-clock-countdown"></i>
            <span><strong>{{ $stats['age_depasse'] ?? 0 }}</strong> âge dépassé</span>
        </div>
        <div class="summary-item">
            <i class="ph ph-coin"></i>
            <span>Coût estimé : <strong>{{ number_format($stats['cout_total'] ?? 0, 0) }} MAD</strong></span>
        </div>
    </div>

    <!-- Grille -->
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
                    <div class="card-body">
                        
                        <!-- Header card -->
                        <div class="card-header">
                            <div class="card-info">
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
                                <div class="card-title-group">
                                    <span class="card-title">{{ $device->nom }}</span>
                                    <span class="card-type">{{ $device->type }} — {{ $device->marque ?? 'Sans marque' }}</span>
                                </div>
                            </div>
                            <span class="card-badge {{ $badgeClass }}">
                                {{ implode(' + ', $raisons) }}
                            </span>
                        </div>

                        <!-- Détails -->
                        <div class="card-details">
                            @if($device->user)
                                <div class="detail-row">
                                    <i class="ph ph-user"></i>
                                    <span>Assigné à <strong>{{ $device->user->name }}</strong></span>
                                </div>
                            @endif
                            
                            @if($device->localisation)
                                <div class="detail-row">
                                    <i class="ph ph-map-pin"></i>
                                    <span>{{ $device->localisation }}</span>
                                </div>
                            @endif
                            
                            <div class="detail-row">
                                <i class="ph ph-calendar"></i>
                                <span>Achat : <span class="highlight">{{ $device->date_achat?->format('d/m/Y') ?? 'Non renseigné' }}</span></span>
                            </div>
                            
                            @if($age !== null)
                                <div class="detail-row">
                                    <i class="ph ph-clock"></i>
                                    <span>Âge actuel : <span class="highlight">{{ $age }} an{{ $age > 1 ? 's' : '' }}</span> / Durée de vie : {{ $device->duree_vie_annees }} ans</span>
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

                        <!-- Mini stats -->
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

                        <!-- Actions -->
                        <div class="card-actions">
                            <a href="{{ route('devices.show', $device) }}" class="btn-card btn-card-primary">
                                <i class="ph ph-eye"></i> Voir détails
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
            <i class="ph ph-check-circle"></i>
            <h2>Tout va bien !</h2>
            <p>Aucun équipement ne nécessite de remplacement pour le moment.</p>
            <a href="{{ route('devices.index') }}" class="btn btn-primary">
                <i class="ph ph-arrow-left"></i> Retour au parc
            </a>
        </div>
    @endif

</div>

</body>
</html>