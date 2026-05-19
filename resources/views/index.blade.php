<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v=3">
</head>
<body>

<div class="app" id="app">

    <!-- ═══════════════════════════════════════════════ -->
    <!-- SIDEBAR COLLAPSIBLE -->
    <!-- ═══════════════════════════════════════════════ -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="ph ph-leaf"></i>
            </div>
            <span class="brand-text">Green IT</span>
            <button class="sidebar-toggle" id="sidebarToggle" title="Réduire/Agrandir">
                <i class="ph ph-caret-left" id="toggleIcon"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <div class="nav-icon">
                    <i class="ph ph-squares-four"></i>
                </div>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('devices.index') }}" class="nav-item">
                <div class="nav-icon">
                    <i class="ph ph-desktop"></i>
                </div>
                <span>Parc informatique</span>
            </a>
            <a href="{{ route('energy.index') }}" class="nav-item">
                <div class="nav-icon">
                    <i class="ph ph-lightning"></i>
                </div>
                <span>Consommation</span>
            </a>
            <a href="{{ route('devices.remplacer') }}" class="nav-item">
                <div class="nav-icon">
                    <i class="ph ph-warning"></i>
                </div>
                <span>Alertes</span>
                @if($kpis['a_remplacer'] > 0)
                    <span class="nav-badge">{{ $kpis['a_remplacer'] }}</span>
                @endif
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">Administrateur</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar" title="Déconnexion">
                    <i class="ph ph-sign-out"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══════════════════════════════════════════════ -->
    <!-- CONTENU DROIT -->
    <!-- ═══════════════════════════════════════════════ -->
    <main class="content" id="content">

        <!-- Header -->
        <header class="content-header">
            <div>
                <h1>Tableau de bord</h1>
                <p>Bienvenue, voici l'état de votre parc</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="header-date">
                    <i class="ph ph-calendar"></i>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>
            </div>
        </header>

        <!-- KPI Cards -->
        <div class="kpi-row">
            <div class="kpi-box kpi-total">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Équipements</span>
                    <div class="kpi-icon-box">
                        <i class="ph ph-desktop"></i>
                    </div>
                </div>
                <div class="kpi-number">{{ $kpis['total_devices'] }}</div>
                <div class="kpi-trend">
                    <i class="ph ph-trend-up"></i>
                    <span>Total actif</span>
                </div>
            </div>

            <div class="kpi-box kpi-energy">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Consommation</span>
                    <div class="kpi-icon-box">
                        <i class="ph ph-lightning"></i>
                    </div>
                </div>
                <div class="kpi-number">{{ number_format($kpis['total_conso'], 0) }} <small>kWh</small></div>
                <div class="kpi-trend">
                    <i class="ph ph-trend-up"></i>
                    <span>Annuel</span>
                </div>
            </div>

            <div class="kpi-box kpi-co2">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Émissions CO₂</span>
                    <div class="kpi-icon-box">
                        <i class="ph ph-cloud"></i>
                    </div>
                </div>
                <div class="kpi-number">{{ number_format($kpis['total_co2'], 0) }} <small>kg</small></div>
                <div class="kpi-trend">
                    <i class="ph ph-trend-down"></i>
                    <span>Usage</span>
                </div>
            </div>

            <div class="kpi-box kpi-fab">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Fabrication</span>
                    <div class="kpi-icon-box">
                        <i class="ph ph-factory"></i>
                    </div>
                </div>
                <div class="kpi-number">{{ number_format($kpis['total_fab_co2'], 0) }} <small>kg</small></div>
                <div class="kpi-trend">
                    <i class="ph ph-trend-down"></i>
                    <span>Embodied</span>
                </div>
            </div>

            <div class="kpi-box kpi-score">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Score Green</span>
                    <div class="kpi-icon-box">
                        <i class="ph ph-chart-bar"></i>
                    </div>
                </div>
                <div class="kpi-number">{{ $kpis['score_moyen'] }}<<small>/100</small></div>
                <div class="kpi-trend">
                    <i class="ph ph-trend-up"></i>
                    <span>Moyenne</span>
                </div>
            </div>

            <div class="kpi-box kpi-alert">
                <div class="kpi-glow"></div>
                <div class="kpi-top">
                    <span class="kpi-title">Alertes</span>
                    <div class="kpi-icon-box">
                        <i class="ph ph-warning"></i>
                    </div>
                </div>
                <div class="kpi-number">{{ $kpis['a_remplacer'] }}</div>
                <div class="kpi-trend">
                    <i class="ph ph-warning-circle"></i>
                    <span>À remplacer</span>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="charts-row">
            <!-- Donut Chart -->
            <div class="chart-card chart-large">
                <div class="chart-header">
                    <h3><i class="ph ph-chart-pie-slice"></i> Répartition par type</h3>
                    <button class="chart-menu"><i class="ph ph-dots-three"></i></button>
                </div>
                <div class="chart-body">
                    <div class="donut-container">
                        <div class="donut-chart">
                            <svg viewBox="0 0 36 36" class="donut">
                                @php
                                    $total = $parType->sum('count');
                                    $offset = 0;
                                    $colors = ['#22c55e', '#3b82f6', '#f97316', '#a855f7', '#ec4899', '#06b6d4', '#eab308', '#64748b'];
                                @endphp
                                @foreach($parType as $index => $type)
                                    @php
                                        $pct = $total > 0 ? ($type->count / $total) * 100 : 0;
                                        $dash = $pct * 0.942;
                                        $color = $colors[$index % count($colors)];
                                    @endphp
                                    <circle cx="18" cy="18" r="15.915"
                                        fill="none"
                                        stroke="{{ $color }}"
                                        stroke-width="3"
                                        stroke-dasharray="{{ $dash }} 100"
                                        stroke-dashoffset="{{ -$offset }}"
                                        class="donut-segment"
                                    />
                                    @php $offset += $dash; @endphp
                                @endforeach
                                <circle cx="18" cy="18" r="13" fill="#0f172a"/>
                            </svg>
                            <div class="donut-center">
                                <span class="donut-value">{{ $total }}</span>
                                <span class="donut-label">Total</span>
                            </div>
                        </div>
                        <div class="donut-legend">
                            @foreach($parType as $index => $type)
                                @php $color = $colors[$index % count($colors)]; @endphp
                                <div class="legend-item">
                                    <span class="legend-dot" style="background: {{ $color }}"></span>
                                    <span class="legend-name">{{ $type->type }}</span>
                                    <span class="legend-value">{{ $type->count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bar Chart - Top Consommation -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="ph ph-lightning"></i> Top consommation</h3>
                </div>
                <div class="chart-body">
                    <div class="bar-chart">
                        @php
                            $maxConso = $topConso->max('conso_annuelle_kwh') ?: 1;
                        @endphp
                        @foreach($topConso as $device)
                            @php
                                $pct = ($device->conso_annuelle_kwh / $maxConso) * 100;
                                $barColors = ['#22c55e', '#3b82f6', '#f97316', '#a855f7', '#ec4899'];
                                $barColor = $barColors[$loop->index % count($barColors)];
                            @endphp
                            <div class="bar-item">
                                <div class="bar-label">
                                    <span class="bar-name">{{ $device->nom }}</span>
                                    <span class="bar-type">{{ $device->type }}</span>
                                </div>
                                <div class="bar-track">
                                    <div class="bar-fill" style="width: {{ $pct }}%; background: {{ $barColor }}; box-shadow: 0 0 10px {{ $barColor }}40;"></div>
                                </div>
                                <span class="bar-value">{{ number_format($device->conso_annuelle_kwh, 0) }} kWh</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="charts-row">
            <!-- Bar Chart - Scores -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="ph ph-trend-down"></i> Scores Green IT</h3>
                </div>
                <div class="chart-body">
                    <div class="bar-chart">
                        @foreach($worstScore as $device)
                            @php
                                $score = $device->score_green_it ?? 0;
                                $pct = $score;
                                $scoreColor = $score >= 70 ? '#22c55e' : ($score >= 40 ? '#eab308' : '#ef4444');
                            @endphp
                            <div class="bar-item">
                                <div class="bar-label">
                                    <span class="bar-name">{{ $device->nom }}</span>
                                    <span class="bar-type">{{ $device->type }}</span>
                                </div>
                                <div class="bar-track">
                                    <div class="bar-fill" style="width: {{ $pct }}%; background: {{ $scoreColor }}; box-shadow: 0 0 10px {{ $scoreColor }}40;"></div>
                                </div>
                                <span class="bar-value" style="color: {{ $scoreColor }}">{{ $score }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            <div class="chart-card chart-alert">
                <div class="chart-header">
                    <h3><i class="ph ph-warning"></i> Alertes</h3>
                    @if($alertes->count() > 0)
                        <a href="{{ route('devices.remplacer') }}" class="chart-link">Voir tout</a>
                    @endif
                </div>
                <div class="chart-body">
                    @if($alertes->count() > 0)
                        <div class="alert-cards">
                            @foreach($alertes as $device)
                                @php
                                    $raisons = [];
                                    if ($device->statut === 'recycle') $raisons[] = 'À recycler';
                                    $age = $device->date_achat ? now()->diffInYears($device->date_achat) : null;
                                    if ($age !== null && $device->duree_vie_annees && $age >= $device->duree_vie_annees) {
                                        $raisons[] = "Âge dépassé";
                                    }
                                @endphp
                                <a href="{{ route('devices.edit', $device) }}" class="alert-card-item">
                                    <div class="alert-card-icon">
                                        <i class="ph ph-warning"></i>
                                    </div>
                                    <div class="alert-card-info">
                                        <span class="alert-card-name">{{ $device->nom }}</span>
                                        <span class="alert-card-reason">{{ implode(' + ', $raisons) ?: 'À remplacer' }}</span>
                                    </div>
                                    <i class="ph ph-caret-right"></i>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state-dark">
                            <i class="ph ph-check-circle"></i>
                            <span>Aucune alerte</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="chart-card chart-actions">
                <div class="chart-header">
                    <h3><i class="ph ph-lightning"></i> Actions rapides</h3>
                </div>
                <div class="chart-body">
                    <div class="action-grid">
                        <a href="{{ route('devices.create') }}" class="action-btn action-add">
                            <div class="action-icon">
                                <i class="ph ph-plus"></i>
                            </div>
                            <span>Nouvel équipement</span>
                        </a>
                        <a href="{{ route('energy.create') }}" class="action-btn action-energy">
                            <div class="action-icon">
                                <i class="ph ph-lightning"></i>
                            </div>
                            <span>Consommation</span>
                        </a>
                        <a href="{{ route('devices.index') }}" class="action-btn action-view">
                            <div class="action-icon">
                                <i class="ph ph-list"></i>
                            </div>
                            <span>Voir le parc</span>
                        </a>
                        <a href="{{ route('devices.remplacer') }}" class="action-btn action-alert">
                            <div class="action-icon">
                                <i class="ph ph-warning"></i>
                            </div>
                            <span>Alertes</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
    // Sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggleBtn = document.getElementById('sidebarToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    
    // Check localStorage for saved state
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        sidebar.classList.add('collapsed');
        content.classList.add('expanded');
        toggleIcon.classList.replace('ph-caret-left', 'ph-caret-right');
    }
    
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('expanded');
        
        if (sidebar.classList.contains('collapsed')) {
            toggleIcon.classList.replace('ph-caret-left', 'ph-caret-right');
            localStorage.setItem('sidebarCollapsed', 'true');
        } else {
            toggleIcon.classList.replace('ph-caret-right', 'ph-caret-left');
            localStorage.setItem('sidebarCollapsed', 'false');
        }
    });
</script>

</body>
</html>