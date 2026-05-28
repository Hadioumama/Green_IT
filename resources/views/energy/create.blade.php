<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Consommation — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
:root {
    --green-primary: #10b981;
    --green-bright:  #34d399;
    --green-dark:    #059669;
    --green-glow:    rgba(16,185,129,0.28);
    --green-soft:    rgba(16,185,129,0.1);
    --border:        rgba(8,25,16,0.2);
    --border-dim:    rgba(177,165,165,0.08);
    --text-1: #f4f6f5dd;
    --text-2: #e6f3ec;
    --text-3: #10b981;
    --amber:  #f79616de;
    --blue:   #76b8f9ea;
    --purple: #4c12d3;
    --r:    14px;
    --r-lg: 22px;
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

html, body {
    font-family: 'Inter', sans-serif;
    color: var(--text-1);
    height: 100vh;
    overflow: hidden; /* body ne scrolle pas */
    -webkit-font-smoothing: antialiased;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url('{{ asset("images/img.jfif") }}');
    background-size: cover;
    background-position: center;
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

/* ── CONTENEUR PRINCIPAL ── */
.page-wrapper {
    position: relative;
    z-index: 1;
    width: min(600px, 90vw);
    height: min(860px, 85vh);   /* ✅ hauteur fixe pour permettre le scroll */
    display: flex;
    flex-direction: column;
}

/* ── CARTE FORMULAIRE SCROLLABLE ── */
.form-container {
    flex: 1;
    overflow-y: auto;            /* ✅ scroll activé ici */
    background: rgba(143,158,151,0.45);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    border-radius: var(--r-lg);
    border: 1px solid rgba(52,211,153,0.18);
    box-shadow:
        0 32px 80px rgba(0,0,0,0.45),
        0  0  40px rgba(16,185,129,0.06) inset,
        0  1px 0   rgba(255,255,255,0.12) inset;
    padding: 32px 36px;
    animation: shellIn 0.8s cubic-bezier(.4,0,.2,1) both;
}

/* ✅ SCROLLBAR VISIBLE — thème vert */
.form-container::-webkit-scrollbar {
    width: 6px;
}
.form-container::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.04);
    border-radius: 5px;
}
.form-container::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--green-bright), var(--green-dark));
    border-radius: 5px;
}
.form-container::-webkit-scrollbar-thumb:hover {
    background: var(--green-primary);
}
/* Firefox */
.form-container {
    scrollbar-width: thin;
    scrollbar-color: var(--green-dark) rgba(255,255,255,0.04);
}

@keyframes shellIn {
    from { opacity:0; transform:scale(0.97) translateY(14px); }
    to   { opacity:1; transform:scale(1)    translateY(0); }
}

/* ── HEADER ── */
.form-header {
    text-align: center;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(52,211,153,0.15);
}
.form-icon {
    font-size: 42px;
    color: var(--green-bright);
    display: block;
    margin-bottom: 10px;
    filter: drop-shadow(0 0 12px var(--green-glow));
}
.form-header h1 {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-1);
    margin-bottom: 6px;
}
.subtitle {
    font-size: 13px;
    color: var(--text-2);
    opacity: 0.75;
}

/* ── GROUPES ── */
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-2);
    margin-bottom: 8px;
}
.form-group label i { font-size: 16px; color: var(--green-primary); }

.required { color: #ef4444; margin-left: 2px; }

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

/* ── INPUTS ── */
.form-control,
.form-select {
    width: 100%;
    padding: 11px 14px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(52,211,153,0.2);
    border-radius: 10px;
    color: var(--text-1);
    font-size: 13px;
    font-family: 'Inter', sans-serif;
    outline: none;
    transition: all 0.2s;
    appearance: none;
    -webkit-appearance: none;
}
.form-control::placeholder { color: rgba(255,255,255,0.3); }
.form-control:focus,
.form-select:focus {
    border-color: var(--green-bright);
    background: rgba(16,185,129,0.08);
    box-shadow: 0 0 0 3px rgba(52,211,153,0.12);
}

/* Select arrow */
.form-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2310b981' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
}
.form-select option {
    background: #0a1f15;
    color: var(--text-1);
}

/* Input group (kWh) */
.input-group {
    display: flex;
    align-items: stretch;
}
.input-group .form-control {
    border-radius: 10px 0 0 10px;
    border-right: none;
}
.input-suffix {
    padding: 11px 14px;
    background: rgba(16,185,129,0.12);
    border: 1px solid rgba(52,211,153,0.2);
    border-left: none;
    border-radius: 0 10px 10px 0;
    color: var(--green-bright);
    font-size: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    white-space: nowrap;
}

textarea.form-control { resize: vertical; min-height: 80px; }

/* Erreurs */
.error {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 6px;
    font-size: 11px;
    color: #f87171;
}
.is-invalid {
    border-color: rgba(239,68,68,0.5) !important;
}

/* ── BOUTONS ── */
.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid rgba(52,211,153,0.1);
}
.btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    border: none;
}
.btn i { font-size: 17px; }

.btn-primary {
    background: linear-gradient(135deg, var(--green-primary), var(--green-dark));
    color: #fff;
    box-shadow: 0 4px 18px rgba(16,185,129,0.3);
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(16,185,129,0.4);
}

.btn-secondary {
    background: rgba(255,255,255,0.06);
    color: var(--text-2);
    border: 1px solid rgba(255,255,255,0.12);
}
.btn-secondary:hover {
    background: rgba(255,255,255,0.1);
    color: var(--text-1);
}
    </style>
</head>
<body>

<div class="page-wrapper">
    <div class="form-container">

        <div class="form-header">
            <i class="ph ph-lightning form-icon"></i>
            <h1>Ajouter une consommation</h1>
            <p class="subtitle">Enregistrez une mesure de consommation électrique</p>
        </div>

        <form action="{{ route('energy.store') }}" method="POST">
            @csrf

            <!-- Appareil -->
            <div class="form-group">
                <label for="device_id">
                    <i class="ph ph-desktop"></i> Appareil <span class="required">*</span>
                </label>
                <select name="device_id" id="device_id"
                        class="form-select @error('device_id') is-invalid @enderror" required>
                    <option value="">Choisir un appareil...</option>
                    @foreach($devices ?? [] as $dev)
                        <option value="{{ $dev->id }}"
                            {{ (request('device_id') == $dev->id || old('device_id') == $dev->id) ? 'selected' : '' }}>
                            {{ $dev->nom }} ({{ $dev->type }})
                        </option>
                    @endforeach
                </select>
                @error('device_id')
                    <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <!-- Consommation -->
            <div class="form-group">
                <label for="consumption_kwh">
                    <i class="ph ph-gauge"></i> Consommation (kWh) <span class="required">*</span>
                </label>
                <div class="input-group">
                    <input type="number" step="0.0001" name="consumption_kwh" id="consumption_kwh"
                           class="form-control @error('consumption_kwh') is-invalid @enderror"
                           value="{{ old('consumption_kwh') }}" placeholder="Ex: 45.50" required>
                    <span class="input-suffix">kWh</span>
                </div>
                @error('consumption_kwh')
                    <div class="error"><i class="ph ph-warning-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <!-- Dates -->
            <div class="form-row">
                <div class="form-group">
                    <label for="date_debut">
                        <i class="ph ph-calendar"></i> Date début <span class="required">*</span>
                    </label>
                    <input type="date" name="date_debut" id="date_debut"
                           class="form-control"
                           value="{{ old('date_debut', now()->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label for="date_fin">
                        <i class="ph ph-calendar"></i> Date fin <span class="required">*</span>
                    </label>
                    <input type="date" name="date_fin" id="date_fin"
                           class="form-control"
                           value="{{ old('date_fin', now()->format('Y-m-d')) }}" required>
                </div>
            </div>

            <!-- Source -->
            <div class="form-group">
                <label for="source">
                    <i class="ph ph-database"></i> Source de la mesure
                </label>
                <select name="source" id="source" class="form-select">
                    <option value="mesure_reelle">Mesure réelle (compteur)</option>
                    <option value="estimation">Estimation / calcul</option>
                    <option value="facture">Facture fournisseur</option>
                    <option value="api_carbon">API externe</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="form-group">
                <label for="notes">
                    <i class="ph ph-note"></i> Notes
                </label>
                <textarea name="notes" id="notes" class="form-control"
                          rows="3" placeholder="Informations complémentaires...">{{ old('notes') }}</textarea>
            </div>

            <!-- Boutons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="ph ph-check"></i> Enregistrer
                </button>
                <a href="{{ route('energy.index') }}" class="btn btn-secondary">
                    <i class="ph ph-x"></i> Annuler
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>