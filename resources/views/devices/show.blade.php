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