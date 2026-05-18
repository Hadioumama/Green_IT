<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Consommation Énergétique — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/energy.css') }}">
    
</head>
<body>

<div class="page-wrapper">
    
    <!-- HEADER -->
    <header class="page-header">
        <div class="header-brand">
            <i class="ph ph-lightning brand-icon"></i>
            <div>
                <h1>Consommation Énergétique</h1>
                <span class="subtitle">Suivi et analyse de votre consommation</span>
            </div>
        </div>
        <a href="{{ route('energy.create') }}" class="btn btn-primary">
            <i class="ph ph-plus"></i> Ajouter une mesure
        </a>
    </header>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- SECTION 1 : STATS GLOBALES (basées sur Device) -->
    <!-- → Affiche les données de TOUS les appareils    -->
    <!-- ═══════════════════════════════════════════════ -->
    <div class="stats-grid">
        <div class="stat-card stat-blue">
            <i class="ph ph-lightning"></i>
            <div class="stat-info">
                <!-- Somme des conso_annuelle_kwh de tous les devices -->
                <span class="stat-value">{{ number_format($stats['total_kwh'], 2) }}</span>
                <span class="stat-label">kWh total</span>
            </div>
        </div>
        
        <div class="stat-card stat-orange">
            <i class="ph ph-cloud"></i>
            <div class="stat-info">
                <!-- Calculé à partir du total kWh -->
                <span class="stat-value">{{ number_format($stats['total_co2'], 2) }}</span>
                <span class="stat-label">kg CO₂</span>
            </div>
        </div>
        
        <div class="stat-card stat-green">
            <i class="ph ph-currency-dollar"></i>
            <div class="stat-info">
                <!-- Coût estimé -->
                <span class="stat-value">{{ number_format($stats['total_cost'], 2) }}</span>
                <span class="stat-label">MAD estimé</span>
            </div>
        </div>
        
        <div class="stat-card stat-purple">
            <i class="ph ph-chart-line"></i>
            <div class="stat-info">
                <!-- Nombre de mesures enregistrées -->
                <span class="stat-value">{{ $stats['total_mesures'] }}</span>
                <span class="stat-label">Mesures</span>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- SECTION 2 : COURBE (basée sur Device)           -->
    <!-- → Une barre par appareil, même sans mesures     -->
    <!-- ═══════════════════════════════════════════════ -->
    <div class="charts-row">
        <div class="chart-card">
            <h2><i class="ph ph-chart-bar"></i> Consommation par appareil</h2>
            <canvas id="deviceChart"></canvas>
        </div>
        
        <div class="chart-card">
            <h2><i class="ph ph-trend-up"></i> Évolution temporelle</h2>
            <canvas id="trendChart"></canvas>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- SECTION 3 : FILTRES                             -->
    <!-- ═══════════════════════════════════════════════ -->
    <div class="filters-bar">
        <form method="GET" action="{{ route('energy.index') }}">
            <select name="device_id">
                <option value="">Tous les appareils</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ request('device_id') == $device->id ? 'selected' : '' }}>
                        {{ $device->nom }}
                    </option>
                @endforeach
            </select>
            
            <input type="date" name="date_debut" value="{{ request('date_debut') }}" placeholder="Du">
            <input type="date" name="date_fin" value="{{ request('date_fin') }}" placeholder="Au">
            
            <button type="submit" class="btn btn-primary">
                <i class="ph ph-funnel"></i> Filtrer
            </button>
            <a href="{{ route('energy.index') }}" class="btn btn-secondary">
                <i class="ph ph-arrow-counter-clockwise"></i> Reset
            </a>
        </form>
    </div>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- SECTION 4 : HISTORIQUE (basé sur EnergyLog)     -->
    <!-- → Seulement les mesures enregistrées            -->
    <!-- → Filtrable par appareil/date                   -->
    <!-- ═══════════════════════════════════════════════ -->
    <div class="table-card">
        <div class="table-header">
            <h2><i class="ph ph-list"></i> Historique des consommations</h2>
            <span class="badge">{{ $stats['total_mesures'] }} mesures</span>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Appareil</th>
                    <th>Période</th>
                    <th>kWh</th>
                    <th>kg CO₂</th>
                    <th>Source</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($energyLogs as $log)
                    <tr>
                        <td>
                            <div class="device-name">
                                <span class="device-title">{{ $log->device->nom ?? 'N/A' }}</span>
                                <span class="device-meta">{{ $log->device->type ?? '' }}</span>
                            </div>
                        </td>
                        <td>
                            {{ $log->date_debut?->format('d/m/Y') }} → {{ $log->date_fin?->format('d/m/Y') }}
                        </td>
                        <td class="col-numeric">
                            <span class="value-kwh">{{ number_format($log->consumption_kwh ?? $log->consumption, 2) }}</span>
                        </td>
                        <td class="col-numeric">
                            <span class="value-co2">{{ number_format($log->emission_co2_kg ?? (($log->consumption_kwh ?? 0) * 0.7), 2) }}</span>
                        </td>
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
                        <td>
                            <a href="#" class="btn-icon btn-view" title="Voir détails">
                                <i class="ph ph-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="ph ph-chart-bar"></i>
                            <p>Aucune mesure enregistrée</p>
                            <a href="{{ route('energy.create') }}" class="btn btn-sm">Ajouter une mesure</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<!-- ═══════════════════════════════════════════════ -->
<!-- SCRIPTS : Chart.js                              -->
<!-- ═══════════════════════════════════════════════ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ═══════════════════════════════════════════════
    // GRAPHIQUE 1 : Consommation par appareil
    // ═══════════════════════════════════════════════
    try {
        const deviceCanvas = document.getElementById('deviceChart');
        if (!deviceCanvas) throw new Error('Canvas deviceChart non trouvé');
        
        // Vérifier les données
        const deviceData = {!! json_encode($chartData->values()) !!};
        console.log('Device data:', deviceData);
        
        if (deviceData.length === 0) {
            deviceCanvas.parentElement.innerHTML += '<p class="no-data">Aucun appareil à afficher</p>';
        } else {
            new Chart(deviceCanvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: deviceData.map(d => d.name),
                    datasets: [{
                        label: 'kWh/an',
                        data: deviceData.map(d => d.kwh),
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(168, 85, 247, 0.7)',
                            'rgba(236, 72, 153, 0.7)',
                        ],
                        borderColor: [
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)',
                            'rgb(249, 115, 22)',
                            'rgb(168, 85, 247)',
                            'rgb(236, 72, 153)',
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, position: 'top' }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'kWh/an' }
                        }
                    }
                }
            });
        }
    } catch (e) {
        console.error('ERREUR Graphique 1:', e);
        document.querySelector('.chart-card:first-child').innerHTML += 
            '<p class="chart-error">Erreur: ' + e.message + '</p>';
    }

    // ═══════════════════════════════════════════════
    // GRAPHIQUE 2 : Évolution temporelle
    // ═══════════════════════════════════════════════
    try {
        const trendCanvas = document.getElementById('trendChart');
        if (!trendCanvas) throw new Error('Canvas trendChart non trouvé');
        
        // Vérifier les données
        const trendData = {!! json_encode($logsPourLaCourbe->values()) !!};
        console.log('Trend data:', trendData);
        
        if (trendData.length === 0) {
            trendCanvas.parentElement.innerHTML += '<p class="no-data">Aucune mesure enregistrée</p>';
        } else {
            new Chart(trendCanvas.getContext('2d'), {
                type: 'line',
                data: {
                    labels: trendData.map(l => {
                        const date = new Date(l.date);
                        return date.toLocaleDateString('fr-FR', {month: 'short', year: 'numeric'});
                    }),
                    datasets: [{
                        label: 'kWh',
                        data: trendData.map(l => l.kwh),
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, position: 'top' }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'kWh' }
                        }
                    }
                }
            });
        }
    } catch (e) {
        console.error('ERREUR Graphique 2:', e);
        document.querySelector('.chart-card:last-child').innerHTML += 
            '<p class="chart-error">Erreur: ' + e.message + '</p>';
    }
});
</script>
</body>
</html>