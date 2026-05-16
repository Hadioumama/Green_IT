<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Consommation — Green IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/energy.css') }}">
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
                <label for="device_id"><i class="ph ph-desktop"></i> Appareil <span class="required">*</span></label>
                <select name="device_id" id="device_id" class="form-select @error('device_id') is-invalid @enderror" required>
                    <option value="">Choisir un appareil...</option>
                    @foreach($devices ?? [] as $dev)
                        <option value="{{ $dev->id }}" {{ (request('device_id') == $dev->id || old('device_id') == $dev->id) ? 'selected' : '' }}>
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
                <label for="consumption_kwh"><i class="ph ph-gauge"></i> Consommation (kWh) <span class="required">*</span></label>
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
                    <label for="date_debut"><i class="ph ph-calendar"></i> Date début <span class="required">*</span></label>
                    <input type="date" name="date_debut" id="date_debut"
                           class="form-control" value="{{ old('date_debut', now()->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label for="date_fin"><i class="ph ph-calendar"></i> Date fin <span class="required">*</span></label>
                    <input type="date" name="date_fin" id="date_fin"
                           class="form-control" value="{{ old('date_fin', now()->format('Y-m-d')) }}" required>
                </div>
            </div>

            <!-- Source -->
            <div class="form-group">
                <label for="source"><i class="ph ph-database"></i> Source de la mesure</label>
                <select name="source" id="source" class="form-select">
                    <option value="mesure_reelle">Mesure réelle (compteur)</option>
                    <option value="estimation">Estimation / calcul</option>
                    <option value="facture">Facture fournisseur</option>
                    <option value="api_carbon">API externe</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="form-group">
                <label for="notes"><i class="ph ph-note"></i> Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="3"
                          placeholder="Informations complémentaires...">{{ old('notes') }}</textarea>
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