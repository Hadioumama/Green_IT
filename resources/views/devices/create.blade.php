<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un équipement — Green IT</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icônes Phosphor -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/devices-create.css') }}">
</head>
<body>

<div class="page-wrapper">
    
    <!-- HEADER -->
    <header class="page-header">
        <div class="header-brand">
            <i class="ph ph-leaf brand-icon"></i>
            <div>
                <h1>Green IT Manager</h1>
                <span class="header-subtitle">Ajouter un équipement au parc</span>
            </div>
        </div>
   <!--  <a href="{{ route('devices.index') }}" class="btn btn-outline">-->
            <i class="ph ph-arrow-left"></i> Retour à la liste
        </a>
    </header>

    <!-- MESSAGE SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="ph ph-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- FORMULAIRE -->
    <form method="POST" action="{{ route('devices.store') }}" class="form-card">
        @csrf

        <!-- SECTION 1 : IDENTIFICATION -->
        <section class="form-section">
            <div class="section-header">
                <i class="ph ph-cpu"></i>
                <h2>Identification</h2>
                <span class="badge badge-required">Champs obligatoires *</span>
            </div>

            <div class="form-grid-2">
                <!-- Nom -->
                <div class="form-group">
                    <label for="nom">Nom de l'équipement <span class="required">*</span></label>
                    <div class="input-icon">
                        <i class="ph ph-desktop"></i>
                        <input 
                            type="text" 
                            id="nom" 
                            name="nom" 
                            value="{{ old('nom') }}"
                            placeholder="Ex: PC Bureau Oumama"
                            required
                            autofocus
                        >
                    </div>
                    @error('nom')
                        <span class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Type -->
                <div class="form-group">
                    <label for="type">Type <span class="required">*</span></label>
                    <div class="input-icon">
                        <i class="ph ph-tag"></i>
                        <select id="type" name="type" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach(['PC', 'Serveur', 'Switch', 'Routeur', 'Imprimante', 'Écran', 'Onduleur', 'Autre'] as $t)
                                <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('type')
                        <span class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Marque -->
                <div class="form-group">
                    <label for="marque">Marque</label>
                    <div class="input-icon">
                        <i class="ph ph-buildings"></i>
                        <input 
                            type="text" 
                            id="marque" 
                            name="marque" 
                            value="{{ old('marque') }}"
                            placeholder="Dell, HP, Cisco, Lenovo..."
                        >
                    </div>
                </div>

                <!-- Modèle -->
                <div class="form-group">
                    <label for="modele">Modèle</label>
                    <div class="input-icon">
                        <i class="ph ph-barcode"></i>
                        <input 
                            type="text" 
                            id="modele" 
                            name="modele" 
                            value="{{ old('modele') }}"
                            placeholder="OptiPlex 7090, ProLiant DL380..."
                        >
                    </div>
                </div>

                <!-- Numéro de série -->
                <div class="form-group full-width">
                    <label for="numero_serie">Numéro de série <span class="required">*</span></label>
                    <div class="input-icon">
                        <i class="ph ph-fingerprint"></i>
                        <input 
                            type="text" 
                            id="numero_serie" 
                            name="numero_serie" 
                            value="{{ old('numero_serie') }}"
                            placeholder="SN123456789 ou numéro unique fabricant"
                            required
                        >
                    </div>
                    @error('numero_serie')
                        <span class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </section>

        <!-- SECTION 2 : ACHAT -->
        <section class="form-section">
            <div class="section-header">
                <i class="ph ph-currency-dollar"></i>
                <h2>Achat</h2>
            </div>

            <div class="form-grid-3">
                <!-- Date d'achat -->
                <div class="form-group">
                    <label for="date_achat">Date d'achat</label>
                    <div class="input-icon">
                        <i class="ph ph-calendar"></i>
                        <input 
                            type="date" 
                            id="date_achat" 
                            name="date_achat" 
                            value="{{ old('date_achat') }}"
                        >
                    </div>
                </div>

                <!-- Prix -->
                <div class="form-group">
                    <label for="prix">Prix (MAD)</label>
                    <div class="input-icon">
                        <i class="ph ph-coins"></i>
                        <input 
                            type="number" 
                            id="prix" 
                            name="prix" 
                            value="{{ old('prix') }}"
                            step="0.01" 
                            min="0"
                            placeholder="0.00"
                        >
                    </div>
                </div>

                <!-- Durée de vie -->
                <div class="form-group">
                    <label for="duree_vie_annees">Durée de vie estimée (ans)</label>
                    <div class="input-icon">
                        <i class="ph ph-hourglass"></i>
                        <input 
                            type="number" 
                            id="duree_vie_annees" 
                            name="duree_vie_annees" 
                            value="{{ old('duree_vie_annees') }}"
                            min="1" 
                            max="50"
                            placeholder="5"
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3 : CONSOMMATION (seule donnée saisie) -->
        <section class="form-section section-green">
            <div class="section-header">
                <i class="ph ph-lightning"></i>
                <h2>Consommation énergétique</h2>
                <span class="badge badge-info">Calcul auto CO₂ activé</span>
            </div>

            <div class="form-grid-2">
                <!-- Puissance (SEUL champ conso saisi) -->
                <div class="form-group">
                    <label for="puissance_watt">
                        Puissance (Watts) <span class="required">*</span>
                        <small class="hint">→ Lue sur l'étiquette énergie de l'appareil</small>
                    </label>
                    <div class="input-icon input-highlight">
                        <i class="ph ph-lightning-fill"></i>
                        <input 
                            type="number" 
                            id="puissance_watt" 
                            name="puissance_watt" 
                            value="{{ old('puissance_watt') }}"
                            step="0.01" 
                            min="0"
                            placeholder="Ex: 65 pour un PC, 300 pour un serveur"
                            required
                        >
                        <span class="input-unit">W</span>
                    </div>
                    <div class="info-box">
                        <i class="ph ph-info"></i>
                        <span>Le système calculera automatiquement : conso annuelle (kWh) et émissions CO₂</span>
                    </div>
                </div>

                <!-- Classe énergétique -->
                <div class="form-group">
                    <label for="efficacite_energetique">Classe énergétique</label>
                    <div class="input-icon">
                        <i class="ph ph-chart-bar"></i>
                        <select id="efficacite_energetique" name="efficacite_energetique">
                            @foreach(['A+++', 'A++', 'A+', 'A', 'B', 'C', 'D', 'Non classé'] as $classe)
                                <option value="{{ $classe }}" {{ old('efficacite_energetique', 'Non classé') == $classe ? 'selected' : '' }}>
                                    {{ $classe }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4 : GESTION -->
        <section class="form-section">
            <div class="section-header">
                <i class="ph ph-gear"></i>
                <h2>Gestion</h2>
            </div>

            <div class="form-grid-2">
                <!-- Statut -->
                <div class="form-group">
                    <label for="statut">Statut <span class="required">*</span></label>
                    <div class="input-icon">
                        <i class="ph ph-activity"></i>
                        <select id="statut" name="statut" required>
                            @foreach([
                                'stock' => 'En stock',
                                'actif' => 'Actif',
                                'en_reparation' => 'En réparation',
                                'hors_service' => 'Hors service',
                                'recycle' => 'À recycler'
                            ] as $val => $label)
                                <option value="{{ $val }}" {{ old('statut', 'stock') == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('statut')
                        <span class="error-msg"><i class="ph ph-warning-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <!-- Localisation -->
                <div class="form-group">
                    <label for="localisation">Localisation</label>
                    <div class="input-icon">
                        <i class="ph ph-map-pin"></i>
                        <input 
                            type="text" 
                            id="localisation" 
                            name="localisation" 
                            value="{{ old('localisation') }}"
                            placeholder="Bureau 301, Salle serveur..."
                        >
                    </div>
                </div>

                <!-- Responsable -->
                <div class="form-group">
                    <label for="user_id">Responsable</label>
                    <div class="input-icon">
                        <i class="ph ph-user"></i>
                        <select id="user_id" name="user_id">
                            <option value="">-- Non assigné --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Date fin de vie -->
                <div class="form-group">
                    <label for="date_mise_hors_service">Date fin de vie prévue</label>
                    <div class="input-icon">
                        <i class="ph ph-calendar-x"></i>
                        <input 
                            type="date" 
                            id="date_mise_hors_service" 
                            name="date_mise_hors_service" 
                            value="{{ old('date_mise_hors_service') }}"
                        >
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group full-width mt-20">
                <label for="description">Description / Notes</label>
                <div class="input-icon textarea-icon">
                    <i class="ph ph-text-align-left"></i>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        placeholder="Caractéristiques techniques, justification d'achat, plan de remplacement..."
                    >{{ old('description') }}</textarea>
                </div>
            </div>
        </section>

        <!-- BOUTONS -->
        <div class="form-actions">
            <button type="reset" class="btn btn-secondary">
                <i class="ph ph-arrow-counter-clockwise"></i> Réinitialiser
            </button>
            <button type="submit" class="btn btn-primary btn-green">
                <i class="ph ph-leaf"></i>
                <span>Enregistrer l'équipement</span>
                <small class="btn-subtitle">Calcul automatique CO₂</small>
            </button>
        </div>

    </form>

    <!-- FOOTER INFO -->
    <div class="form-footer">
        <i class="ph ph-info"></i>
        <p>Les champs <strong>consommation annuelle (kWh)</strong>, <strong>émissions CO₂</strong> et <strong>empreinte carbone fabrication</strong> seront calculés automatiquement par le système via API Carbon.</p>
    </div>

</div>

</body>
</html>