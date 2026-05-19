<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupère tous les devices pour les accesseurs calculés
        $allDevices = Device::all();
        
        // Score moyen calculé en PHP (accesseur, pas colonne SQL)
        $scoreMoyen = $allDevices->count() > 0 
            ? round($allDevices->avg('score_green_it'), 0) 
            : 0;

        // KPIs
        $kpis = [
            'total_devices' => Device::count(),
            'total_conso' => Device::sum('conso_annuelle_kwh') ?? 0,
            'total_co2' => Device::sum('emission_co2_kg') ?? 0,
            'total_fab_co2' => Device::sum('empreinte_carbone_fab') ?? 0,
            'score_moyen' => $scoreMoyen,
            'a_remplacer' => Device::where(function($query) {
                    $query->where('statut', 'recycle')
                          ->orWhere(function($q) {
                              $q->whereNotNull('date_achat')
                                ->whereNotNull('duree_vie_annees')
                                ->whereRaw('TIMESTAMPDIFF(YEAR, date_achat, CURDATE()) >= duree_vie_annees');
                          });
                })->count(),
            'cout_total' => (Device::sum('conso_annuelle_kwh') ?? 0) * 1.5,
        ];

        // Top 5 énergivores
        $topConso = Device::orderByDesc('conso_annuelle_kwh')->take(5)->get();

        // Top 5 pires scores (charge tous pour accesseur)
        $worstScore = Device::all()->sortBy('score_green_it')->take(5);

        // Répartition par type
        $parType = Device::selectRaw('type, COUNT(*) as count, SUM(conso_annuelle_kwh) as conso')
            ->groupBy('type')
            ->get();

        // Alertes
        $alertes = Device::with('user')
            ->where(function($query) {
                $query->where('statut', 'recycle')
                      ->orWhere(function($q) {
                          $q->whereNotNull('date_achat')
                            ->whereNotNull('duree_vie_annees')
                            ->whereRaw('TIMESTAMPDIFF(YEAR, date_achat, CURDATE()) >= duree_vie_annees');
                      });
            })
            ->take(5)
            ->get();

        return view('dashboard', compact('kpis', 'topConso', 'worstScore', 'parType', 'alertes'));
    }
}