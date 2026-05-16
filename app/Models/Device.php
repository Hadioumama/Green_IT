<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'type', 'marque', 'modele', 'numero_serie',
        'date_achat', 'prix', 'puissance_watt', 'efficacite_energetique',
        'duree_vie_annees', 'date_mise_hors_service', 'statut',
        'localisation', 'user_id', 'description',
        // Champs calculés (remplis par les méthodes)
        'conso_annuelle_kwh', 'emission_co2_kg', 'empreinte_carbone_fab',
    ];

    protected $casts = [
        'date_achat' => 'date',
        'date_mise_hors_service' => 'date',
        'prix' => 'decimal:2',
        'puissance_watt' => 'decimal:2',
        'conso_annuelle_kwh' => 'decimal:2',
        'emission_co2_kg' => 'decimal:2',
        'empreinte_carbone_fab' => 'decimal:2',
    ];

    // ========== RELATIONS ==========

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function energyLogs()
    {
        return $this->hasMany(EnergyLog::class);
    }

    // ========== CALCULS AUTOMATIQUES ==========

    /**
     * Étape 1 : Consommation annuelle (kWh)
     * Hypothèse : 8h/jour, 230 jours ouvrés/an
     */
    public function calculerConsoAnnuelle(): void
    {
        if ($this->puissance_watt && $this->puissance_watt > 0) {
            // Formule : W × h/j × j/an ÷ 1000 = kWh
            $this->conso_annuelle_kwh = round(
                ($this->puissance_watt * 8 * 230) / 1000,
                2
            );
            $this->save();
        }
    }

    /**
     * Étape 2 : Émissions CO₂ via API ou facteur local
     * 
     * API Carbon : https://www.carboninterface.com/ ou similaire
     * Fallback : facteur moyen Maroc ~0.7 kg CO₂/kWh
     */
    public function calculerEmissionCO2(): void
    {
        if (!$this->conso_annuelle_kwh) {
            return;
        }

        try {
            // Tentative API Carbon (à configurer avec clé API réelle)
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.carbon.api_key', ''),
                'Content-Type' => 'application/json',
            ])->post('https://www.carboninterface.com/api/v1/estimates', [
                'type' => 'electricity',
                'electricity_unit' => 'kwh',
                'electricity_value' => $this->conso_annuelle_kwh,
                'country' => 'MA', // Maroc
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->emission_co2_kg = round($data['data']['attributes']['carbon_kg'] ?? 0, 2);
            } else {
                // Fallback : facteur local
                $this->emission_co2_kg = $this->calculerAvecFacteurLocal();
            }
        } catch (\Exception $e) {
            // Pas d'internet ou API indisponible → facteur local
            $this->emission_co2_kg = $this->calculerAvecFacteurLocal();
        }

        $this->save();
    }

    /**
     * Calcul fallback avec facteur CO₂ local
     */
    private function calculerAvecFacteurLocal(): float
    {
        // Mix énergétique Maroc (2024) :
        // Charbon ~37%, Gaz ~20%, Hydro ~17%, Éolien ~13%, Solaire ~8%, Import ~5%
        // Facteur moyen : ~0.65 - 0.75 kg CO₂/kWh
        $facteurMaroc = 0.70;
        
        return round($this->conso_annuelle_kwh * $facteurMaroc, 2);
    }

    /**
     * Étape 3 : Empreinte carbone fabrication
     * Basé sur le type d'équipement (données moyennes industrielles)
     * 
     * Sources : ADEME, Base Carbone, études LCA
     */
    public function calculerEmpreinteFabrication(): void
    {
        // Empreintes moyennes fabrication (kg CO₂ équivalent)
        $empreintes = [
            'PC' => 200,           // Desktop + écran
            'Serveur' => 900,      // Serveur rack 1U
            'Switch' => 50,        // Switch réseau
            'Routeur' => 30,       // Routeur
            'Imprimante' => 80,    // Imprimante laser
            'Écran' => 150,        // Écran 24"
            'Onduleur' => 100,     // UPS
            'Autre' => 50,         // Divers
        ];

        $this->empreinte_carbone_fab = $empreintes[$this->type] ?? 50;
        
        // Ajustement selon marque (bonus éco-conception)
        $marquesEco = ['Dell', 'HP', 'Lenovo', 'Apple']; // Programmes recyclage
        if ($this->marque && in_array($this->marque, $marquesEco)) {
            $this->empreinte_carbone_fab *= 0.85; // -15% (recyclage intégré)
        }

        $this->empreinte_carbone_fab = round($this->empreinte_carbone_fab, 2);
        $this->save();
    }

    // ========== ACCESSEURS UTILES ==========

    /**
     * Score Green IT 0-100 (pour dashboard)
     */
    public function getScoreGreenItAttribute(): int
    {
        $scoresClasse = [
            'A+++' => 100, 'A++' => 90, 'A+' => 80, 'A' => 70,
            'B' => 60, 'C' => 50, 'D' => 40, 'Non classé' => 30
        ];
        
        $score = $scoresClasse[$this->efficacite_energetique] ?? 30;
        
        // Pénalité âge
        if ($this->date_achat) {
            $age = now()->diffInYears($this->date_achat);
            $penalite = min($age * 5, 30); // -5pts/an, max -30
            $score = max(0, $score - $penalite);
        }
        
        return (int) $score;
    }

    /**
     * Âge de l'équipement en années
     */
    public function getAgeAttribute(): ?int
    {
        return $this->date_achat ? now()->diffInYears($this->date_achat) : null;
    }

    /**
     * Cout énergie annuel estimé (MAD)
     */
    public function getCoutEnergieAnnuelAttribute(): float
    {
        $prixKwh = 1.5; // MAD/kWh (tarif moyen Maroc)
        return round(($this->conso_annuelle_kwh ?? 0) * $prixKwh, 2);
    }
}