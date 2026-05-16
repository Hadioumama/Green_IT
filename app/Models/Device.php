<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Device extends Model
{
    use HasFactory;

    /**
     * Champs saisissables par l'utilisateur/admin
     * Les champs calculés (conso_annuelle_kwh, emission_co2_kg, empreinte_carbone_fab)
     * sont REMPLIS AUTOMATIQUEMENT par les méthodes calculer*()
     */
    protected $fillable = [
        'nom',
        'type',
        'marque',
        'modele',
        'numero_serie',
        'date_achat',
        'prix',
        'puissance_watt',
        'efficacite_energetique',
        'duree_vie_annees',
        'date_mise_hors_service',
        'statut',
        'localisation',
        'user_id',
        'description',
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
            $this->conso_annuelle_kwh = round(
                ($this->puissance_watt * 8 * 230) / 1000,
                2
            );
            $this->save();
        }
    }

    /**
     * Étape 2 : Émissions CO₂ via API ou facteur local
     */
    public function calculerEmissionCO2(): void
    {
        if (!$this->conso_annuelle_kwh) {
            return;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.carbon.api_key', ''),
                'Content-Type' => 'application/json',
            ])->post('https://www.carboninterface.com/api/v1/estimates', [
                'type' => 'electricity',
                'electricity_unit' => 'kwh',
                'electricity_value' => $this->conso_annuelle_kwh,
                'country' => 'MA',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->emission_co2_kg = round($data['data']['attributes']['carbon_kg'] ?? 0, 2);
            } else {
                $this->emission_co2_kg = $this->calculerAvecFacteurLocal();
            }
        } catch (\Exception $e) {
            $this->emission_co2_kg = $this->calculerAvecFacteurLocal();
        }

        $this->save();
    }

    /**
     * Calcul fallback avec facteur CO₂ local (Maroc)
     */
    private function calculerAvecFacteurLocal(): float
    {
        $facteurMaroc = 0.70;
        return round($this->conso_annuelle_kwh * $facteurMaroc, 2);
    }

    /**
     * Étape 3 : Empreinte carbone fabrication
     */
    public function calculerEmpreinteFabrication(): void
    {
        $empreintes = [
            'PC' => 200,
            'Serveur' => 900,
            'Switch' => 50,
            'Routeur' => 30,
            'Imprimante' => 80,
            'Écran' => 150,
            'Onduleur' => 100,
            'Autre' => 50,
        ];

        $this->empreinte_carbone_fab = $empreintes[$this->type] ?? 50;
        
        $marquesEco = ['Dell', 'HP', 'Lenovo', 'Apple'];
        if ($this->marque && in_array($this->marque, $marquesEco)) {
            $this->empreinte_carbone_fab *= 0.85;
        }

        $this->empreinte_carbone_fab = round($this->empreinte_carbone_fab, 2);
        $this->save();
    }

    // ========== ACCESSEURS UTILES ==========

    /**
     * Score Green IT 0-100
     */
    public function getScoreGreenItAttribute(): int
    {
        $scoresClasse = [
            'A+++' => 100, 'A++' => 90, 'A+' => 80, 'A' => 70,
            'B' => 60, 'C' => 50, 'D' => 40, 'Non classé' => 30
        ];
        
        $score = $scoresClasse[$this->efficacite_energetique] ?? 30;
        
        if ($this->date_achat) {
            $age = now()->diffInYears($this->date_achat);
            $penalite = min($age * 5, 30);
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
        $prixKwh = 1.5;
        return round(($this->conso_annuelle_kwh ?? 0) * $prixKwh, 2);
    }
}