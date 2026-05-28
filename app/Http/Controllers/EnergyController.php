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

    // ========== WEB ==========

    public function indexWeb(Request $request)
    {
        // ÉTAPE 1 : TOUS MES APPAREILS
        $devicesQuery = Device::query();
        
        if (Auth::user()->role !== 'admin') {
            $devicesQuery->where('user_id', Auth::id());
        }
        
        if ($request->filled('type')) {
            $devicesQuery->where('type', $request->type);
        }
        
        $devices = $devicesQuery->get();

        // ÉTAPE 2 : STATS GLOBALES
        $totalKwh = $devices->sum(function($device) {
            return $device->conso_annuelle_kwh ?? 0;
        });
        
        $totalCO2 = $totalKwh * 0.7;
        $totalCost = $totalKwh * 1.5;
        $activeDevices = $devices->where('statut', 'actif')->count();
        $totalDevices = $devices->count();

        // ÉTAPE 3 : DONNÉES POUR LA COURBE PAR APPAREIL
        $chartData = $devices->map(function($device) {
            return [
                'name' => $device->nom,
                'kwh' => $device->conso_annuelle_kwh ?? 0,
                'co2' => ($device->conso_annuelle_kwh ?? 0) * 0.7,
                'type' => $device->type,
            ];
        });

        // ÉTAPE 4 : MESURES ENREGISTRÉES (EnergyLog)
        $logsQuery = EnergyLog::with('device')
            ->whereHas('device', function ($q) {
                if (Auth::user()->role !== 'admin') {
                    $q->where('user_id', Auth::id());
                }
            });

        if ($request->filled('device_id')) {
            $logsQuery->where('device_id', $request->device_id);
        }

        if ($request->filled('date_debut')) {
            $logsQuery->where(function($q) use ($request) {
                $q->whereDate('date_debut', '>=', $request->date_debut)
                  ->orWhereDate('date', '>=', $request->date_debut);
            });
        }

        if ($request->filled('date_fin')) {
            $logsQuery->where(function($q) use ($request) {
                $q->whereDate('date_debut', '<=', $request->date_fin)
                  ->orWhereDate('date', '<=', $request->date_fin);
            });
        }

        $energyLogs = $logsQuery->get();

        $logsPourLaCourbe = $energyLogs->map(function($log) {
            $date = $log->date_debut ?? $log->date ?? now();
            $kwh = $log->consumption_kwh ?? $log->consumption ?? 0;
            
            return [
                'kwh' => (float) $kwh,
                'date' => $date instanceof \Carbon\Carbon ? $date->toDateString() : (string) $date,
            ];
        })->sortBy('date')->values();

        $totalMesures = $energyLogs->count();

        // ÉTAPE 5 : STATS (pour compatibilité ancien design)
        $stats = [
            'total_kwh' => $totalKwh,
            'total_co2' => $totalCO2,
            'total_cost' => $totalCost,
            'total_devices' => $totalDevices,
            'active_devices' => $activeDevices,
            'total_mesures' => $totalMesures,
        ];

        // ÉTAPE 6 : ALERTES POUR LA SIDEBAR
        $alertCount = Device::where('statut', 'recycle')
            ->orWhereRaw('TIMESTAMPDIFF(YEAR, date_achat, CURDATE()) >= duree_vie_annees')
            ->count();

        // ÉTAPE 7 : VARIABLES POUR LE NOUVEAU DESIGN
        $totalConsumption = $totalKwh;
        $totalCO2Calc = $totalKwh * 0.7;

        // ÉTAPE 8 : ENVOYER À LA VUE
        return view('energy.index', array_merge(
            compact(
                'chartData',
                'energyLogs',
                'logsPourLaCourbe',
                'devices',
                'alertCount',
                'totalConsumption',
                'totalCO2Calc'
            ),
            ['stats' => $stats]
        ));
    }

    public function createWeb()
    {
        $devices = Device::where('user_id', Auth::id())->get();
        return view('energy.create', compact('devices'));
    }

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