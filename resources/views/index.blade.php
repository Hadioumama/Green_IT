<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Parc informatique — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/devices-index.css') }}">
<style>
    /* ═══════════════════════════════════════════════ */
/* HEADER AVEC ALERTE BADGE */
/* ═══════════════════════════════════════════════ */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    padding: 0 4px;
}

.header-brand {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

/* ═══════════════════════════════════════════════ */
/* BADGE ALERTE (petit carré) */
/* ═══════════════════════════════════════════════ */

.alert-badge {
    position: relative;
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #f97316, #ea580c);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(249, 115, 22, 0.3);
}

.alert-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
}

.alert-badge i {
    font-size: 20px;
    color: white;
}

.alert-count {
    position: absolute;
    top: -6px;
    right: -6px;
    width: 20px;
    height: 20px;
    background: #dc2626;
    color: white;
    border-radius: 50%;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
}
/* ═══════════════════════════════════════════════ */
/* INFOBULLE AVEC LISTE COMPLÈTE */
/* ═══════════════════════════════════════════════ */

.alert-tooltip {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    width: 320px;
    max-height: 400px;           /* Hauteur max */
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: 1px solid #fed7aa;
    padding: 16px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    
    /* Flexbox pour structure */
    display: flex;
    flex-direction: column;
}

/* Flèche */
.alert-tooltip::before {
    content: '';
    position: absolute;
    top: -6px;
    right: 16px;
    width: 12px;
    height: 12px;
    background: white;
    border-left: 1px solid #fed7aa;
    border-top: 1px solid #fed7aa;
    transform: rotate(45deg);
}

/* Afficher au survol */
.alert-badge:hover .alert-tooltip {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Header */
.tooltip-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    padding-bottom: 10px;
    border-bottom: 1px solid #f1f5f9;
    flex-shrink: 0;            /* Ne pas rétrécir */
}

.tooltip-header i {
    font-size: 18px;
    color: #f97316;
}

.tooltip-header span {
    font-size: 14px;
    font-weight: 600;
    color: #7c2d12;
}

/* Liste complète avec scroll */
.tooltip-list-full {
    overflow-y: auto;          /* Scroll vertical */
    max-height: 280px;         /* Hauteur avant scroll */
    display: flex;
    flex-direction: column;
    gap: 6px;
    
    /* Style de la scrollbar */
    scrollbar-width: thin;
    scrollbar-color: #f97316 #fff7ed;
}

.tooltip-list-full::-webkit-scrollbar {
    width: 6px;
}

.tooltip-list-full::-webkit-scrollbar-track {
    background: #fff7ed;
    border-radius: 3px;
}

.tooltip-list-full::-webkit-scrollbar-thumb {
    background: #f97316;
    border-radius: 3px;
}

/* Item cliquable */
.tooltip-item-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 12px;
    background: #fff7ed;
    border-radius: 8px;
    border-left: 3px solid #f97316;
    text-decoration: none;
    transition: all 0.2s;
}

.tooltip-item-link:hover {
    background: #ffedd5;
    transform: translateX(4px);
}

.tooltip-item-main {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.tooltip-name {
    font-size: 13px;
    font-weight: 600;
    color: #7c2d12;
}

.tooltip-reason {
    font-size: 11px;
    color: #c2410c;
}

.tooltip-item-link > i {
    color: #f97316;
    font-size: 16px;
}

/* Footer */
.tooltip-footer {
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px dashed #fed7aa;
    text-align: center;
    flex-shrink: 0;
}

.tooltip-hint {
    font-size: 11px;
    color: #9a3412;
    font-style: italic;
}

/* ═══════════════════════════════════════════════ */
/* BOUTON AJOUTER (inchangé) */
/* ═══════════════════════════════════════════════ */

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: #22c55e;
    color: white;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 4px 14px rgba(34, 197, 94, 0.3);
}

.btn-primary:hover {
    background: #16a34a;
    transform: translateY(-1px);
}
/* ═══════════════════════════════════════════════ */
/* MODAL - Liste complète */
/* ═══════════════════════════════════════════════ */

.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.2s ease;
}

.modal-overlay.active {
    display: flex;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content {
    background: white;
    border-radius: 16px;
    width: 90%;
    max-width: 600px;
    max-height: 80vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from { 
        opacity: 0;
        transform: translateY(30px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

/* Header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #f1f5f9;
}

.modal-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 600;
    color: #7c2d12;
}

.modal-title i {
    font-size: 22px;
    color: #f97316;
}

.modal-count {
    background: #f97316;
    color: white;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
}

.modal-close {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    background: #f1f5f9;
    color: #64748b;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.modal-close:hover {
    background: #e2e8f0;
    color: #334155;
}

/* Body avec scroll */
.modal-body {
    overflow-y: auto;
    padding: 16px 24px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.tooltip-more {
    display: inline-block;
    margin-top: 12px;
    padding: 6px 12px;
    background-color: #e76d26;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.tooltip-more:hover {
    background-color: #d34b15;
    transform: translateX(3px);
}
/* Item du modal */
.modal-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: #fff7ed;
    border-radius: 12px;
</style>
</head>
<body>
<!-- HEADER -->
<header class="page-header">
    <div class="header-brand">
        <i class="ph ph-leaf brand-icon"></i>
        <div>
            <h1>Parc informatique</h1>
            <span class="subtitle">Gestion énergétique et empreinte carbone</span>
        </div>
    </div>
    
    <!-- ═══════════════════════════════════════════════ -->
    <!-- ZONE DROITE : Alerte + Bouton -->
    <!-- ═══════════════════════════════════════════════ -->
    <div class="header-actions">
        @if($devicesAremplacer->count() > 0)
        <!-- Petit carré alerte -->
        <div class="alert-badge" id="alertBadge">
            <i class="ph ph-warning"></i>
            <span class="alert-count">{{ $devicesAremplacer->count() }}</span>
            <!-- Infobulle (aperçu au survol) -->
            <div class="alert-tooltip" id="alertTooltip">
                <!-- Vue APERÇU (par défaut) -->
                <div class="tooltip-view" id="tooltipPreview">
                    <div class="tooltip-header">
                        <i class="ph ph-warning-circle"></i>
                        <span>Équipements à remplacer</span>
                    </div>
                    <div class="tooltip-list">
                        @foreach($devicesAremplacer->take(5) as $device)
                            @php
                                $raisons = [];
                                if ($device->statut === 'recycle') $raisons[] = 'À recycler';
                                $age = $device->date_achat ? now()->diffInYears($device->date_achat) : null;
                                if ($age !== null && $device->duree_vie_annees && $age >= $device->duree_vie_annees) {
                                    $raisons[] = "Âge dépassé";
                                }
                            @endphp
                            <div class="tooltip-item">
                                <span class="tooltip-name">{{ $device->nom }}</span>
                                <span class="tooltip-reason">{{ implode(' + ', $raisons) }}</span>
                            </div>
                        @endforeach
                        @if($devicesAremplacer->count()>3)
                            <a href="{{ route('devices.remplacer') }}" class="tooltip-more">
                             Voir les {{ $devicesAremplacer->count() }} équipements →
                           </a>
@endif
                    </div>
                    
                </div>
                
                <!-- Vue COMPLÈTE (cachée par défaut) -->
                <div class="tooltip-view tooltip-full" id="tooltipFull" style="display: none;">
                    <div class="tooltip-header">
                        <button class="btn-back" onclick="showPreview(event)">
                            <i class="ph ph-arrow-left"></i>
                        </button>
                        <span>Tous les équipements à remplacer</span>
                    </div>
                    <div class="tooltip-list tooltip-list-scroll">
                        @foreach($devicesAremplacer as $device)
                            @php
                                $raisons = [];
                                if ($device->statut === 'recycle') $raisons[] = 'À recycler';
                                $age = $device->date_achat ? now()->diffInYears($device->date_achat) : null;
                                if ($age !== null && $device->duree_vie_annees && $age >= $device->duree_vie_annees) {
                                    $raisons[] = "Âge dépassé ({$age}/{$device->duree_vie_annees} ans)";
                                }
                                $raisonTexte = implode(' + ', $raisons) ?: 'À remplacer';
                            @endphp
                            <a href="{{ route('devices.show', $device) }}" class="tooltip-item tooltip-item-link">
                                <div class="tooltip-item-main">
                                    <span class="tooltip-name">{{ $device->nom }}</span>
                                    <span class="tooltip-reason">{{ $raisonTexte }}</span>
                                </div>
                                <i class="ph ph-caret-right"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
        @endif
       
        <a href="{{ route('devices.create') }}" class="btn btn-primary">
            <i class="ph ph-plus"></i> Ajouter un équipement
        </a>
    </div>
</header>

    <!-- MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="ph ph-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS CARDS -->
    <div class="stats-grid">
        <div class="stat-card stat-blue">
            <i class="ph ph-desktop"></i>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['total_devices'] }}</span>
                <span class="stat-label">Équipements</span>
            </div>
        </div>
        
        <div class="stat-card stat-green">
            <i class="ph ph-lightning"></i>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($stats['total_conso_kwh'], 0) }}</span>
                <span class="stat-label">kWh/an</span>
            </div>
        </div>
        
        <div class="stat-card stat-orange">
            <i class="ph ph-cloud"></i>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($stats['total_emission_co2'], 0) }}</span>
                <span class="stat-label">kg CO₂/an</span>
            </div>
        </div>
        
        <div class="stat-card stat-red">
            <i class="ph ph-factory"></i>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($stats['total_fabrication_co2'], 0) }}</span>
                <span class="stat-label">kg CO₂ fab.</span>
            </div>
        </div>
        
        <div class="stat-card stat-purple">
            <i class="ph ph-warning"></i>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['devices_a_remplacer'] }}</span>
          
                <span class="stat-label">À remplacer</span>
            </div>
        </div>
    </div>

    <!-- TABLEAU -->
    <div class="table-card">
        <div class="table-header">
            <h2><i class="ph ph-list"></i> Liste des équipements</h2>
            <div class="table-filters">
                <span class="badge badge-actif">{{ $stats['devices_actifs'] }} actifs</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Équipement</th>
                        <th>Type</th>
                        <th>Responsable</th>
                        <th class="col-numeric">Puissance</th>
                        <th class="col-numeric">Conso/an</th>
                        <th class="col-numeric">CO₂/an</th>
                        <th class="col-numeric">Score</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($devices as $device)
                        <tr>
                            <!-- Nom + détails -->
                            <td>
                                <div class="device-name">
                                    <span class="device-title">{{ $device->nom }}</span>
                                    <span class="device-meta">{{ $device->marque }} {{ $device->modele }}</span>
                                </div>
                            </td>
                            
                            <!-- Type -->
                            <td>
                                <span class="badge-type badge-{{ strtolower($device->type) }}">
                                    {{ $device->type }}
                                </span>
                            </td>
                            
                            <!-- Responsable -->
                            <td>
                                @if($device->user)
                                    <div class="user-info">
                                        <i class="ph ph-user"></i>
                                        <span>{{ $device->user->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">Non assigné</span>
                                @endif
                            </td>
                            
                            <!-- Puissance -->
                            <td class="col-numeric">
                                <span class="value-watt">{{ $device->puissance_watt ? number_format($device->puissance_watt, 0) . ' W' : '-' }}</span>
                            </td>
                            
                            <!-- Consommation -->
                            <td class="col-numeric">
                                <span class="value-kwh">{{ $device->conso_annuelle_kwh ? number_format($device->conso_annuelle_kwh, 0) . ' kWh' : '-' }}</span>
                            </td>
                            
                            <!-- Émissions -->
                            <td class="col-numeric">
                                @if($device->emission_co2_kg)
                                    <span class="value-co2 {{ $device->emission_co2_kg > 100 ? 'co2-high' : 'co2-low' }}">
                                        {{ number_format($device->emission_co2_kg, 0) }} kg
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            
                            <!-- Score Green IT -->
                            <td class="col-numeric">
                                <div class="score-ring score-{{ $device->score_green_it >= 70 ? 'good' : ($device->score_green_it >= 40 ? 'medium' : 'bad') }}">
                                    {{ $device->score_green_it }}
                                </div>
                            </td>
                            
                            <!-- Statut -->
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
                            
                            <!-- Actions -->
                            <td>
                                <div class="actions">
                                    <a href="{{ route('devices.show', $device) }}" class="btn-icon btn-view" title="Voir">
                                        <i class="ph ph-eye"></i>
                                    </a>
                                    <a href="{{ route('devices.edit', $device) }}" class="btn-icon btn-edit" title="Modifier">
                                        <i class="ph ph-pencil"></i>
                                    </a>
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
                            <td colspan="9" class="empty-state">
                                <i class="ph ph-desktop"></i>
                                <p>Aucun équipement enregistré</p>
                                <a href="{{ route('devices.create') }}" class="btn btn-sm">Ajouter le premier</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $devices->links() }}
        </div>
    </div>

</div>
</body>
</html>