<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Équipement — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* ═══════════════════════════════════════════════════════════════ */
        /* RESET & BASE */
        /* ═══════════════════════════════════════════════════════════════ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            line-height: 1.6;
            min-height: 100vh;
            padding: 32px 16px;
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* CONTAINER */
        /* ═══════════════════════════════════════════════════════════════ */
        .page-wrapper {
            max-width: 720px;
            margin: 0 auto;
        }

        .form-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* HEADER */
        /* ═══════════════════════════════════════════════════════════════ */
        .form-header {
            background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);
            padding: 40px 32px;
            text-align: center;
            border-bottom: 1px solid #bbf7d0;
        }

        .form-icon {
            width: 64px;
            height: 64px;
            background: #22c55e;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 8px 24px rgba(34, 197, 94, 0.25);
        }

        .form-icon i {
            font-size: 28px;
            color: #ffffff;
        }

        .form-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .form-header .subtitle {
            font-size: 15px;
            color: #64748b;
            font-weight: 400;
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* ALERTES FLASH */
        /* ═══════════════════════════════════════════════════════════════ */
        .alert-flash {
            margin: 24px 32px 0;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-flash i {
            font-size: 20px;
            flex-shrink: 0;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* STATS GRID */
        /* ═══════════════════════════════════════════════════════════════ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            padding: 24px 32px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .stat-item {
            background: #ffffff;
            border-radius: 14px;
            padding: 20px 16px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border-color: #bbf7d0;
        }

        .stat-item i {
            font-size: 22px;
            color: #22c55e;
            margin-bottom: 8px;
            display: block;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }

        .stat-unit {
            font-size: 12px;
            color: #94a3b8;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-top: 4px;
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* FORMULAIRE */
        /* ═══════════════════════════════════════════════════════════════ */
        .form-body {
            padding: 32px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 8px;
        }

        label i {
            font-size: 16px;
            color: #22c55e;
        }

        .required {
            color: #dc2626;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            background: #ffffff;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 256 256'%3E%3Cpath d='M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 42px;
        }

        .input-group {
            position: relative;
            display: flex;
        }

        .input-suffix {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            font-weight: 500;
            color: #94a3b8;
            pointer-events: none;
        }

        .input-group .form-control {
            padding-right: 50px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Erreurs */
        .is-invalid {
            border-color: #ef4444 !important;
        }

        .error {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            font-size: 13px;
            color: #dc2626;
            font-weight: 500;
        }

        .error i {
            font-size: 14px;
        }

        /* Lecture seule */
        .readonly-field {
            background: #f8fafc !important;
            color: #94a3b8 !important;
            cursor: not-allowed;
            border-color: #e2e8f0 !important;
        }

        .hint-text {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #94a3b8;
        }

        /* Info hint */
        .info-hint {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-top: 8px;
            padding: 10px 14px;
            background: #f0fdf4;
            border-radius: 10px;
            font-size: 12px;
            color: #15803d;
            font-weight: 500;
        }

        .info-hint i {
            font-size: 14px;
            color: #22c55e;
            margin-top: 1px;
            flex-shrink: 0;
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* SECTION SUPPRESSION */
        /* ═══════════════════════════════════════════════════════════════ */
        .delete-section {
            margin: 32px 0;
            padding-top: 24px;
            border-top: 1px dashed #e2e8f0;
        }

        .btn-delete-trigger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: #ffffff;
            color: #dc2626;
            border: 1.5px solid #fecaca;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-delete-trigger:hover {
            background: #fef2f2;
            border-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.12);
        }

        .btn-delete-trigger i {
            font-size: 16px;
        }

        /* Confirmation */
        .delete-confirm {
            display: none;
            margin-top: 16px;
            padding: 20px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 14px;
            animation: slideDown 0.25s ease;
        }

        .delete-confirm.show {
            display: block;
        }

        .delete-confirm-text {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 14px;
            color: #7f1d1d;
            line-height: 1.6;
        }

        .delete-confirm-text i {
            font-size: 22px;
            color: #dc2626;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .delete-confirm-text strong {
            color: #991b1b;
            font-weight: 600;
        }

        .delete-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: #dc2626;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
        }

        .btn-danger i {
            font-size: 15px;
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: #ffffff;
            color: #475569;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-ghost:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-ghost i {
            font-size: 15px;
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* ACTIONS PRINCIPALES */
        /* ═══════════════════════════════════════════════════════════════ */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: #22c55e;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(34, 197, 94, 0.3);
        }

        .btn-primary:hover {
            background: #16a34a;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.35);
        }

        .btn-primary i {
            font-size: 16px;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: #f1f5f9;
            color: #475569;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }

        .btn-secondary i {
            font-size: 16px;
        }

        /* ═══════════════════════════════════════════════════════════════ */
        /* RESPONSIVE */
        /* ═══════════════════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            body {
                padding: 16px 12px;
            }

            .form-header {
                padding: 28px 20px;
            }

            .form-header h1 {
                font-size: 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 20px;
                gap: 12px;
            }

            .stat-value {
                font-size: 18px;
            }

            .form-body {
                padding: 24px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .alert-flash {
                margin: 20px 20px 0;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
            }

            .delete-actions {
                flex-direction: column;
            }

            .btn-danger,
            .btn-ghost {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="page-wrapper">
    <div class="form-container">

        <!-- ═══════════════════════════════════════════════ -->
        <!-- HEADER -->
        <!-- ═══════════════════════════════════════════════ -->
        <div class="form-header">
            <div class="form-icon">
                <i class="ph ph-pencil-simple"></i>
            </div>
            <h1>Modifier l'équipement</h1>
            <p class="subtitle">{{ $device->nom }} — {{ $device->type }}</p>
        </div>

        <!-- ═══════════════════════════════════════════════ -->
        <!-- ALERTES FLASH -->
        <!-- ═══════════════════════════════════════════════ -->
        @if(session('success'))
            <div class="alert-flash alert-success">
                <i class="ph ph-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-flash alert-danger">
                <i class="ph ph-warning-circle"></i>
                Veuillez corriger les erreurs ci-dessous.
            </div>
        @endif

        <!-- ═══════════════════════════════════════════════ -->
        <!-- STATS -->
        <!-- ═══════════════════════════════════════════════ -->
        <div class="stats-grid">
            <div class="stat-item">
                <i class="ph ph-lightning"></i>
                <div class="stat-value">{{ number_format($device->conso_annuelle_kwh, 2) }}</div>
                <div class="stat-unit">kWh/an</div>
            </div>
            <div class="stat-item">
                <i class="ph ph-cloud-arrow-up"></i>
                <div class="stat-value">{{ number_format($device->emission_co2_kg, 2) }}</div>
                <div class="stat-unit">kg CO₂/an</div>
            </div>
            <div class="stat-item">
                <i class="ph ph-factory"></i>
                <div class="stat-value">{{ number_format($device->empreinte_carbone_fab, 2) }}</div>
                <div class="stat-unit">kg CO₂ (fab.)</div>
            </div>
            <div class="stat-item">
                <i class="ph ph-coin"></i>
                <div class="stat-value">{{ number_format($device->cout_energie_annuel, 2) }}</div>
                <div class="stat-unit">MAD/an</div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════ -->
        <!-- FORMULAIRE -->
        <!-- ═══════════════════════════════════════════════ -->
        <div class="form-body">
            <form action="{{ route('devices.update', $device) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nom + Type -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">
                            <i class="ph ph-text-t"></i> Nom <span class="required">*</span>
                        </label>
                        <input type="text" name="nom" id="nom"
                               class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom', $device->nom) }}" required>
                        @error('nom')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">
                            <i class="ph ph-tag"></i> Type <span class="required">*</span>
                        </label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                            @foreach(['PC', 'Serveur', 'Switch', 'Routeur', 'Imprimante', 'Écran', 'Onduleur', 'Autre'] as $type)
                                <option value="{{ $type }}" {{ old('type', $device->type) == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Marque + Modèle -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="marque"><i class="ph ph-trademark"></i> Marque</label>
                        <input type="text" name="marque" id="marque"
                               class="form-control @error('marque') is-invalid @enderror"
                               value="{{ old('marque', $device->marque) }}">
                        @error('marque')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="modele"><i class="ph ph-cube"></i> Modèle</label>
                        <input type="text" name="modele" id="modele"
                               class="form-control @error('modele') is-invalid @enderror"
                               value="{{ old('modele', $device->modele) }}">
                        @error('modele')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Numéro de série -->
                <div class="form-group">
                    <label for="numero_serie"><i class="ph ph-hash"></i> Numéro de série</label>
                    <input type="text" id="numero_serie" class="form-control readonly-field"
                           value="{{ $device->numero_serie }}" readonly>
                    <span class="hint-text">Le numéro de série ne peut pas être modifié.</span>
                </div>

                <!-- Date achat + Prix -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="date_achat"><i class="ph ph-calendar"></i> Date d'achat</label>
                        <input type="date" name="date_achat" id="date_achat"
                               class="form-control @error('date_achat') is-invalid @enderror"
                               value="{{ old('date_achat', $device->date_achat?->format('Y-m-d')) }}">
                        @error('date_achat')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="prix"><i class="ph ph-currency-dollar"></i> Prix</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="prix" id="prix"
                                   class="form-control @error('prix') is-invalid @enderror"
                                   value="{{ old('prix', $device->prix) }}">
                            <span class="input-suffix">MAD</span>
                        </div>
                        @error('prix')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Puissance -->
                <div class="form-group">
                    <label for="puissance_watt">
                        <i class="ph ph-lightning"></i> Puissance <span class="required">*</span>
                    </label>
                    <div class="input-group">
                        <input type="number" step="0.01" name="puissance_watt" id="puissance_watt"
                               class="form-control @error('puissance_watt') is-invalid @enderror"
                               value="{{ old('puissance_watt', $device->puissance_watt) }}" required>
                        <span class="input-suffix">W</span>
                    </div>
                    @error('puissance_watt')
                        <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="info-hint">
                        <i class="ph ph-info"></i>
                        <span>Si vous modifiez la puissance, la consommation et les émissions CO₂ seront recalculées automatiquement.</span>
                    </div>
                </div>

                <!-- Efficacité + Durée de vie -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="efficacite_energetique"><i class="ph ph-leaf"></i> Efficacité énergétique</label>
                        <select name="efficacite_energetique" id="efficacite_energetique"
                                class="form-select @error('efficacite_energetique') is-invalid @enderror">
                            @foreach(['A+++', 'A++', 'A+', 'A', 'B', 'C', 'D', 'Non classé'] as $classe)
                                <option value="{{ $classe }}" {{ old('efficacite_energetique', $device->efficacite_energetique) == $classe ? 'selected' : '' }}>
                                    {{ $classe }}
                                </option>
                            @endforeach
                        </select>
                        @error('efficacite_energetique')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="duree_vie_annees"><i class="ph ph-hourglass"></i> Durée de vie</label>
                        <div class="input-group">
                            <input type="number" name="duree_vie_annees" id="duree_vie_annees"
                                   class="form-control @error('duree_vie_annees') is-invalid @enderror"
                                   value="{{ old('duree_vie_annees', $device->duree_vie_annees) }}">
                            <span class="input-suffix">ans</span>
                        </div>
                        @error('duree_vie_annees')
                            <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Statut -->
                <div class="form-group">
                    <label for="statut"><i class="ph ph-activity"></i> Statut <span class="required">*</span></label>
                    <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror" required>
                        @foreach(['actif' => 'Actif', 'en_reparation' => 'En réparation', 'hors_service' => 'Hors service', 'stock' => 'En stock', 'recycle' => 'À recycler'] as $value => $label)
                            <option value="{{ $value }}" {{ old('statut', $device->statut) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('statut')
                        <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Localisation -->
                <div class="form-group">
                    <label for="localisation"><i class="ph ph-map-pin"></i> Localisation</label>
                    <input type="text" name="localisation" id="localisation"
                           class="form-control @error('localisation') is-invalid @enderror"
                           value="{{ old('localisation', $device->localisation) }}"
                           placeholder="Ex: Bureau 301, Datacenter A...">
                    @error('localisation')
                        <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Utilisateur -->
                <div class="form-group">
                    <label for="user_id"><i class="ph ph-user"></i> Utilisateur assigné</label>
                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                        <option value="">Aucun utilisateur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $device->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description"><i class="ph ph-text-align-left"></i> Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"
                              placeholder="Informations complémentaires...">{{ old('description', $device->description) }}</textarea>
                </div>

                <!-- ═══════════════════════════════════════════════ -->
                <!-- SUPPRESSION -->
                <!-- ═══════════════════════════════════════════════ -->
                <div class="delete-section">
                    <button type="button" class="btn-delete-trigger" onclick="toggleDeleteConfirm()">
                        <i class="ph ph-trash"></i> Supprimer cet équipement
                    </button>

                    <div id="deleteConfirm" class="delete-confirm">
                        <div class="delete-confirm-text">
                            <i class="ph ph-warning"></i>
                            <div>
                                <strong>Attention !</strong> Vous êtes sur le point de supprimer définitivement l'équipement
                                <strong>"{{ $device->nom }}"</strong>. Cette action est irréversible et supprimera également
                                tout l'historique de consommation associé.
                            </div>
                        </div>
                        <div class="delete-actions">
                            <form action="{{ route('devices.destroy', $device) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">
                                    <i class="ph ph-trash"></i> Oui, supprimer définitivement
                                </button>
                            </form>
                            <button type="button" class="btn-ghost" onclick="toggleDeleteConfirm()">
                                <i class="ph ph-x"></i> Annuler
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════════════ -->
                <!-- ACTIONS -->
                <!-- ═══════════════════════════════════════════════ -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="ph ph-check"></i> Mettre à jour
                    </button>
                    <a href="{{ route('devices.index') }}" class="btn-secondary">
                        <i class="ph ph-x"></i> Annuler
                    </a>
                    <a href="{{ route('devices.show', $device) }}" class="btn-secondary" style="margin-left: auto;">
                        <i class="ph ph-eye"></i> Voir détails
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function toggleDeleteConfirm() {
        const confirmDiv = document.getElementById('deleteConfirm');
        confirmDiv.classList.toggle('show');
    }
</script>

</body>
</html>