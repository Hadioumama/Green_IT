<?php

namespace App\Http\Controllers;

use App\Models\EnergyLog;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnergyController extends Controller
{
    // ========== API (déjà existant — NE PAS TOUCHER) ==========

    public function store(Request $request)
    {
        EnergyLog::create([
            'device_id' => $request->device_id,
            'consumption' => $request->consumption,
            'date' => now()
        ]);

        return response()->json(['message' => 'Consommation enregistrée']);
    }

    public function totalConsumption()
    {
        $total = EnergyLog::sum('consumption');
        return response()->json(['total_consumption' => $total]);
    }

    public function carbonEmission()
    {
        $total = EnergyLog::sum('consumption');
        $co2 = $total * 0.5;
        return response()->json(['co2' => $co2]);
    }

    public function byDevice()
    {
        $data = EnergyLog::selectRaw('device_id, SUM(consumption) as total')
            ->groupBy('device_id')
            ->get();
        return response()->json($data);
    }

    // ========== WEB (NOUVEAU — pour afficher la page consommation) ==========

    /**
     * Page : Historique des consommations
     */
       /**
     * Page : Historique des consommations
     */
    public function indexWeb(Request $request)
    {
        $query = EnergyLog::with('device')
            ->whereHas('device', function ($q) {
                $q->where('user_id', Auth::id());
            });

        // Filtre par appareil
        if ($request->filled('device_id')) {
            $query->where('device_id', $request->device_id);
        }

        // Filtre par dates (utilise 'date' si ancienne migration, 'date_debut' si nouvelle)
        if ($request->filled('date_debut')) {
            $query->whereDate('date', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('date', '<=', $request->date_fin);
        }

        // Tri par date (ancienne migration utilise 'date', nouvelle utilise 'date_debut')
        $energyLogs = $query->orderBy('date', 'desc')->get();
        
        $devices = Device::where('user_id', Auth::id())->get();

        // Stats globales
        $totalConsumption = $energyLogs->sum(function($log) {
            return $log->consumption_kwh ?? $log->consumption ?? 0;
        });
        $totalCO2 = $totalConsumption * 0.7; // Facteur Maroc

        return view('energy.index', compact('energyLogs', 'devices', 'totalConsumption', 'totalCO2'));
    }
    /**
     * Page : Formulaire d'ajout
     */
    public function createWeb()
    {
        $devices = Device::where('user_id', Auth::id())->get();
        return view('energy.create', compact('devices'));
    }

    /**
     * Traitement : Enregistrer une consommation (WEB)
     */
    public function storeWeb(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'consumption_kwh' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'source' => 'in:mesure_reelle,estimation,facture,api_carbon',
            'notes' => 'nullable|string|max:500',
        ]);

        $device = Device::findOrFail($validated['device_id']);
        if ($device->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cet appareil.');
        }

        $validated['emission_co2_kg'] = round($validated['consumption_kwh'] * 0.7, 2);

        EnergyLog::create($validated);

        return redirect()->route('energy.index')->with('success', 'Consommation enregistrée avec succès !');
    }
}