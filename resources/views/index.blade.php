<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Parc informatique — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/devices-index.css') }}">
</head>
<body>

<div class="page-wrapper">
    
    <!-- HEADER -->
    <header class="page-header">
        <div class="header-brand">
            <i class="ph ph-leaf brand-icon"></i>
            <div>
                <h1>Parc informatique</h1>
                <span class="subtitle">Gestion énergétique et empreinte carbone</span>
            </div>
        </div>
        <a href="{{ route('devices.create') }}" class="btn btn-primary">
            <i class="ph ph-plus"></i> Ajouter un équipement
        </a>
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
                                <span class="badge-type badge-{{ strtolower(str_replace(' ', '-', $device->type)) }}">
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
                                    {{ match($device->statut) {
                                        'actif' => 'Actif',
                                        'stock' => 'Stock',
                                        'en_reparation' => 'Réparation',
                                        'hors_service' => 'Hors service',
                                        'recycle' => 'À recycler',
                                    } }}
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