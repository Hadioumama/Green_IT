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

    <!-- MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="ph ph-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS GLOBALES -->
    <div class="stats-grid">
        <div class="stat-card stat-blue">
            <i class="ph ph-lightning"></i>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($totalConsumption ?? 0, 2) }}</span>
                <span class="stat-label">kWh total</span>
            </div>
        </div>
        <div class="stat-card stat-orange">
            <i class="ph ph-cloud"></i>
            <div class="stat-info">
                <span class="stat-value">{{ number_format($totalCO2 ?? 0, 2) }}</span>
                <span class="stat-label">kg CO₂</span>
            </div>
        </div>
        <div class="stat-card stat-green">
            <i class="ph ph-currency-dollar"></i>
            <div class="stat-info">
                <span class="stat-value">{{ number_format(($totalConsumption ?? 0) * 1.5, 2) }}</span>
                <span class="stat-label">MAD estimé</span>
            </div>
        </div>
        <div class="stat-card stat-purple">
            <i class="ph ph-trend-up"></i>
            <div class="stat-info">
                <span class="stat-value">{{ count($energyLogs ?? []) }}</span>
                <span class="stat-label">Mesures</span>
            </div>
        </div>
    </div>

    <!-- GRAPHIQUES -->
    <div class="charts-row">
        <div class="chart-card">
            <h3><i class="ph ph-chart-bar"></i> Consommation par appareil</h3>
            <canvas id="consumptionByDevice"></canvas>
        </div>
        <div class="chart-card">
            <h3><i class="ph ph-chart-line"></i> Évolution temporelle</h3>
            <canvas id="consumptionOverTime"></canvas>
        </div>
    </div>

    <!-- FILTRES -->
    <div class="filters-card">
        <form method="GET" class="filters-form">
            <div class="filter-group">
                <label><i class="ph ph-desktop"></i> Appareil</label>
                <select name="device_id" class="filter-select">
                    <option value="">Tous</option>
                    @foreach($devices ?? [] as $dev)
                        <option value="{{ $dev->id }}" {{ request('device_id') == $dev->id ? 'selected' : '' }}>
                            {{ $dev->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label><i class="ph ph-calendar"></i> Du</label>
                <input type="date" name="date_debut" class="filter-input" value="{{ request('date_debut') }}">
            </div>
            <div class="filter-group">
                <label><i class="ph ph-calendar"></i> Au</label>
                <input type="date" name="date_fin" class="filter-input" value="{{ request('date_fin') }}">
            </div>
            <button type="submit" class="btn btn-filter">
                <i class="ph ph-funnel"></i> Filtrer
            </button>
            <a href="{{ route('energy.index') }}" class="btn btn-reset">
                <i class="ph ph-arrow-counter-clockwise"></i> Reset
            </a>
        </form>
    </div>

    <!-- TABLEAU HISTORIQUE -->
    <div class="table-card">
        <div class="table-header">
            <h2><i class="ph ph-list"></i> Historique des consommations</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Appareil</th>
                        <th>Période</th>
                        <th class="col-numeric">kWh</th>
                        <th class="col-numeric">kg CO₂</th>
                        <th>Source</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($energyLogs ?? [] as $log)
                        <tr>
                            <td>
                                <div class="device-cell">
                                    <span class="device-name">{{ $log->device->nom ?? 'N/A' }}</span>
                                    <span class="device-type">{{ $log->device->type ?? '' }}</span>
                                </div>
                            </td>
                            <td>
                                @if($log->date_debut && $log->date_fin)
                                    {{ $log->date_debut->format('d/m/Y') }} → {{ $log->date_fin->format('d/m/Y') }}
                                @elseif($log->date)
                                    {{ \Carbon\Carbon::parse($log->date)->format('d/m/Y') }}
                                @else
                                    {{ $log->created_at ? $log->created_at->format('d/m/Y') : '-' }}
                                @endif
                            </td>
                            <td class="col-numeric value-kwh">
                                {{ $log->consumption_kwh ?? $log->consumption ?? 0 }}
                            </td>
                            <td class="col-numeric value-co2">
                                {{ $log->emission_co2_kg ?? number_format(($log->consumption_kwh ?? $log->consumption ?? 0) * 0.7, 2) }}
                            </td>
                            <td>
                                <span class="badge-source source-{{ $log->source ?? 'estimation' }}">
                                    {{ 
                                        ($log->source ?? 'estimation') == 'mesure_reelle' ? 'Mesure réelle' :
                                        (($log->source ?? 'estimation') == 'facture' ? 'Facture' :
                                        (($log->source ?? 'estimation') == 'api_carbon' ? 'API Carbon' : 'Estimation'))
                                    }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    @if($log->device)
                                        <a href="{{ route('devices.show', $log->device) }}" class="btn-icon btn-view" title="Voir appareil">
                                            <i class="ph ph-eye"></i>
                                        </a>
                                    @else
                                        <span class="text-muted" title="Appareil supprimé">—</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="ph ph-lightning"></i>
                                <p>Aucune consommation enregistrée</p>
                                <a href="{{ route('energy.create') }}" class="btn btn-sm">Ajouter une mesure</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- GRAPHIQUES JS -->
<script>
    // Données depuis PHP
    const logs = @json($energyLogs ?? []);
    const devices = @json($devices ?? []);

    // === GRAPHIQUE 1 : Consommation par appareil ===
    const consumptionByDevice = {};
    logs.forEach(log => {
        const name = log.device?.nom || 'Inconnu';
        const value = parseFloat(log.consumption_kwh || log.consumption || 0);
        consumptionByDevice[name] = (consumptionByDevice[name] || 0) + value;
    });

    new Chart(document.getElementById('consumptionByDevice'), {
        type: 'bar',
        data: {
            labels: Object.keys(consumptionByDevice),
            datasets: [{
                label: 'kWh',
                data: Object.values(consumptionByDevice),
                backgroundColor: ['#2e7d32', '#4caf50', '#8bc34a', '#ffc107', '#ff9800', '#f44336'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // === GRAPHIQUE 2 : Évolution temporelle ===
    const timeData = {};
    logs.forEach(log => {
        const date = log.date_debut || log.date || log.created_at;
        const month = new Date(date).toLocaleDateString('fr-FR', { month: 'short', year: 'numeric' });
        const value = parseFloat(log.consumption_kwh || log.consumption || 0);
        timeData[month] = (timeData[month] || 0) + value;
    });

    new Chart(document.getElementById('consumptionOverTime'), {
        type: 'line',
        data: {
            labels: Object.keys(timeData).sort(),
            datasets: [{
                label: 'kWh',
                data: Object.keys(timeData).sort().map(k => timeData[k]),
                borderColor: '#2e7d32',
                backgroundColor: 'rgba(46, 125, 50, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

</body>
</html>