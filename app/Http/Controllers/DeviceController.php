<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class DeviceController extends Controller
{
    /**
     * Affiche la liste des équipements avec stats Green IT
     */
    public function index()
    {
        $devices = Device::with('user')->paginate(10);
        
        // Stats globales pour le dashboard
        $stats = [
            'total_devices' => Device::count(),
            'total_conso_kwh' => Device::sum('conso_annuelle_kwh') ?? 0,
            'total_emission_co2' => Device::sum('emission_co2_kg') ?? 0,
            'total_fabrication_co2' => Device::sum('empreinte_carbone_fab') ?? 0,
            'devices_actifs' => Device::where('statut', 'actif')->count(),
            'devices_a_remplacer' => Device::where('statut', 'recycle')
                ->orWhereRaw('TIMESTAMPDIFF(YEAR, date_achat, CURDATE()) >= duree_vie_annees')
                ->count(),
        ];
        
        return view('index', compact('devices', 'stats'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $users = User::all();
        return view('devices.create', compact('users'));
    }

    /**
     * Enregistre un nouvel équipement avec calculs auto CO₂
     */
    public function store(Request $request)
    {
        // Validation — SEULEMENT champs saisis par admin
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:PC,Serveur,Switch,Routeur,Imprimante,Écran,Onduleur,Autre',
            'marque' => 'nullable|string|max:100',
            'modele' => 'nullable|string|max:100',
            'numero_serie' => 'required|string|unique:devices|max:100',
            'date_achat' => 'nullable|date|before_or_equal:today',
            'prix' => 'nullable|numeric|min:0',
            'puissance_watt' => 'required|numeric|min:0',  // ← OBLIGATOIRE pour calculs
            'efficacite_energetique' => 'nullable|in:A+++,A++,A+,A,B,C,D,Non classé',
            'duree_vie_annees' => 'nullable|integer|min:1|max:50',
            'date_mise_hors_service' => 'nullable|date|after:date_achat',
            'statut' => 'required|in:actif,en_reparation,hors_service,stock,recycle',
            'localisation' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string|max:2000',
        ], [
            'puissance_watt.required' => 'La puissance (Watts) est obligatoire pour le calcul des émissions CO₂.',
            'numero_serie.unique' => 'Ce numéro de série existe déjà dans la base.',
        ]);

        // Création — champs calculés seront remplis après
        $device = Device::create($validated);

        // ========== CALCULS AUTOMATIQUES GREEN IT ==========
        
        // 1. Consommation annuelle (kWh) : puissance × 8h/j × 230j/an ÷ 1000
        $device->calculerConsoAnnuelle();
        
        // 2. Émissions CO₂ via API Carbon (ou facteur local)
        $device->calculerEmissionCO2();
        
        // 3. Empreinte fabrication via API (simulation)
        $device->calculerEmpreinteFabrication();

        return redirect()
            ->route('index')
            ->with('success', sprintf(
                'Équipement "%s" ajouté. Consommation: %.2f kWh/an | Émissions: %.2f kg CO₂/an',
                $device->nom,
                $device->conso_annuelle_kwh,
                $device->emission_co2_kg
            ));
    }

    /**
     * Affiche les détails d'un équipement
     */
    public function show(Device $device)
    {
        $device->load('user', 'energyLogs');
        
        // Calculs projetés
        $projections = [
            'cout_energie_annuel' => ($device->conso_annuelle_kwh ?? 0) * 1.5, // 1.5 MAD/kWh estimé
            'cout_energie_5ans' => ($device->conso_annuelle_kwh ?? 0) * 1.5 * 5,
            'emission_5ans' => ($device->emission_co2_kg ?? 0) * 5,
        ];
        
        return view('devices.show', compact('device', 'projections'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Device $device)
    {
        $users = User::all();
        return view('devices.edit', compact('device', 'users'));
    }

    /**
     * Met à jour un équipement (recalcule si puissance change)
     */
    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:PC,Serveur,Switch,Routeur,Imprimante,Écran,Onduleur,Autre',
            'marque' => 'nullable|string|max:100',
            'modele' => 'nullable|string|max:100',
            'numero_serie' => 'required|string|unique:devices,numero_serie,' . $device->id . '|max:100',
            'date_achat' => 'nullable|date|before_or_equal:today',
            'prix' => 'nullable|numeric|min:0',
            'puissance_watt' => 'required|numeric|min:0',
            'efficacite_energetique' => 'nullable|in:A+++,A++,A+,A,B,C,D,Non classé',
            'duree_vie_annees' => 'nullable|integer|min:1|max:50',
            'date_mise_hors_service' => 'nullable|date|after:date_achat',
            'statut' => 'required|in:actif,en_reparation,hors_service,stock,recycle',
            'localisation' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string|max:2000',
        ]);

        $anciennePuissance = $device->puissance_watt;
        
        $device->update($validated);

        // Recalcule si la puissance a changé
        if ($device->puissance_watt != $anciennePuissance) {
            $device->calculerConsoAnnuelle();
            $device->calculerEmissionCO2();
        }

        return redirect()
            ->route('index')
            ->with('success', 'Équipement "' . $device->nom . '" mis à jour.');
    }

    /**
     * Supprime un équipement
     */
    public function destroy(Device $device)
    {
        $nom = $device->nom;
        $device->delete();
        
        return redirect()
            ->route('index')
            ->with('success', 'Équipement "' . $nom . '" supprimé.');
    }
}