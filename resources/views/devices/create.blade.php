<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un équipement — Green IT</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Exo+2:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icônes Phosphor -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
/* ═══════════════════════════════════════════════════════ */
/* GREEN IT — FORMULAIRE AJOUT ÉQUIPEMENT v3 (Dark Glass)  */
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
    --text-3: #08c687;

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

/* ── Coque centrale ── */
.shell {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    width: min(1100px, 90vw);
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

/* ── Header ── */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-dim);
}

.header-brand {
    display: flex;
    align-items: center;
    gap: 14px;
}

.brand-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    box-shadow: 0 4px 16px rgba(16,185,129,0.35);
}

.header-brand h1 {
    font-family: 'Rajdhani', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.02em;
}

.header-subtitle {
    font-size: 12px;
    color: var(--text-2);
    opacity: 0.7;
}

/* ── Boutons ── */
.btn {
    display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px;
    border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;
    transition: all 0.2s; text-decoration: none; border: none;
    font-family: 'Exo 2', sans-serif;
}

.btn-secondary {
    background: rgba(255,255,255,0.06);
    color: var(--text-2);
    border: 1px solid rgba(255,255,255,0.12);
}
.btn-secondary:hover { background: rgba(255,255,255,0.1); color: #fff; }

.btn-primary {
    background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
    color: #fff;
    box-shadow: 0 4px 18px rgba(16,185,129,0.3);
}
.btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(16,185,129,0.4); }

/* ── Alertes ── */
.alert {
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: slideDown 0.4s ease both;
}

.alert-success {
    background: rgba(16, 185, 129, 0.15);
    border: 1px solid var(--green-bright);
    color: var(--green-bright);
}

@keyframes slideDown {
    from { opacity:0; transform: translateY(-10px); }
    to   { opacity:1; transform: translateY(0); }
}

/* ── Formulaire ── */
.form-card {
    display: flex;
    flex-direction: column;
    gap: 16px;
    overflow-y: auto;
    padding-right: 4px;
}

.form-card::-webkit-scrollbar { width: 6px; }
.form-card::-webkit-scrollbar-thumb { background: rgba(52,211,153,0.3); border-radius: 5px; }

/* ── Sections ── */
.form-section {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--r);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 22px 24px;
    transition: border-color 0.25s ease;
}

.form-section:hover {
    border-color: rgba(52,211,153,0.2);
}

/* Section verte spéciale (Consommation) */
.form-section.section-green {
    border-left: 3px solid var(--green-primary);
    background: rgba(16, 185, 129, 0.06);
}

.section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
}

.section-header i {
    font-size: 20px;
    color: var(--green-bright);
}

.section-header h2 {
    font-family: 'Rajdhani', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #34d399;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    flex: 1;
}

/* ── Badges ── */
.badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    font-family: 'Rajdhani', sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.badge-required {
    background: rgba(15, 1, 1, 0.99);
    color: var(--red);
    border: 1.5px solid rgba(236, 25, 25, 0.88);
}

.badge-info {
    background: rgba(16, 185, 129, 0.15);
    color: var(--green-bright);
    border: 1px solid rgba(16, 185, 129, 0.3);
}

/* ── Grilles ── */
.form-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.form-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

/* ── Groupes de formulaire ── */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-2);
    display: flex;
    align-items: center;
    gap: 6px;
}

.form-group label .required {
    color: rgba(235, 18, 18, 0.76);
      font-size: 25px;
}

.form-group label .hint {
    font-weight: 400;
    color: rgba(255,255,255,0.4);
    font-size: 11px;
    margin-left: 4px;
}

/* ── Inputs avec icônes ── */
.input-icon {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon > i:first-child {
    position: absolute;
    left: 14px;
    color: var(--green-bright);
    font-size: 16px;
    pointer-events: none;
    z-index: 2;
}

.input-icon input,
.input-icon select,
.input-icon textarea {
    width: 100%;
    padding: 11px 14px 11px 42px;
    background: rgba(0,0,0,0.25);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    color: #fff;
    font-size: 13px;
    font-family: 'Exo 2', sans-serif;
    transition: all 0.2s ease;
    outline: none;
}

.input-icon input::placeholder,
.input-icon textarea::placeholder,
.input-icon select option:first-child {
    color: rgba(255,255,255,0.35);
}

.input-icon input:focus,
.input-icon select:focus,
.input-icon textarea:focus {
    border-color: var(--green-primary);
    box-shadow: 0 0 0 3px rgba(16,185,129,0.15), 0 0 15px rgba(16,185,129,0.1);
    background: rgba(0,0,0,0.35);
}

/* Input avec unité (Watts) */
.input-unit {
    position: absolute;
    right: 14px;
    color: var(--green-bright);
    font-weight: 600;
    font-size: 12px;
    pointer-events: none;
}

.input-icon.input-highlight input {
    border-color: var(--green-primary);
    box-shadow: 0 0 0 2px rgba(16,185,129,0.1);
}

/* Textarea spécifique */
.textarea-icon textarea {
    padding-left: 42px;
    padding-top: 12px;
    resize: vertical;
    min-height: 100px;
}

.textarea-icon > i:first-child {
    top: 12px;
    transform: none;
}

/* Select */
.input-icon select {
    appearance: none;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2334d399' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
}

.input-icon select option {
    background: #1a2e25;
    color: #fff;
}

/* Date inputs */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0.7);
    cursor: pointer;
}

/* Number inputs */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    opacity: 0.5;
}

/* ── Info box ── */
.info-box {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    padding: 10px 14px;
    background:  rgba(11, 205, 140, 0.74);
    border: 1px solid rgba(16, 185, 129, 0.15);
    border-radius: 8px;
    margin-top: 8px;
    font-size: 12px;
    color:white;
}

.info-box i {
    font-size: 16px;
    flex-shrink: 0;
    margin-top: 1px;
}

/* ── Messages d'erreur ── */
.error-msg {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: var(--red);
    margin-top: 2px;
}

.error-msg i { font-size: 13px; }

/* ── Boutons d'action ── */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 8px;
}

.btn-green {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
    padding: 12px 24px;
}

.btn-green span {
    font-size: 14px;
    font-weight: 700;
}

.btn-subtitle {
    font-size: 10px;
    font-weight: 400;
    opacity: 0.8;
    color: rgba(255,255,255,0.8);
}

/* ── Footer info ── */
.form-footer {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 14px 18px;
    background: rgba(16, 185, 129, 0.68);
    border: 1px solid rgba(16, 185, 129, 0.12);
    border-radius: 10px;
    font-size: 12px;
    color: var(--text-2);
    opacity: 0.85;
}

.form-footer i {
    font-size: 18px;
    color: white;
    flex-shrink: 0;
    margin-top: 1px;
}

.form-footer strong {
    color: white;
    font-weight: 600;
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .shell { width: 95vw; padding: 20px; }
    .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
    .page-header { flex-direction: column; gap: 12px; align-items: flex-start; }
    .form-actions { flex-direction: column; }
    .form-actions .btn { width: 100%; justify-content: center; }
}

.mt-20 { margin-top: 20px; }
    </style>
</head>
<body>

<div class="shell">

    <!-- HEADER -->
    <header class="page-header">
        <div class="header-brand">
            <i class="ph ph-leaf brand-icon"></i>
            <div>
                <h1>Green IT Manager</h1>
                <span class="header-subtitle">Ajouter un équipement au parc</span>
            </div>
        </div>
        <a href="{{ route('devices.index') }}" class="btn btn-secondary">
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